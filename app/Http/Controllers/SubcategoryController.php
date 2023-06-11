<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;

use App\Http\Requests\Subcategories\CreateSubcategoryRequest;
use App\Http\Requests\Subcategories\UpdateSubcategoryRequest;
use App\Http\Requests\Subcategories\CatIDSubcategoryRequest;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        $this->middleware('can:subcategories.create')->only('create', 'store');
        $this->middleware('can:subcategories.edit')->only('edit', 'update');
        $this->middleware('can:subcategories.destroy')->only('destroy');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CatIDSubcategoryRequest $request): View
    {
        $category = Category::find($request->cat_id);

        return view('subcategories.create', compact('category'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubcategoryRequest $request): RedirectResponse
    {
        Subcategory::create([
            'category_id' => intval($request->cat_id),
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->cat_code."_".strtoupper($request->code),
        ]);

        return redirect()->route('categories.show', $request->cat_id)
            ->with('category_id', $request->cat_id)
            ->with('success', 'La subcategoría ha sido creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory): View
    {
        $codeComplete = $subcategory->code;
        $pos = strpos($codeComplete,"_");
        $code = substr($codeComplete,$pos+1);

        return view('subcategories.edit', compact('subcategory', 'code'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory): RedirectResponse
    {
        $cat_code = $subcategory->category->code;
        $subcategory->update([
            'name' => $request->name,
            'code' => $cat_code . "_" .strtoupper($request->code),
            'description' => $request->description
        ]);

        return redirect()->route('categories.show', $subcategory->category->id)->with('success', 'Los datos han sido actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory): RedirectResponse
    {
        $cat_id = $subcategory->category->id;
        $subcategory->delete();

        return redirect()->route('categories.show', $cat_id)->with('success', 'La subcategoría ha sido eliminada correctamente.');;
    }


}
