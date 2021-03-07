<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
   public function districts()
   {
    return $this->hasMany('App\Models\District');
   }
   public function upazilas()
   {
       return $this->hasManyThrough('App\Models\Upazila','App\Models\District');
   }
}
