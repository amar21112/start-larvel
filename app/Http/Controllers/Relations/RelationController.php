<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\User;

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

       return response()->json($user);
    }
}
