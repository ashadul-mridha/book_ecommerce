<?php

namespace App\Http\Controllers\Backend\Footers;

use App\Models\FooterFirst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class FooterFirstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footers = FooterFirst::all();

        return view('backend.footers.first.index', compact('footers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $footers = FooterFirst::all();
        if (count($footers) > 0) {
            return redirect()->route('admin.first.index')->with('success', 'No need to add more !');
        }
        return view('backend.footers.first.create');
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
            'description' => 'required',
            'social_icon.*' => 'required',
            'social_link.*' => 'required',
        ]);
        $icon = implode('|', $request->social_icon);
        $url = implode('|', $request->social_link);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $request->validate([
                'logo' => 'max:2048|mimes:jpeg,jpg,png,gif',
            ]);
            $logo_name = date("Ymdhis") . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(140, 36)->save(base_path('public/images/footer/' . $logo_name), 100);
            $footer = new FooterFirst();
            $footer->logo = $logo_name;
            $footer->description = $request->description;
            $footer->social_icon = $icon;
            $footer->social_link = $url;
            $footer->save();
        } else {
            $footer = new FooterFirst();
            $footer->description = $request->description;
            $footer->social_icon = $icon;
            $footer->social_link = $url;
            $footer->save();
        }
        return redirect()->route('admin.first.index')->with('success', 'Data is successfully saved');
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
        $footer = FooterFirst::findOrFail($id);
        return view('backend.footers.first.edit', compact('footer'));
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
            'description' => 'required',
            'social_icon.*' => 'required',
            'social_link.*' => 'required',
        ]);
        $icon = implode('|', $request->social_icon);
        $url = implode('|', $request->social_link);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $request->validate([
                'logo' => 'max:2048|mimes:jpeg,jpg,png,gif',
            ]);
            if (FooterFirst::find($id)->logo != 'logo.png') {
                $link = base_path('public/images/footer/' . FooterFirst::find($id)->logo);
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            $logo_name = date("Ymdhis") . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(140, 36)->save(base_path('public/images/footer/' . $logo_name), 100);
            $footer = FooterFirst::findOrFail($id);
            $footer->logo = $logo_name;
            $footer->description = $request->description;
            $footer->social_icon = $icon;
            $footer->social_link = $url;
            $footer->save();
        } else {
            $footer = FooterFirst::findOrFail($id);
            $footer->description = $request->description;
            $footer->social_icon = $icon;
            $footer->social_link = $url;
            $footer->save();
        }
        return redirect()->route('admin.first.index')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = FooterFirst::findOrFail($id);
        $destroy->delete();
        if ($destroy->logo != 'logo.png') {
            $link = base_path('public/images/footer/' . $destroy->logo);
            if (file_exists($link)) {
                unlink($link);
            }
        }
        return redirect()->route('admin.first.index')->with('success', 'Data is successfully deleted');
    }
}
