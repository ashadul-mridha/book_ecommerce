<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $fillable = [
        'logo', 'cart_icon', 'contact_icon', 'contact_number', 'button_name',
    ];
}
