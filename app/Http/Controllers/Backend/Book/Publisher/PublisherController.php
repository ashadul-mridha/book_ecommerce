<?php

namespace App\Http\Controllers\Backend\Book\Publisher;

use App\Models\Publisher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();

        return view('backend.publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.publishers.create');
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
            'name' => 'required|unique:publishers,name',
        ]);
        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->description = $request->description;
        $publisher->save();
        $publisher_id = $publisher->id;
        $ran_name = strtolower(Str::random(11));
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $request->validate([
                'photo' => 'max:2048|mimes:jpeg,jpg,png',
            ]);
            $photo_name = $ran_name . '_' . $publisher_id . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(110, 110)->save(base_path('public/images/publisher/' . $photo_name), 100);
            $publisher = Publisher::find($publisher_id);
            $publisher->photo = $photo_name;
            $publisher->save();
        }
        return redirect()->route('admin.publishers.index')->with('success', 'Data is successfully saved');
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
        $publisher = Publisher::findOrFail($id);
        return view('backend.publishers.edit', compact('publisher'));
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
            'name' => 'required|unique:publishers,name,' . $id,
        ]);
        $publisher =  Publisher::findOrFail($id);
        $publisher->name = $request->name;
        $publisher->description = $request->description;
        $publisher->save();
        $ran_name = strtolower(Str::random(11));
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $request->validate([
                'photo' => 'max:2048|mimes:jpeg,jpg,png',
            ]);
            if (Publisher::find($id)->photo != 'publisher.png') {
                $link = base_path('public/images/publisher/' . Publisher::find($id)->photo);
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            $photo_name = $ran_name . '_' . $id . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(110, 110)->save(base_path('public/images/publisher/' . $photo_name), 100);
            $publisher = Publisher::find($id);
            $publisher->photo = $photo_name;
            $publisher->save();
        }
        return redirect()->route('admin.publishers.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Publisher::findOrFail($id);
        $destroy->delete();
        if ($destroy->photo != 'publisher.png') {
            $link = base_path('public/images/publisher/' . $destroy->photo);
            if (file_exists($link)) {
                unlink($link);
            }
        }
        return redirect()->route('admin.publishers.index')->with('success', 'Data is successfully deleted');
    }
}
