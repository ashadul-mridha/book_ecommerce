<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
   public function upazilas()
   {
       return $this->hasMany('App\Models\Upazila');
   }
   public function division()
   {
       return $this->belongsTo('App\Models\Division');
   }
}
