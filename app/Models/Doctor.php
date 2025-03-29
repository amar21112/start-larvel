<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable = ['id' , 'name' , 'title' , 'hospital_id', 'created_at' , 'updated_at'];
    protected $hidden = ['hospital_id','created_at' , 'updated_at'];
    public $timestamp = true;

    public function hospital(){
        return $this->belongsTo('App\Models\hospital' , 'hospital_id','id');
    }

}
