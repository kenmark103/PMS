<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillabe=[
      'rooms_id','users_id',
    ];

    public function room(){
      return $this->belongsTo('App\Models\Rooms','rooms_id');
    }
    public function user(){
      return $this->belongsTo('App\User','users_id');
    }
}
