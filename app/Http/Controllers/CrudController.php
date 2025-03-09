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
            return $validator->errors();
//            return $validator->errors()->first();
        }
        //insert data

        Offer::create([
            'offer_name' => $request->offer_name,
            'offer_price' => $request->offer_price ,
            'offer_details' => $request->offer_details
        ]);

        return 'saved';
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
            'offer_name.required'=>'offer name must have vlaue',
            'offer_name.unique'=>'offer name already exists',
            'offer_price.required'=>'offer price must have value',
            'offer_price.numeric'=>'offer price must be numeric',
            'offer_details.required'=>'offer details must have value',
        ];
    }
}
