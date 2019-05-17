<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    protected $fillable=[
      'name',
    ];

    public function admin(){
      return $this->hasMany('App\Models\Admins','roles_id');
    }
}
