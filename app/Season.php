<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
   public $guarded = [];
    public function records(){
        return $this->hasMany('App\Record');
    }

}
