<?php

namespace App\Models;

use App\Scopes\OfferScopes;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $table = 'offers';
    protected $fillable = ['photo' , 'name_ar','name_en' ,'detail_ar', 'detail_en' , 'offer_price' ,'status' , 'created_at' , 'updated_at'];
    protected $hidden = ['created_at' , 'updated_at' ];
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OfferScopes);
    }
    public function scopeInactive($query){
        return $query->where('status' , 0) ;
    }

    public function scopeInvalid($query){
        return $query->where('status' , 0)->whereNull('photo');
    }

    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = strtoupper($value);
    }
}
