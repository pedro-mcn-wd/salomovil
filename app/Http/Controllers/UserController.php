<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\UserFilterRequest;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.destroy')->only('destroy');
        $this->middleware('can:users.trashed')->only('trashed');
        $this->middleware('can:users.restore')->only('restore', 'restoreAll');
        $this->middleware('can:users.forceDelete')->only('forceDelete', 'forceDeleteAll');
        $this->middleware('can:users.pdf')->only('getPDF');

    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserFilterRequest $request): View
    {
        $request->name != null ?  $old_values['values_filters']['name'] = $request->name :  $old_values['values_filters']['name'] = "";
        $request->surname_first != null ?  $old_values['values_filters']['surname_first'] = $request->surname_first :  $old_values['values_filters']['surname_first'] = "";
        $request->surname_second != null ?  $old_values['values_filters']['surname_second'] = $request->surname_second :  $old_values['values_filters']['surname_second'] = "";
        $request->email != null ?  $old_values['values_filters']['email'] = $request->email :  $old_values['values_filters']['email'] = "";
        $request->dni != null ?  $old_values['values_filters']['dni'] = $request->dni :  $old_values['values_filters']['dni'] = "";
        $request->role != null ?  $old_values['values_filters']['role'] = $request->role :  $old_values['values_filters']['role'] = "";

        $users = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->when($request->name, function ($query) use ($request){
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            })
            ->when($request->surname_first, function ($query) use ($request){
                $query->where('surname_first', 'LIKE', '%' . $request->surname_first . '%');
            })
            ->when($request->surname_second, function ($query) use ($request){
                $query->where('surname_second', 'LIKE', '%' . $request->surname_second . '%');
            })
            ->when($request->dni, function ($query) use ($request){
                $query->where('dni', 'LIKE', '%' . $request->dni . '%');
            })
            ->when($request->email, function ($query) use ($request){
                $query->where('email', 'LIKE', '%' . $request->email . '%');
            })
            ->when($request->role, function ($query, $role) {
                return $query->whereHas('roles',function ($query) use ($role){
                    $query->where('name','LIKE', '%' . $role. '%');
                });
            })
            ->orderBy('name', 'asc')
            ->paginate(8);

        $roles = Role::all();

        $users->appends([
            'name' => $request->name,
            'surname_first' => $request->surname_first,
            'surname_second' => $request->surname_second,
            'dni' => $request->dni,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return view('users.index', compact('users', 'roles', 'old_values'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        $today = Carbon::now();

        return view('users.create', compact('roles','today'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $new_user = User::create([
            'email' => $request->email,
            'password' => Hash::make(Str::random(10)),
        ]);

        $new_user->assignRole($request->roles);

        UserProfile::create([
            'name' => $request->name,
            'surname_first' => $request->surname_first,
            'surname_second' => $request->surname_second,
            'dni' => $request->dni,
            'bio' => $request->bio,
            'birthdate' => $request->birthdate ? Carbon::parse($request->birthdate)->format('Y-m-d H:i:s') : null,
            'user_id' => $new_user->id,
        ]);

        //Sending an email to the user to change the password.
        // Password::sendResetLink(['email' => $request->email]);

        return redirect()->route('users.index')->with('success', 'El usuario ha sido creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $birthdate = Carbon::parse($user->userProfile->birthdate)->format('d/m/Y');

        return view('users.show', compact('user', 'birthdate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        if ($request->has('avatar')) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('users_avatar');
        }

        $user->update([
            'email' => $request->email,
        ]);

        if ($request->password != null) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->userProfile->update([
            'name' => $request->name,
            'surname_first' => $request->surname_first,
            'surname_second' => $request->surname_second,
            'dni' => $request->dni,
            'birthdate' => $request->birthdate,
            'bio' => $request->bio,
        ]);

        //deleting old roles and assign new roles
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->roles);

        return redirect()->route('users.index')->with('success', 'Los datos han sido actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if($user->getRoleNames()->first() === "admin"){
            return back()->withErrors('El administrador no puede ser eliminado.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'El usuario ha sido eliminado correctamente.');
    }

    /**
     * Display all users trashed.
     */
    public function trashed(UserFilterRequest $request): View
    {
        // dd($request);

        $request->name != null ?  $old_values['values_filters']['name'] = $request->name :  $old_values['values_filters']['name'] = "";
        $request->surname_first != null ?  $old_values['values_filters']['surname_first'] = $request->surname_first :  $old_values['values_filters']['surname_first'] = "";
        $request->surname_second != null ?  $old_values['values_filters']['surname_second'] = $request->surname_second :  $old_values['values_filters']['surname_second'] = "";
        $request->email != null ?  $old_values['values_filters']['email'] = $request->email :  $old_values['values_filters']['email'] = "";
        $request->dni != null ?  $old_values['values_filters']['dni'] = $request->dni :  $old_values['values_filters']['dni'] = "";
        $request->role != null ?  $old_values['values_filters']['role'] = $request->role :  $old_values['values_filters']['role'] = "";

        $users = User::onlyTrashed()
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->where('name', 'LIKE', '%' . $request->name . '%')
            ->where('surname_first', 'LIKE', '%' . $request->surname_first . '%')
            ->where('surname_second', 'LIKE', '%' . $request->surname_second . '%')
            ->where('dni', 'LIKE', '%' . $request->dni . '%')
            ->where('email', 'LIKE', '%' . $request->email . '%')
            ->when($request->role, function ($query, $role) {
                return $query->whereHas('roles',function ($query) use ($role){
                    $query->where('name','LIKE', '%' . $role. '%');
                });
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        $roles = Role::all();

        $users->appends([
            'name' => $request->name,
            'surname_first' => $request->surname_first,
            'surname_second' => $request->surname_second,
            'dni' => $request->dni,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // $today = Carbon::now();

        return view('users.trashed', compact('users', 'roles', 'old_values'));
    }

    /**
     * Restore the specified user from storage.
     */
    public function restore($id): RedirectResponse //no consigo que funcione User $user como argumento
    {
        $user = User::onlyTrashed()->find($id);

        $user->restore();

        // Mail::to($user->email)->send(new UserRestored($user));

        return back()->with('success', 'El usuario ha sido restaurado correctamente.');
    }

    /**
     * Restore all users from storage.
     */
    public function restoreAll(): RedirectResponse
    {
        User::onlyTrashed()->restore();
        UserProfile::onlyTrashed()->restore();

        return back()->with('success', 'Todos los usuarios han sido restaurados correctamente.');
    }


    /**
     * Force delete the specified user from storage.
     */
    public function forceDelete($id): RedirectResponse
    {
        $user = User::onlyTrashed()->find($id);

        $user->forceDelete();

        return back()->with('success', 'El usuario ha sido eliminado permanentemente.');
    }


    /**
     * Delete all users from storage.
     */
    public function forceDeleteAll(): RedirectResponse
    {
        User::onlyTrashed()->forceDelete();
        UserProfile::onlyTrashed()->forceDelete();

        return back()->with('success', 'Todos los usuarios han sido eliminados permanentemente.');
    }

    public function getPDF(UserFilterRequest $request)
    {
        $request->name != null ?  $old_values['values_filters']['name'] = $request->name :  $old_values['values_filters']['name'] = "";
        $request->surname_first != null ?  $old_values['values_filters']['surname_first'] = $request->surname_first :  $old_values['values_filters']['surname_first'] = "";
        $request->surname_second != null ?  $old_values['values_filters']['surname_second'] = $request->surname_second :  $old_values['values_filters']['surname_second'] = "";
        $request->email != null ?  $old_values['values_filters']['email'] = $request->email :  $old_values['values_filters']['email'] = "";
        $request->dni != null ?  $old_values['values_filters']['dni'] = $request->dni :  $old_values['values_filters']['dni'] = "";
        $request->role != null ?  $old_values['values_filters']['role'] = $request->role :  $old_values['values_filters']['role'] = "";

        $users = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->when($request->name, function ($query) use ($request){
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            })
            ->when($request->surname_first, function ($query) use ($request){
                $query->where('surname_first', 'LIKE', '%' . $request->surname_first . '%');
            })
            ->when($request->surname_second, function ($query) use ($request){
                $query->where('surname_second', 'LIKE', '%' . $request->surname_second . '%');
            })
            ->when($request->dni, function ($query) use ($request){
                $query->where('dni', 'LIKE', '%' . $request->dni . '%');
            })
            ->when($request->email, function ($query) use ($request){
                $query->where('email', 'LIKE', '%' . $request->email . '%');
            })
            ->when($request->role, function ($query, $role) {
                return $query->whereHas('roles',function ($query) use ($role){
                    $query->where('name','LIKE', '%' . $role. '%');
                });
            })
            ->orderBy('name', 'asc')
            ->get();

        $namePDF = "usuarios_".Carbon::now()->format('d-m-Y')."_".Carbon::now()->format('H:i:s').".pdf";

        // return view('layouts.pdfs.admin.products', compact('products'));

        $pdf = PDF::setPaper('a3')->loadView('layouts.pdfs.admin.users', compact('users'));
        return $pdf->download($namePDF);
    }
}
