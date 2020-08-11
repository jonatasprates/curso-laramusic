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
    
    public $rules = [
        'name'  => 'required|min:3|max:100',
        'email' => 'required|email|min:3|max:100|unique:users',
        'password' => 'required|min:6|max:20'
    ];
    
    
}
