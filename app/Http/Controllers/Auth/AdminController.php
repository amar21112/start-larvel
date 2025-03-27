<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
class AdminController extends Controller
{
    //
    public function admin(){
        return view('admin');
    }
    public function adminLogin(){
//        echo Hash::make(101202303);
        return view('auth.adminLogin');
    }

   public function adminLoginVerified(Request $request)
    {
        /*
         your password must hash in datebase
            $password=bcrypt(101202303);
            var_dump($password);
        */

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
       ]);



        if(Auth::guard('admin')->attempt(['email'=>$request->email , 'password'=>$request->password])){
           return redirect()->route('admin');
        }

       return back()->withInput($request->only('email'));
    }

//    public function adminLoginVerified(Request $request)
//    {
//        $this->validate($request, [
//            'email' => 'required|email',
//            'password' => 'required|min:6'
//        ]);
//
//        // Check if the admin exists
//
//        $admin = Admin::where('password', $request->password)->first();
//
//        return $admin;;
//
//    }


}
