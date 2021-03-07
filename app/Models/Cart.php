<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function books()
    {
        return $this->hasOne('App\Models\Book', 'id', 'book_id');
    }
}
