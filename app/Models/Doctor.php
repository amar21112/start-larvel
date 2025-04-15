<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable = ['id' , 'name' , 'title' , 'hospital_id', 'medical_id', 'created_at' , 'updated_at'];
    protected $hidden = ['created_at' , 'updated_at'  ,'pivot'];
    public $timestamp = true;

    public function hospital(){
        return $this->belongsTo('App\Models\hospital' , 'hospital_id','id');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'doctor_service' , 'doctor_id' , 'service_id','id', 'id');
    }

    public function getGenderAttribute($value)
    {
        return $value = ($value == '0')?'Male':'Female';
    }

}
