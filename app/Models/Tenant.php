<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    //
    protected $fillable = [
        'rooms_id', 'users_id','apartments_id'
    ];
    protected $with = [
        'room', 'user','apartment'
    ];


    public function room(){
      return $this->belongsTo('App\Models\Rooms','rooms_id');
    }
    public function user(){
      return $this->belongsTo('App\User','users_id');
    }
    public function apartment(){
      return $this->belongsTo('App\Models\Apartments','apartments_id');
    }

}
