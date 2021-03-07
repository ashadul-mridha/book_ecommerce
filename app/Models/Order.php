<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',  'billing_full_name', 'billing_company', 'billing_address', 'billing_address_two',
        'billing_city', 'billing_country', 'billing_post_code', 'billing_phone', 'billing_email', 'billing_order_note',
        'payment_gatway', 'billing_discount', 'billing_discount_code', 'billing_subtotal', 'billing_shipping', 'billing_total',
        'order_status',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function books()
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('quantity');
    }
    public function cancels()
    {
        return $this->belongsTo('App\Models\CancelOrder');
    }
}
