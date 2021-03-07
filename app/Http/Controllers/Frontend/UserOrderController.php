<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\Search;
use App\Models\Category;
use App\Models\CancelOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CancelOrderNotification;

class UserOrderController extends Controller
{
    public function index(Request $request)
    {
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $all_categories = Category::orderBy('id', 'desc')->get();
        $user = Auth::user();
        if ($request->id) {
            $orders = $user->orders->where('id', $request->id);
        } elseif ($request->id && $request->orderStatus) {
            $orders = $user->orders->where('id', $request->id)->where('order_status', $request->orderStatus);
        } else {
            $orders = $user->orders;
        }
        return view('frontend.user_order', compact('orders', 'user', 'all_categories', 'searchs'));
    }
    // code for user order cancel
    public function order_cancel(Request $request)
    {
        $message = $request->validate([
            'order_id' => 'required',
            'reason' => 'required',
        ]);
        $result = false;
        if (!$message) {
            return response(['error' => 'something wrong place try agin', 'result' => $result]);
        }
        $order = Order::findOrFail($request->order_id);
        if ($order->order_status == 'ON_SHIPPING' || $order->order_status == 'SHIPPED') {
            return response(['error' => 'Your Order Can\'t Cancel Now!', 'result' => $result]);
        }
        $cancel_order = new CancelOrder();
        $cancel_order->order_id = $request->order_id;
        $cancel_order->reason = $request->reason;
        $cancel_order->phone = $request->phone;
        $cancel_order->save();
        $order->order_status = 'CANCELLED';
        $order->save();
        $result = true;
        // notification send admin for order cancel
        $users = User::role('super-admin')->get();
        Notification::send($users, new CancelOrderNotification($cancel_order));
        return response(['success' => 'Your order cancel successfully', 'result' => $result]);
    }
    public function user_wishlist()
    {
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $all_categories = Category::orderBy('id', 'desc')->get();
        $user = Auth::user();
        return view('frontend.user_wishlist', compact('user', 'all_categories', 'searchs'));
    }
    public function user_wishlist_remove($id)
    {
        if (!Book::find($id)) {
            return ['error' => 'Something wrong try again!'];
        }
        $user = Auth::user();
        if (!$user) {
            return ['error' => 'First, need to log in'];
        } else {
            $wishlist = $user->wishlist_books()->where('book_id', $id)->count();
            if ($wishlist) {
                $user->wishlist_books()->detach($id);
            }
            $total = $user->wishlist_books()->count();
            return ['success' => 'The book has been removed from the wish list', 'total' => $total];
        }
    }
    public function user_review()
    {
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $all_categories = Category::orderBy('id', 'desc')->get();
        $user = Auth::user();
        return view('frontend.user_review', compact('user', 'all_categories', 'searchs'));
    }
}
