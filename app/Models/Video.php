<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $table = 'videos';
    protected $fillable = ['name' , 'viewer'];
    public $timestamps = false;
}
