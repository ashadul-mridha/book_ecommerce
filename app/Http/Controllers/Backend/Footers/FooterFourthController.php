<?php

namespace App\Http\Controllers\Backend\Footers;

use App\Models\FooterFourth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterFourthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footers = FooterFourth::all();

        return view('backend.footers.fourth.index', compact('footers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $footers = FooterFourth::all();
        if (count($footers) > 0) {
            return redirect()->route('admin.fourth.index')->with('success', 'No need to add more !');
        }
        return view('backend.footers.fourth.create');
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
            'title' => 'required',
            'name.*' => 'required',
            'link.*' => 'required',
        ]);
        $name = implode('|', $request->name);
        $link = implode('|', $request->link);
        $footer = new FooterFourth();
        $footer->title = $request->title;
        $footer->name = $name;
        $footer->link = $link;
        $footer->save();
        return redirect()->route('admin.fourth.index')->with('success', 'Data is successfully saved');
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
        $footer = FooterFourth::findOrFail($id);
        return view('backend.footers.fourth.edit', compact('footer'));
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
            'title' => 'required',
            'name.*' => 'required',
            'link.*' => 'required',
        ]);
        $name = implode('|', $request->name);
        $link = implode('|', $request->link);
        $footer = FooterFourth::findOrFail($id);
        $footer->title = $request->title;
        $footer->name = $name;
        $footer->link = $link;
        $footer->save();
        return redirect()->route('admin.fourth.index')->with('success', 'Data is successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = FooterFourth::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.fourth.index')->with('success', 'Data is successfully deleted');
    }
}
