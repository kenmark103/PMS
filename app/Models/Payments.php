<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    //
    protected $fillable = [
       'users_id','amount','uniqueid'
    ];

    public function roomPayments()
    {
      return $this->hasOne('App\Models\room_payments','payments_id');
    }
}
