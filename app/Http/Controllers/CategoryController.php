<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->middleware('can:categories.index')->only('index');
        $this->middleware('can:categories.create')->only('create', 'store');
        $this->middleware('can:categories.edit')->only('edit', 'update');
        $this->middleware('can:categories.show')->only('show');
        $this->middleware('can:categories.destroy')->only('destroy');
        $this->middleware('can:categories.trashed')->only('trashed');
        $this->middleware('can:categories.restore')->only('restore', 'restoreAll');
        $this->middleware('can:categories.forceDelete')->only('forceDelete', 'forceDeleteAll');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $subcategories = Subcategory::all();

        return view('categories.create', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        Category::create([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'La categoría ha sido creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        $subcategories = Subcategory::where('category_id', $category->id)->paginate(6);

        return view('categories.show', compact('category', 'subcategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'code' => strtoupper($request->code),
        ]);

        $subcategories = Subcategory::where('category_id',$category->id)->get();

        foreach ($subcategories as $subcat) {
            $pos = strpos($subcat->code,"_");
            $subcat->update([
                'code' => $request->code . "_" . substr($subcat->code,$pos+1)
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Los datos han sido actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'La categoría ha sido eliminada correctamente.');
    }

    public function trashed(): View
    {
        $categories = Category::onlyTrashed()->paginate(10);

        return view('categories.trashed', compact('categories'));
    }

    /**
     * Restore the specified category from storage.
     */
    public function restore($id): RedirectResponse
    {
        $category = Category::onlyTrashed()->find($id);

        $category->restore();

        // Mail::to($category->email)->send(new Category($category));

        return back()->with('success', 'La categoría ha sido restaurada correctamente.');
    }

    /**
     * Restore all category from storage.
     */
    public function restoreAll(): RedirectResponse
    {
        Category::onlyTrashed()->restore();

        return back()->with('success', 'Todas las categorías han sido restauradas correctamente.');
    }


    /**
     * Force delete the specified category from storage.
     */
    public function forceDelete($id): RedirectResponse
    {
        $category = Category::onlyTrashed()->find($id);

        $category->forceDelete();

        return back()->with('success', 'La categoría ha sido eliminada permanentemente.');
    }


    /**
     * Delete all category from storage.
     */
    public function forceDeleteAll(): RedirectResponse
    {
        Category::onlyTrashed()->forceDelete();

        return back()->with('success', 'Todas las categorías han sido eliminadas permanentemente.');
    }
}
