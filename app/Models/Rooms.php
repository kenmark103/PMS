<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    //
    protected $fillabe=[
      'apartments_id','room_no','type',
    ];

    public function apartment(){
      return $this->belongsTo('App\Models\Apartments','apartments_id');
    }
}
