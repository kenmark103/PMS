<?php

namespace App;

use App\Models\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\notifications;

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

    public function roomsBooked()
    {
      return $this->belongsToMany('App\Models\Rooms','bookings','users_id','rooms_id')->withTimestamps();
    }
    public function bookings()
    {
      return $this->hasMany('App\Models\Bookings','users_id')->withTimestamps();
    }
    public function tenants()
    {
      return $this->hasMany('App\Models\Tenant','users_id');
    }
    public function payments()
    {
      return $this->hasMany('App\Models\Payments','users_id');
    }
    public function rooms()
    {
      return $this->belongsToMany('App\Models\Rooms','tenants','users_id','rooms_id')->withTimestamps();
    }
    public function roomPayments()
    {
      return $this->belongsToMany('App\Models\Rooms','room_payments','users_id','rooms_id')->withTimestamps();
    }
    public function messages()
    {
      return $this->belongsTo(Message::class);
    }
}
