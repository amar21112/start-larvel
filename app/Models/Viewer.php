<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewer extends Model
{
    protected $table = 'viewers';
    protected $fillable = ['video_id' , 'user_id'];
    public $timestamps = false;
}
