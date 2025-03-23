<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
    public function getAll(){
        $locale = $locale = LaravelLocalization::getCurrentLocale();

        $offers = Offer::select(
            'id',
            'offer_price',
            'photo',
            'name_'.$locale.' as name',
            'detail_'.$locale.' as detail'
        )->get();

        return view('ajaxOffers.all', compact('offers'));
    }
    public function edit(){}
    public function update(){}
    public function deleteOffer(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'offer not found'
            ]);
        }

        $filename = $offer->photo;
        if (!empty($filename))
            $this->deleteImage( 'images/offers/',$filename);

        $offer->delete();
        return response()->json([
            'status' => true,
            'msg' => 'offer deleted successfully',
            'id' => $request->id
        ]);
    }

    public function editOffer(Request $request , $id){
        $offer =   Offer::find($id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'offer not found',
            ]);
        }
        $offer = Offer::select('id' ,'name_ar','name_en','offer_price','detail_ar','detail_en')->find($id);
        return view('ajaxOffers.edit', compact('offer'));
    }

    public function updateOffer(Request $request){
        $offer = Offer::find($request->offer_id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'offer not found'
            ]);
        }

        $offer->update($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'offer updated successfully'
        ]);
    }
}
