<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function isAdmin()
    {
        $out = false;
        if($this->role->name == "administrator" && $this->status == 1){
            $out = true;
        }
        return $out;
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function getGravatarAttribute()
    {
        $hash = sha1(strtolower(trim($this->attributes['email'])))."?d=mm&s";
        return "http://www.gravatar.com/avatar/".$hash;
    }
}
