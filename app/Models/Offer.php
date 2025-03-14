<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $table = 'offers';
    protected $fillable = ['name_ar','name_en' ,'detail_ar', 'detail_en' , 'offer_price'  , 'created_at' , 'updated_at'];
    protected $hidden = ['created_at' , 'updated_at' ];
    public $timestamps = false;
}
