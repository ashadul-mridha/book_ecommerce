<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoimelaCategory extends Model
{
    public function category()
    {
        return $this->hasOne('App\Models\Category','id', 'category_id');
    }
}
