<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    //
    protected $fillable=[
     'apartments_id','room_no','type','price'
    ];

    public function apartment(){
      return $this->belongsTo('App\Models\Apartments','apartments_id');
    }
    public function roompayments()
    {
      return $this->hasmany('App\Models\room_payments','rooms_id');
    }
    public function tenants()
    {
      return $this->hasMany('App\Models\Tenant','rooms_id');
    }
    public function bookings()
    {
      return $this->hasMany('App\Models\Bookings','rooms_id');
    }
    public function usersBooked()
    {
      return $this->belongsToMany('App\User','bookings','users_id','rooms_id');
    }
    public function users()
    {
      return $this->belongsToMany('App\User','tenants','rooms_id','users_id');
    }
    public function usersPayments()
    {
      return $this->belongsToMany('App\User','room_payments','rooms_id','users_id');
    }
}
