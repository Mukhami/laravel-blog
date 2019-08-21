<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function post(){
        return $this->hasMany('App\Post', 'user_id');
    }
    public function likes(){
        return $this->hasMany('App\Like', 'user_id');
    }
    public function comment(){
        return $this->hasMany('App\Comment', 'user_id');
    }

    public function following(){
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'following_id' );
    }

//    public function hasliked($user){
//        return $this->likes()->where('user_id', $user->id)->count();
//    }
}
