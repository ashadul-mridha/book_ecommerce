<?php

namespace App\Http\Controllers\Backend\Book\Author;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();

        return view('backend.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.authors.create');
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
            'name' => 'required|unique:authors,name',
        ]);
        $author = new Author();
        $author->name = $request->name;
        $author->description = $request->description;
        $author->save();
        $author_id = $author->id;
        $ran_name = strtolower(Str::random(11));
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $request->validate([
                'photo' => 'max:2048|mimes:jpeg,jpg,png',
            ]);
            $photo_name = $ran_name . '_' . $author_id . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(110, 110)->save(base_path('public/images/author/' . $photo_name), 100);
            $author = Author::find($author_id);
            $author->photo = $photo_name;
            $author->save();
        }
        return redirect()->route('admin.authors.index')->with('success', 'Data is successfully saved');
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
        $author = Author::findOrFail($id);
        return view('backend.authors.edit', compact('author'));
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
            'name' => 'required|unique:authors,name,' . $id,
        ]);
        $author =  Author::findOrFail($id);
        $author->name = $request->name;
        $author->description = $request->description;
        $author->save();
        $ran_name = strtolower(Str::random(11));
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $request->validate([
                'photo' => 'max:2048|mimes:jpeg,jpg,png',
            ]);
            if (Author::find($id)->photo != 'author.png') {
                $link = base_path('public/images/author/' . Author::find($id)->photo);
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            $photo_name = $ran_name . '_' . $id . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(110, 110)->save(base_path('public/images/author/' . $photo_name), 100);
            $author = Author::find($id);
            $author->photo = $photo_name;
            $author->save();
        }
        return redirect()->route('admin.authors.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Author::findOrFail($id);
        $destroy->delete();
        if ($destroy->photo != 'author.png') {
            $link = base_path('public/images/author/' . $destroy->photo);
            if (file_exists($link)) {
                unlink($link);
            }
        }
        return redirect()->route('admin.authors.index')->with('success', 'Data is successfully deleted');
    }
}
