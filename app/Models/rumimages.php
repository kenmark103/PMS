<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rumimages extends Model
{
    //
    protected $fillable=[
      'rooms_id','source',
    ];
    public function apartment(){
      return $this->belongsTo('App\Models\Rooms','rooms_id');
    }
}
