<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
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

    public function store(Request $request){
        // validate data

        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(), $rules , $messages);


        if($validator->fails()){
//            return $validator->errors();
//            return $validator->errors()->first();
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        //insert data

        Offer::create([
            'offer_name' => $request->offer_name,
            'offer_price' => $request->offer_price ,
            'offer_details' => $request->offer_details
        ]);

        return redirect()->back()->with(['success' => 'Offer created successfully']);
    }

    protected function getRules(){
        return  $rules =[
            'offer_name' => 'required|max:100|unique:offers,offer_name',
            'offer_price' => 'required|numeric',
            'offer_details' => 'required',
        ];
    }
    protected function getMessages()
    {
        return $messages = [
            'offer_name.required'=>__('messages.offer_name_required'),
            'offer_name.unique'=>__('messages.offer_name_unique'),
            'offer_price.required'=>__('messages.offer_price_required'),
            'offer_price.numeric'=>__('messages.offer_price_numeric'),
            'offer_details.required'=>__('messages.offer_details_required'),
        ];
    }
}
