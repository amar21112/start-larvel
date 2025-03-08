<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

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

        //insert data

        Offer::create([
            'offer_name' => $request->offer_name,
            'offer_price' => $request->offer_price ,
            'offer_details' => $request->offer_details
        ]);

        return 'saved';
    }

}
