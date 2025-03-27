<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';
    public $table = 'admins';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];
    public $timestamps = false;

}
