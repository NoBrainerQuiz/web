<?php

namespace Models\App;

use Illuminate\Notifications\Notifiable;
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
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function activation()
    {
        return $this->hasOne('App\Models\Activation');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function quiz()
    {
        return $this->hasMany('App\Models\Quiz');
    }
}
