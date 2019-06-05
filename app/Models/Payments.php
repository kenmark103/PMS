<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Payments extends Model
{
    //
  use Searchable;
  
    protected $fillable = [
       'users_id','amount','uniqueid','status'
    ];

    public function roomPayments()
    {
      return $this->hasOne('App\Models\room_payments','payments_id');
    }
    public function user()
    {
      return $this->belongsTo('App\User','users_id');
    }
}
