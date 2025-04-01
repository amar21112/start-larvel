<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name_ar' => 'required|max:100|unique:offers,name_ar',
            'name_en' => 'required|max:100|unique:offers,name_en',
            'offer_price' => 'required|numeric',
            'detail_ar' => 'required',
            'detail_en' => 'required',
        ];
    }

    /*
     *  Get messages that show to respond in error.
     *
     * return array
     * */
    public function messages(){
        return $messages = [
            'photo.required'=>'photo is required',
            'photo.image'=>'photo is not valid',
            'photo.mimes'=>'photo is not valid',
            'photo.max'=>'photo is too large',
            'name_ar.required'=>__('messages.offer_name_required'),
            'name_en.required'=>__('messages.offer_name_required'),
            'name_ar.unique'=>__('messages.offer_name_unique'),
            'name_en.unique'=>__('messages.offer_name_unique'),
            'offer_price.required'=>__('messages.offer_price_required'),
            'offer_price.numeric'=>__('messages.offer_price_numeric'),
            'detail_ar.required'=>__('messages.offer_details_required'),
            'detail_en.required'=>__('messages.offer_details_required'),
        ];
    }
}
