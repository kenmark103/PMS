<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartments extends Model
{
    //
    protected $fillable=[
      'name','location','description','cover','admins_id','slug','map'
    ];

    public function admin(){
      return $this->belongsTo('App\Models\Admins','admins_id');
    }
    public function roomImages(){
      return $this->hasMany('App\Models\roomImages','apartments_id');
    }
    public function rooms(){
      return $this->hasMany('App\Models\rooms','apartments_id');
    }
    public function bookings(){
      return $this->hasMany('App\Models\Booking','apartments_id');
    }
    public function tenants(){
      return $this->hasManyThrough('App\User','App\Models\Tenant','apartments_id','users_id');
    }
    public function bookedRooms(){
      return $this->hasManyThrough('App\Models\Rooms','App\Models\Tenant','apartments_id','rooms_id');
    }
}
