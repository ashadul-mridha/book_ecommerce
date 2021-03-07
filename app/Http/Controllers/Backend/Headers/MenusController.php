<?php

namespace App\Http\Controllers\Backend\Headers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();

        return view('backend.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        if (count($menus) > 0) {
            return redirect()->route('admin.menus.index')->with('success', 'No need to add more !');
        }
        return view('backend.menus.create');
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
            'item_one' => 'required',
            'item_two' => 'required',
            'item_three' => 'required',
            'item_four' => 'required',
            'item_five' => 'required',
            'item_six' => 'required',
        ]);

        $header = new Menu();
        $header->item_one = $request->item_one;
        $header->item_two = $request->item_two;
        $header->item_three = $request->item_three;
        $header->item_four = $request->item_four;
        $header->item_five = $request->item_five;
        $header->item_six = $request->item_six;
        $header->save();
        return redirect()->route('admin.menus.index')->with('success', 'Data is successfully saved');
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
        $menu = Menu::findOrFail($id);
        return view('backend.menus.edit', compact('menu'));
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
            'item_one' => 'required',
            'item_two' => 'required',
            'item_three' => 'required',
            'item_four' => 'required',
            'item_five' => 'required',
            'item_six' => 'required',
        ]);

        $header = Menu::findOrFail($id);
        $header->item_one = $request->item_one;
        $header->item_two = $request->item_two;
        $header->item_three = $request->item_three;
        $header->item_four = $request->item_four;
        $header->item_five = $request->item_five;
        $header->item_six = $request->item_six;
        $header->save();
        return redirect()->route('admin.menus.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Menu::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Data is successfully deleted');
    }
}
