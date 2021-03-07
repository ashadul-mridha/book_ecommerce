<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    protected $table = 'book_order';
    protected $fillable = ['order_id', 'book_id', 'quantity'];
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order','book_order', 'id', 'order_id');
    }
    public function books()
    {
        return $this->belongsToMany('App\Models\Book','book_order', 'id', 'book_id');
    }
}
