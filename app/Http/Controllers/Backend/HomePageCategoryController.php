<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageCategory;
use Illuminate\Http\Request;

class HomePageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homepagecategories = HomePageCategory::all();

        return view('backend.homepagecategories.index', compact('homepagecategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.homepagecategories.create', compact('categories'));
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
            'category_id' => 'required|unique:home_page_categories,category_id'
        ], [
            'category_id.unique' => 'Please Select Unique Category',
        ]);
        $status = 0;
        if ($request->status) {
            $status = 1;
        }
        $homepagecat = new HomePageCategory();
        $homepagecat->category_id = $request->category_id;
        $homepagecat->status = $status;
        $homepagecat->save();
        return redirect()->route('admin.homepagecategory.index')->with('success', 'Data is successfully saved');
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
        $categories = Category::all();
        $homepagecat = HomePageCategory::findOrFail($id);
        return view('backend.homepagecategories.edit', compact('categories', 'homepagecat'));
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
            'category_id' => 'required|unique:home_page_categories,category_id,' . $id
        ], [
            'category_id.unique' => 'Please Select Unique Category',
        ]);
        $status = 0;
        if ($request->status) {
            $status = 1;
        }
        $homepagecat =  HomePageCategory::findOrFail($id);
        $homepagecat->category_id = $request->category_id;
        $homepagecat->status = $status;
        $homepagecat->save();
        return redirect()->route('admin.homepagecategory.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = HomePageCategory::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.homepagecategory.index')->with('success', 'Data is successfully deleted');
    }
}
