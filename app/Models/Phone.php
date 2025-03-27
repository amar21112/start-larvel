<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    //
    protected $table = 'phone';
    protected $fillable = ['code' , 'phone' , 'user_id'];
    protected $hidden = ['id'];
    public $timestamps = false;

    // relations

    public function user(){
        return $this->belongsTo('App\User' , 'user_id' , 'id');
    }
}
