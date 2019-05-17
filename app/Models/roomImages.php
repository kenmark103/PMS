<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roomImages extends Model
{
    //
    protected $fillable=[
      'apartments_id','source',
    ];
    public function apartment(){
      return $this->belongsTo('App\Models\Apartments','apartments_id');
    }
}
