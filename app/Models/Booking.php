<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'rooms_id', 'users_id','apartments_id'
    ];


    public function room(){
      return $this->hasOne('App\Models\Rooms','rooms_id');
    }
    public function user(){
      return $this->hasOne('App\User','users_id');
    }
    public function apartment(){
      return $this->belongsTo('App\Models\Apartments','apartments_id');
    }

}
