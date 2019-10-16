<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //comment
    protected $guarded=[];

    public function user() {
        return $this->belongsTo(\App\User::class);
    }
}
