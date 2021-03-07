<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    protected $table = 'cancel_order';
    protected $fillable = ['order_id', 'reason','phone'];
    public function orders()
    {
        return $this->hasOne('App\Models\Order','id', 'order_id');
    }
}
