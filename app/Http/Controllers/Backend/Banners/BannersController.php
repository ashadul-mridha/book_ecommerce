<?php

namespace App\Http\Controllers\Backend\Banners;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();

        return view('backend.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banners.create');
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
            'image' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $banner = $request->file('image');
            $request->validate([
                'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
            ]);
            $banner_name = date("Ymdhis") . '.' . $banner->getClientOriginalExtension();
            Image::make($banner)->resize(1300, 350)->save(base_path('public/images/banner/' . $banner_name), 100);
        }
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $banner = new Banner();
        $banner->image = $banner_name;
        $banner->status = $status;
        $banner->save();
        return redirect()->route('admin.banners.index')->with('success', 'Data is successfully saved');
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
        $banner = Banner::findOrFail($id);
        return view('backend.banners.edit', compact('banner'));
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
        if ($request->hasFile('image')) {
            $banner = $request->file('image');
            $request->validate([
                'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
            ]);
            $banner_name = date("Ymdhis") . '.' . $banner->getClientOriginalExtension();
            $link = base_path('public/images/banner/' . Banner::find($id)->image);
            if (file_exists($link)) {
                unlink($link);
            }
            Image::make($banner)->resize(1300, 350)->save(base_path('public/images/banner/' . $banner_name), 100);
            $banner = Banner::findOrFail($id);
            $banner->image = $banner_name;
            $banner->save();
        }
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $banner = Banner::findOrFail($id);
        $banner->status = $status;
        $banner->save();
        return redirect()->route('admin.banners.index')->with('success', 'Data is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Banner::findOrFail($id);
        $destroy->delete();
        $link = base_path('public/images/banner/' . $destroy->image);
            if (file_exists($link)) {
                unlink($link);
            }
        return redirect()->route('admin.banners.index')->with('success', 'Data is successfully deleted'); //
    }
}
