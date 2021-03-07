<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CancelOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('backend.orders.index', compact('orders'));
    }
    // public function view_order($id)
    // {
    //     return '<h1>New order ' . $id . '</h1>';
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.orders.edit', compact('order'));
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
            'billing_full_name' => 'required|string',
            'billing_country' => 'required|string',
            'billing_post_code' => 'required|string',
            'billing_city' => 'required|string',
            'billing_address' => 'required|string',
            'billing_phone' => 'required|string',
            'payment_gatway' => 'required',
        ], [
            'payment_gatway.required' => 'Please Choose A Payment Method'
        ]);
        $order = Order::findOrFail($id);
        $order->billing_full_name = $request->billing_full_name;
        $order->billing_company = $request->billing_company;
        $order->billing_address = $request->billing_address;
        $order->billing_address_two = $request->billing_address_two;
        $order->billing_city = $request->billing_city;
        $order->billing_country = $request->billing_country;
        $order->billing_post_code = $request->billing_post_code;
        $order->billing_phone = $request->billing_phone;
        $order->billing_email = $request->billing_email;
        $order->billing_order_note = $request->billing_order_note;
        $order->payment_gatway = $request->payment_gatway;
        $order->payment_status = $request->payment_status;
        $order->payment_trid = $request->payment_trid;
        $order->order_status = $request->order_status;
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'Data is successfully saved');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Order::findOrFail($id);
        $destroy->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Data is successfully deleted');
    }


    // code for order cancel
    public function orders_cancels()
    {
        $cancels_orders = CancelOrder::orderBy('id', 'desc')->get();
        return view('backend.orders_cancels.index', compact('cancels_orders'));
    }
    public function order_cancel_view($id)
    {
        $cancel_order = CancelOrder::findOrFail($id);
        return view('backend.orders_cancels.show', compact('cancel_order'));
    }
}
