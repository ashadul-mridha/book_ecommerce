<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookOrder;
use App\Models\Division;
use App\Models\District;
use App\Notifications\OrderNotification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use PhpParser\Node\Expr\AssignOp\Div;

// use Spatie\Permission\Models\Role;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Cart::isEmpty()) {
            return redirect('/');
        }
        return view('frontend.checkout');
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'method' => 'required',
        ], [
            'method.required' => 'Please Choose A Payment Method'
        ]);
        $discount = 0;
        if (Cart::getCondition('Coupon_Code')) {
            $discount =  Cart::getCondition('Coupon_Code')->getCalculatedValue(Cart::getSubTotal());
        }
        $shipping = 0;
        foreach (Cart::getConditions() as $cartCondition) {
            if ($cartCondition->getType() == 'shipping') {
                $shipping =  str_replace(array('%', '-', '+'), '', $cartCondition->getValue());
            }
        }
        $city = Division::findOrFail($request->city_name)->name;
        // insert order table
        $order = new Order();
        $order->user_id = Auth::user() ? Auth::user()->id : null;
        $order->billing_full_name = $request->full_name;
        $order->billing_company = $request->company;
        $order->billing_address = $request->address;
        $order->billing_address_two = $request->address_two;
        $order->billing_city = $city;
        $order->billing_country = $request->country_name;
        $order->billing_post_code = $request->post_code;
        $order->billing_phone = $request->phone;
        $order->billing_email = $request->email;
        $order->billing_order_note = $request->order_notes;
        $order->payment_gatway = $request->method;
        $order->billing_discount = $discount;
        $order->billing_subtotal = Cart::getSubTotalWithoutConditions();
        $order->billing_shipping = $shipping;
        $order->billing_total = Cart::getTotal();
        $order->save();
        // insert into bookorder table
        foreach (Cart::getContent() as $item) {
            BookOrder::create([
                'order_id' => $order->id,
                'book_id' => $item->associatedModel->id,
                'quantity' => $item->quantity,
            ]);
            $book = Book::find($item->associatedModel->id);
            $book->decrement('quantity', $item->quantity);
        }
        Cart::clearCartConditions();
        Cart::clear();
        $users = User::role('super-admin')->get();
        // Notification::send($users, new OrderNotification($order));

        // return view('frontend.cash_on', compact('order'));
        if ($request->method == 'bkash_pay') {
            return redirect()->route('bkash.payment', ['orderid' => $order->id]);
        } else {
            return redirect()->route('confirm.order', $order->id);
        }
    }
    public function ajax_city($id)
    {
       $division = District::findOrFail($id);
       $districts = $division->upazilas;
        // $districts = DB::table('districts')
        //             ->join('upazilas','districts.id','upazilas.district_id')
        //             ->select('upazilas.*')
        //             ->where('district_id',$id)
        //             ->orderBy('id','desc')
        //             ->get();
       $district = '';
       foreach ($districts as $dis):
        $district .= '<option value="'.$dis->name.'">'.$dis->name.'</option>';
       endforeach;
       return response(['division' => $division->name, 'districts' => $district]);
    }

    // delivery type for shipping free
    public function delivery_type(Request $request)
    {
        if ($request->delivery_type == 'rocket_pay' || $request->delivery_type == 'bkash_pay') {
            $shipping = 50;
            Cart::removeCartCondition('shipping_' . 50);
            Cart::removeCartCondition('shipping_' . 100);
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'shipping_' . $shipping,
                'type' => 'shipping',
                'target' => 'total',
                'value' => '+' . $shipping,
                'order' => 1
            ));
            Cart::condition($condition);
        }else if($request->delivery_type == 'nagad_pay'){
            $shipping = 100;
            Cart::removeCartCondition('shipping_' . 50);
            Cart::removeCartCondition('shipping_' . 50);
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'shipping_' . $shipping,
                'type' => 'shipping',
                'target' => 'total',
                'value' => '+' . $shipping,
                'order' => 1
            ));
            Cart::condition($condition);
        }
        else {
            $shipping = 50;
           Cart::removeCartCondition('shipping_' . 50);
           Cart::removeCartCondition('shipping_' . 100);
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'shipping_' . $shipping,
                'type' => 'shipping',
                'target' => 'total',
                'value' => '+' . $shipping,
                'order' => 1
            ));
            Cart::condition($condition);
        }
        $shipping_view = '
                    <div class="bx_shipping_name bx_font_14_r">Shipping</div>
                        <div class="bx_check_out_shipping_list text-right">
                        <span class="flat bx_font_po_m_18 bx_book_shipping_free">Tk. ' . $shipping . '</span>
                    </div>';
        $total = Cart::getTotal();
        return response(['total' => $total, 'shipping' => $shipping_view]);
    }

    public function confirm_order($id)
    {
        $order = Order::findOrFail($id);
        return view('frontend.confirm_order', compact('order'));
    }
    public function bkash_payment(Request $request)
    {
        $id = $request->orderid;
        $order = Order::find($id);
        if (!$order) {
            return back();
        }
        return view('frontend.bkash_payment', compact('order'));
    }
}
