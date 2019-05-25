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
    public function tenants(){
      return $this->hasMany('App\Models\Tenant','rooms_id');
    }
}
