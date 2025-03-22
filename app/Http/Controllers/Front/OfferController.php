<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use OfferTrait;
    //
    public function create(){
        return view('ajaxOffers.create');
    }

    public function store(OfferRequest $request){

        $file_name = $this->saveImage($request->photo , 'images/offers');

        $offer =Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'offer_price' => $request->offer_price ,
            'detail_ar' => $request->detail_ar,
            'detail_en' => $request->detail_en
        ]);
        if($offer){
            return response()->json([
                'status' => true,
                'msg' => 'Offer created successfully'
            ]);
        }else
        {
            return response()->json([
                'status' => false,
                'msg' => 'fail offer creating'
            ]);
        }

    }
    public function getAll(){}
    public function edit(){}
    public function update(){}
    public function delete(){}
}
