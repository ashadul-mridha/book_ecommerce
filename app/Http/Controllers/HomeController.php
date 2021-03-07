<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_books = Book::all()->count();
        $orders = Order::orderBy('id', 'desc')->get();
        return view('backend.dashboard', compact('all_books','orders'));
    }
}
