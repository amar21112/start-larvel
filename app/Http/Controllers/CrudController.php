<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Traits\OfferTrait;
use App\Scopes\OfferScopes;

class CrudController extends Controller
{

    use OfferTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function getOffers(){
        return Offer::get();

    }
//    public function store(){
//        Offer::create([
//            'offer_name' => 'Offer coaching two',
//            'offer_price' => 1000,
//            'offer_details' => 'offer to gym'
//        ]);
//    }

    public function create(){
        return view('offers.create');
    }

    public function store(OfferRequest $request){
        // validate data

//        $rules = $this->getRules();
//        $messages = $this->getMessages();
//        $validator = Validator::make($request->all(), $rules , $messages);
//
//
//        if($validator->fails()){
////            return $validator->errors();
////            return $validator->errors()->first();
//            return redirect()->back()->withErrors($validator)->withInput($request->all());
//        }
//        //insert data

        $file_name = $this->saveImage($request->photo , 'images/offers');

        Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'offer_price' => $request->offer_price ,
            'detail_ar' => $request->detail_ar,
            'detail_en' => $request->detail_en
        ]);

        return redirect()->back()->with(['success' => 'Offer created successfully']);
    }

    public function getAllOffers()
    {

    /*  $locale = app()->getLocale();
        if($locale == 'ar')
            $offers = Offer::select('offer_id','name_ar','offer_price','detail_ar')->get();
        else
            $offers = Offer::select('offer_id','name_en','offer_price','detail_en')->get();*/

       /* $locale = LaravelLocalization::getCurrentLocale();
        $offers = Offer::select(
            'id',
            'offer_price',
            'photo',
            'name_'.$locale.' as name',
            'detail_'.$locale.' as detail'
        )->get();*/

        #### paginate result ####
        $locale = LaravelLocalization::getCurrentLocale();
        $offers = Offer::select(
            'id',
            'offer_price',
            'photo',
            'name_'.$locale.' as name',
            'detail_'.$locale.' as detail'
        )->paginate(PAGINATION_COUNT);

          return view('offers.paginations', compact('offers'));
//        return view('offers.all', compact('offers'));
//        return view('offers.all' , compact('offers') , ["lang" => $locale] );
    }
//    protected function getRules(){
//        return  $rules =[
//            'offer_name' => 'required|max:100|unique:offers,offer_name',
//            'offer_price' => 'required|numeric',
//            'offer_details' => 'required',
//        ];
//    }
//    protected function getMessages()
//    {
//        return $messages = [
//            'offer_name.required'=>__('messages.offer_name_required'),
//            'offer_name.unique'=>__('messages.offer_name_unique'),
//            'offer_price.required'=>__('messages.offer_price_required'),
//            'offer_price.numeric'=>__('messages.offer_price_numeric'),
//            'offer_details.required'=>__('messages.offer_details_required'),
//        ];
//    }

    public function editOffer($offer_id){
//        Offer::findOrFail($offer_id);

       /* $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }*/

      $offer =   Offer::select('id' ,'name_ar','name_en','offer_price','detail_ar','detail_en')->find($offer_id);
        if(!$offer){
            return redirect()->back()->with(['error'=>'offer not found']);
        }
        return view('offers.edit', compact('offer'));
    }

    public function updateOffer(OfferRequest $request, $offer_id){
        $offer =   Offer::find($offer_id);
        if(!$offer){
            return redirect()->back()->with(['error'=>'offer not found']);
        }

        $offer->update($request->all());
        return redirect()->back()->with(['success' => 'Offer updated successfully']);
    }

    public function deleteOffer($offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back()->with(['error' => 'Offer not exist']);
        }

        $filename = $offer->photo;
        if (!empty($filename))
            $this->deleteImage( 'images/offers/',$filename);

        $offer->delete();
        return redirect()->route("offers.all" , $offer_id)->with(['success' => 'Offer deleted successfully']);
    }

    public function getAllInactiveOffers(){
//        $inActiveOffers = Offer::where('status' , 0)->get();
        // globale scope
//        $inActiveOffers = Offer::get();
//        return $inActiveOffers;
        return Offer::withoutGlobalScope(OfferScopes::class)->get();
    }
}
