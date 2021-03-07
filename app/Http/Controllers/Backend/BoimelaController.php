<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\BoimelaCategory;
use App\Http\Controllers\Controller;

class BoimelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boimelacategory = BoimelaCategory::all();

        return view('backend.boimelacategory.index', compact('boimelacategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $boimelacategory = BoimelaCategory::all();
        if ($boimelacategory->count() > 0) {
            return redirect()->route('admin.categoryboimela.index')->with('success', 'No Need to Add More Category');
        }
        return view('backend.boimelacategory.create', compact('categories'));
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
            'category_id' => 'required|unique:boimela_categories,category_id'
        ], [
            'category_id.unique' => 'Please Select Unique Category',
        ]);
        $status = 0;
        if ($request->status) {
            $status = 1;
        }
        $boimelacat = new BoimelaCategory();
        $boimelacat->category_id = $request->category_id;
        $boimelacat->status = $status;
        $boimelacat->save();
        return redirect()->route('admin.categoryboimela.index')->with('success', 'Data is successfully saved');
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
        $boimelacat = BoimelaCategory::findOrFail($id);
        return view('backend.boimelacategory.edit', compact('categories', 'boimelacat'));
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
            'category_id' => 'required|unique:boimela_categories,category_id,' . $id
        ], [
            'category_id.unique' => 'Please Select Unique Category',
        ]);
        $status = 0;
        if ($request->status) {
            $status = 1;
        }
        $boimelacat =  BoimelaCategory::findOrFail($id);
        $boimelacat->category_id = $request->category_id;
        $boimelacat->status = $status;
        $boimelacat->save();
        return redirect()->route('admin.categoryboimela.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = BoimelaCategory::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.categoryboimela.index')->with('success', 'Data is successfully deleted');
    }
}
