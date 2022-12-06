<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Category;
use App\Http\Requests\Subcategory\StoreRequest;
use App\Http\Requests\Subcategory\UpdateRequest;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $subcategories= Subcategory::get();
        return view ('admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Subcategory $subcategory)
    {
        $subcategory->my_store($request);
        return back();
       // return redirect()->route('subcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        
        $subcategoria=$subcategory->id;
        $productos=DB::select("SELECT p.id as id, p.code as code, p.stock stock
        from products p where p.subcategory_id= '$subcategoria' group by p.id,p.code,p.stock");
       return view ('admin.subcategory.show', compact('subcategory','subcategoria','productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Subcategory $subcategory)
    {
        return view ('admin.subcategory.edit', compact('category','subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request,Category $category, Subcategory $subcategory)
    {
        $subcategory->my_update($request);
        return redirect()->route('categories.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return back();
        //return redirect()->route('subcategories.index');

    }
}
