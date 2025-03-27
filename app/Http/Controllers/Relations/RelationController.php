<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Phone;

class RelationController extends Controller
{
    //

    public function hasOneRelation()
    {
       /*$user = User::find(7);
       return $user->phone;*/
//        $user = User::with('phone')->find(7);
        $user = User::with(['phone'=>function ($query) {
            $query->select('code','phone' , 'user_id');
        }])->find(7);

        return $user->phone -> phone;
       return response()->json($user);
    }

    public function hasOneRelationReverse()
    {
        $phone = Phone::find(1);
//        $phone->makeVisible(['user_id']);
//        $phone->makeHidden(['user_id']);

//        return $phone->user;
//        $phone = Phone::with('user')->find(1);

//        $phone = Phone::with(['user'=>function($query) {
//            $query->select('name','mobile' ,'email', 'id');
//        }])->find(1);
        return $phone;

    }

    public function getUserHasPhone(){
//        return  User::whereHas('phone')->get();
        return User::whereHas('phone',function($q){
                        $q->where('code','02');
                    })->with('phone')->get();
    }

    public function getUserWithoutPhone()
    {
          return User::whereDoesntHave('phone')->get();
    }
}
