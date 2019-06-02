<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class room_payments extends Model
{
    //
    protected $fillable = [
    	'rooms_id','users_id','payments_id','amount','periodofpayment', 'expirydate',
    ];

    public function payment()
    {
      return $this->belongsTo('App\Models\Payments','payments_id');
    }
    public function room(){
      return $this->belongsTo('App\Models\Rooms','rooms_id');
    }
}
