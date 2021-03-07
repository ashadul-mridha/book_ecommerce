<?php

namespace App\Http\Controllers\Backend\Book\Category;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class SubCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategorys = SubCategory::orderBy('id', 'asc')->get();
        return view('backend.subcategories.index', compact('subcategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('backend.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|min:3',
        ]);

        $subcategory = new SubCategory();
        $subcategory->title = $request->title;
        $subcategory->slug = strtolower($request->title);
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        return redirect()->route('admin.subcategories.index')->with('success', 'Data is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|min:3',
        ]);

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->title = $request->title;
        $subcategory->slug = strtolower($request->title);
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        return redirect()->route('admin.subcategories.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = SubCategory::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'Data is successfully deleted');
    }
}
