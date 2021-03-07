<?php

namespace App\Http\Controllers\Backend\Book;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();

        return view('backend.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupons.create');
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
            'code' => 'required|unique:coupons,code',
            'discount' => 'required',
            'validate' => 'required',
        ]);
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->validate = $request->validate;
        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', 'Data is successfully saved');
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
        $coupon = coupon::findOrFail($id);
        return view('backend.coupons.edit', compact('coupon'));
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
            'code' => 'required|unique:coupons,code,' . $id,
            'discount' => 'required',
            'validate' => 'required',
        ]);
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->validate = $request->validate;
        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', 'Data is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Coupon::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Data is successfully deleted');
    }
}
