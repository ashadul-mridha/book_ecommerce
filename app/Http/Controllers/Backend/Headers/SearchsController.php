<?php

namespace App\Http\Controllers\Backend\Headers;

use App\Http\Controllers\Controller;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchs = Search::all();

        return view('backend.searchs.index', compact('searchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $searchs = Search::all();
        if (count($searchs) > 0) {
            return redirect()->route('admin.searchs.index')->with('success', 'No need to add more !');
        }
        return view('backend.searchs.create');
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
            'categorie_icon' => 'required',
            'categorie_name' => 'required',
            'search_placeholder' => 'required',
            'search_icon' => 'required',
            'offer_name' => 'required',
            'offer_second_name' => 'required',
        ]);

        $header = new Search();
        $header->categorie_icon = $request->categorie_icon;
        $header->categorie_name = $request->categorie_name;
        $header->search_placeholder = $request->search_placeholder;
        $header->search_icon = $request->search_icon;
        $header->offer_name = $request->offer_name;
        $header->offer_second_name = $request->offer_second_name;
        $header->save();
        return redirect()->route('admin.searchs.index')->with('success', 'Data is successfully saved');
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
        $search = Search::findOrFail($id);
        return view('backend.searchs.edit', compact('search'));
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
            'categorie_icon' => 'required',
            'categorie_name' => 'required',
            'search_placeholder' => 'required',
            'search_icon' => 'required',
            'offer_name' => 'required',
            'offer_second_name' => 'required',
        ]);

        $header = Search::findOrFail($id);
        $header->categorie_icon = $request->categorie_icon;
        $header->categorie_name = $request->categorie_name;
        $header->search_placeholder = $request->search_placeholder;
        $header->search_icon = $request->search_icon;
        $header->offer_name = $request->offer_name;
        $header->offer_second_name = $request->offer_second_name;
        $header->save();
        return redirect()->route('admin.searchs.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Search::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.searchs.index')->with('success', 'Data is successfully deleted');
    }
}
