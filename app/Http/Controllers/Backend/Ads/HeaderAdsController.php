<?php

namespace App\Http\Controllers\Backend\Ads;

use App\Models\AdsHeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class HeaderAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads_all = AdsHeader::all();

        return view('backend.ads.header.index', compact('ads_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ads.header.create');
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
            $ads = $request->file('image');
            $request->validate([
                'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
            ]);
            $ads_name = date("Ymdhis") . '.' . $ads->getClientOriginalExtension();
            Image::make($ads)->resize(360, 50)->save(base_path('public/images/ads/header/' . $ads_name), 100);
        }
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $ads = new AdsHeader();
        $ads->image = $ads_name;
        $ads->link = $request->link;
        $ads->status = $status;
        $ads->save();
        return redirect()->route('admin.adsheader.index')->with('success', 'Data is successfully saved');
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
        $ads = AdsHeader::findOrFail($id);
        return view('backend.ads.header.edit', compact('ads'));
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
            $ads = $request->file('image');
            $request->validate([
                'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
            ]);
            $ads_name = date("Ymdhis") . '.' . $ads->getClientOriginalExtension();
            $link = base_path('public/images/ads/header/' . AdsHeader::find($id)->image);
            if (file_exists($link)) {
                unlink($link);
            }
            Image::make($ads)->resize(360, 50)->save(base_path('public/images/ads/header/' . $ads_name), 100);
            $ads = AdsHeader::findOrFail($id);
            $ads->image = $ads_name;
            $ads->save();
        }
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $ads = AdsHeader::findOrFail($id);
        $ads->link = $request->link;
        $ads->status = $status;
        $ads->save();
        return redirect()->route('admin.adsheader.index')->with('success', 'Data is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = AdsHeader::findOrFail($id);
        $destroy->delete();
        $link = base_path('public/images/ads/header/' . $destroy->image);
            if (file_exists($link)) {
                unlink($link);
            }
        return redirect()->route('admin.adsheader.index')->with('success', 'Data is successfully deleted'); //
    }
}
