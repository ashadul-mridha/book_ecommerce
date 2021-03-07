<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class PDFController extends Controller
{
    public function invoice_view($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.orders.invoice_view', compact('order'));
    }
    public function invoice_pdf($id)
    {
        $order = Order::findOrFail($id);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('backend.orders.invoice_view', ['order' => $order]);
        return $pdf->download('invoice_' . $order->id . '.pdf');
    }
}
