<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
    public function wishlist_books()
    {
        return $this->belongsToMany('App\Models\Book')->withTimestamps();
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
