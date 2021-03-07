<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title'
    ];

    public function subcategory()
    {
        return $this->hasMany('App\Models\SubCategory');
    }
    // public function books()
    // {
    //     return $this->hasManyThrough('App\Models\Book', 'App\Models\SubCategory', 'category_id', 'id');
    //     // $rootcategory =   DB::table('books')
    //     //     ->join('book_sub_category', function ($book){
    //     //         $book->on('books.id', 'book_sub_category.book_id');
    //     //     })
    //     //     ->join('sub_categories', function ($sub){
    //     //         $sub->on('book_sub_category.sub_category_id', 'sub_categories.id');
    //     //     })
    //     //     ->join('categories', function ($cat){
    //     //         $cat->on('sub_categories.category_id', 'categories.id');
    //     //     })->select('books.*')
    //     //     ->where('categories.id', [2,10,5])
    //     //     ->distinct()
    //     //     ->get();
    //     //     return $rootcategory;
    // }
    public function books()
    {
       return $this->hasManyThrough('App\Models\Book', 'App\Models\SubCategory', 'category_id', 'id');
    }

}
