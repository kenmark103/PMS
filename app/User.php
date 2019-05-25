<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phonenumber', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tenants(){
      return $this->hasMany('App\Models\Tenant','users_id');
    }
    public function getroom_noAttribute()
    {
      if ( ! array_key_exists('userRoom', $this->relations)) $this->loadRoom();

      return $this->getRelation('userRoom');
    }

    public function loadRoom()
    {
      dd($this->rooms->first());
      // $this->setRelation('userRoom', $this->rooms->first());
    }

    public function rooms()
    {
      return $this->belongsToMany('App\Models\Rooms','tenants','users_id','rooms_id');
    }
}
