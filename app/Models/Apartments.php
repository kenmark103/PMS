<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartments extends Model
{
    //
    protected $fillable=[
      'name','location','description','cover','admins_id','map'
    ];

    public function admin(){
      return $this->hasOne('App\Models\Admins','admins_id');
    }
}
