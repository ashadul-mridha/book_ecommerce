<?php

namespace App\Http\Controllers\Backend\Ads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdsBottom;
use Intervention\Image\Facades\Image;

class BottomAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads_all = AdsBottom::all();

        return view('backend.ads.bottom.index', compact('ads_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ads.bottom.create');
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
            'image_two' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $ads = $request->file('image');
            $request->validate([
                'image' => 'max:10000|mimes:jpeg,jpg,png,gif',
            ]);
            $ads_name = date("Ymdhis") . '.' . $ads->getClientOriginalExtension();
            Image::make($ads)->resize(650, 220)->save(base_path('public/images/ads/bottom/' . $ads_name), 100);
        }
        if ($request->hasFile('image_two')) {
            $ads = $request->file('image_two');
            $request->validate([
                'image_two' => 'max:10000|mimes:jpeg,jpg,png,gif',
            ]);
            $ads_name_two = rand(10, 1000) . '_' . date("Ymdhis") . '.' . $ads->getClientOriginalExtension();
            Image::make($ads)->resize(650, 220)->save(base_path('public/images/ads/bottom/' . $ads_name_two), 100);
        }
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $ads = new AdsBottom();
        $ads->image = $ads_name;
        $ads->image_two = $ads_name_two;
        $ads->link = $request->link;
        $ads->link_two = $request->link_two;
        $ads->status = $status;
        $ads->save();
        return redirect()->route('admin.adsbottom.index')->with('success', 'Data is successfully saved');
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
        $ads = AdsBottom::findOrFail($id);
        return view('backend.ads.bottom.edit', compact('ads'));
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
            $link = base_path('public/images/ads/bottom/' . AdsBottom::find($id)->image);
            if (file_exists($link)) {
                unlink($link);
            }
            Image::make($ads)->resize(650, 220)->save(base_path('public/images/ads/bottom/' . $ads_name), 100);
            $ads = AdsBottom::findOrFail($id);
            $ads->image = $ads_name;
            $ads->save();
        }
        if ($request->hasFile('image_two')) {
            $ads = $request->file('image_two');
            $request->validate([
                'image_two' => 'max:10000|mimes:jpeg,jpg,png,gif',
            ]);
            $ads_name = rand(10, 1000) . '_' . date("Ymdhis") . '.' . $ads->getClientOriginalExtension();
            $link = base_path('public/images/ads/bottom/' . AdsBottom::find($id)->image_two);
            if (file_exists($link)) {
                unlink($link);
            }
            Image::make($ads)->resize(650, 220)->save(base_path('public/images/ads/bottom/' . $ads_name), 100);
            $ads = AdsBottom::findOrFail($id);
            $ads->image_two = $ads_name;
            $ads->save();
        }
        $status = 0;
        if ($request->status) :
            $status = 1;
        endif;
        $ads = AdsBottom::findOrFail($id);
        $ads->link = $request->link;
        $ads->link_two = $request->link_two;
        $ads->status = $status;
        $ads->save();
        return redirect()->route('admin.adsbottom.index')->with('success', 'Data is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = AdsBottom::findOrFail($id);
        $destroy->delete();
        $link = base_path('public/images/ads/bottom/' . $destroy->image);
        if (file_exists($link)) {
            unlink($link);
        }
        $link_two = base_path('public/images/ads/bottom/' . $destroy->image_two);
        if (file_exists($link_two)) {
            unlink($link_two);
        }
        return redirect()->route('admin.adsbottom.index')->with('success', 'Data is successfully deleted'); //
    }
}
