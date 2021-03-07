<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function subcategories()
    {
        return $this->belongsToMany('App\Models\SubCategory')->withTimestamps();
    }
    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }
    public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher');
    }
    public function category()
    {
        return $this->hasManyThrough('App\Models\Category', 'App\Models\SubCategory', 'category_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    public function wishlist_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    public function book_orders()
    {
        return $this->belongsToMany('App\Models\BookOrder');
    }
}
