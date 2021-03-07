<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterFirst extends Model
{
    protected $fillable = [
        'logo', 'description', 'social_icon', 'social_link'
    ];
}
