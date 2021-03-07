<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'home_name','about_name','page_name','blog_name','contact_name',
    ];
}
