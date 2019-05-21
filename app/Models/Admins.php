<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
	use Notifiable;

    //
    protected $fillable = [
        'name', 'email', 'password','phonenumber','roles_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function apartment(){
      return $this->hasOne('App\Models\Apartments','admins_id');
    }
    public function role(){
      return $this->belongsTo('App\Models\Roles','roles_id');
    }
    public function isSuperAdmin(){
      return $this->role()->where('name', 'admin')->exists();
    }

}
