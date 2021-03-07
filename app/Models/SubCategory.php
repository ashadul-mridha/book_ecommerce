<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'title', 'slug', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function books()
    {
        return $this->belongsToMany('App\Models\Book')->withTimestamps();
    }
}
