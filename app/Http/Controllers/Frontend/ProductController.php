<?php

namespace App\Http\Controllers\Frontend;

use Cart;
// use App\Models\Cart;
use Toastr;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Search;
use App\Models\Category;

class ProductController extends Controller
{
    // code for cart details page
    public function cart_view(Request $request)
    {
        $cart_items = Cart::getContent();
        // remove shipping condition
        Cart::removeConditionsByType('shipping');
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $all_categories = Category::orderBy('id', 'desc')->get();
        return view('frontend.cart', compact('cart_items','searchs','all_categories'));
    }
    // code for add to cart
    public function add_to_cart(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response(['error' => 'Something wrong try again!']);
        }
        if ($book->quantity == 0) {
            return response(['error' => 'Out Of Stock 😥😥😥']);
        }
        if ($request->qty) {
            $qty = $request->qty;
        } else {
            $qty = 1;
        }
        $name = $book->title;
        $price = ($book->discount != null ? ($book->price - ($book->price * $book->discount) / 100) : $book->price);

        if (Cart::get($id)) {
            Cart::update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $qty
                ]
            ]);
            return response(['success' => 'Add to cart updated']);
        } else {
            Cart::add(array(
                'id' => $book->id,
                'name' => $name,
                'price' => $price,
                'quantity' => $qty,
                'attributes' => [
                    'photo' => $book->photo
                ],
                'associatedModel' => $book,
            ));

            $total = Cart::getContent()->count();
            return response(['success' => 'Add to cart successfully added', 'total' => $total]);
        }
    }
    // code for add to cart update
    public function cart_update(Request $request, $id)
    {
        if (!Cart::get($id)) {
            return response(['error' => 'Something wrong try again!']);
        }

        $qty = $request->qty;
        Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $qty
            ]
        ]);
        $item =  Cart::get($id);
        $price = $item->price;
        $qty = $item->quantity;
        $item_total = ($qty * $price);

        $subtotal = Cart::getSubTotalWithoutConditions();
        $gettotal = Cart::getTotal();
        return response(['item_total' => $item_total, 'subtotal' => $subtotal, 'gettotal' => $gettotal]);
    }

    // code for cart remove
    public function cart_delete($id)
    {
        $cart = Cart::get($id);
        if (!$cart) {
            return ['error' => 'Something wrong place try again !'];
        }
        Cart::remove($id);
        $total = Cart::getContent()->count();
        $subtotal = Cart::getSubTotalWithoutConditions();

        $gettotal = Cart::getTotal();
        if (Cart::isEmpty()) {
            Cart::clearCartConditions();
        }
        return  ['success' => 'Cart item remove successfully', 'total' => $total, 'subtotal' => $subtotal, 'gettotal' => $gettotal];
    }



    // code for book wishlist
    public function book_wishlist($id)
    {
        if (!Book::find($id)) {
            return ['error' => 'Something wrong try again!'];
        }
        $user = Auth::user();
        if (!$user) {
            return ['error' => 'First, need to log in'];
        } else {
            $is_wishlist = $user->wishlist_books()->where('book_id', $id)->count();
            if ($is_wishlist == 0) {
                $user->wishlist_books()->attach($id);
                $total = Book::find($id)->wishlist_to_users->count();
                return ['success' => 'Book successfuly added to wishlist', 'total' => $total];
            } else {
                $user->wishlist_books()->detach($id);
                $total = Book::find($id)->wishlist_to_users->count();
                return ['remove' => 'The book has been removed from the wish list', 'total' => $total];
            }
        }
    }

    // code for coupon
    public function cart_coupon($code)
    {

        if (Coupon::where('code', $code)->exists()) {
            $coupon_validate = Coupon::where('code', $code)->first()->validate;
            $today_date = Carbon::now()->format('Y-m-d');
            if ($today_date <= $coupon_validate) {
                $coupon_discount = Coupon::where('code', $code)->first()->discount;
                $condition = new \Darryldecode\Cart\CartCondition(array(
                    'name' => 'Coupon_Code',
                    'type' => 'coupon',
                    'target' => 'subtotal',
                    'value' => '-' . $coupon_discount . '%',
                    'order' => 1
                ));
                Cart::condition($condition);
                $gettotal = Cart::getTotal();
                $coupon_view = '<td>Coupon</td><td class="bx_cart_pr"><span class=" bx_font_po_m">-' . $coupon_discount . '%</span></td>';
                return response(['discount' => $coupon_discount, 'gettotal' => $gettotal, 'coupon_view' => $coupon_view]);
            } else {
                return response(['error' => "Your coupon expired!"]);
            }
        } else {
            return response(['error' => "Invalid  Coupon Code!"]);
        }
    }
}
