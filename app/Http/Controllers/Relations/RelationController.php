<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Service;
use App\User;
use App\Models\Phone;
use Illuminate\Http\Request;

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

    public function getHospitalDoctors()
    {
//       $hospital =  Hospital::with('doctors')->get();

//       $hospital =  Hospital::with('doctors')->find(1);

/*       $hospital = Hospital::find(1);
       return $hospital->doctors;*/


        $hospital = Hospital::with('doctors')->find(1);

        $doctors = $hospital->doctors;

//        return $doctors;

//        foreach ($doctors as $doctor) {
//            echo $doctor->name . "<br>";
//        }
//
//        $doctor = Doctor::find(3);
//        return $doctor->hospital->name;

        $doctor = Doctor::with('hospital')->get();
        return $doctor;

    }

    public function getAllHospitals()
    {
//        $hospitals = Hospital::all();
        $hospitals = Hospital::select('id' , 'name' , 'address')->get();
        $cnt =1;
        return view('doctors.hospitals',compact('hospitals','cnt'));
    }
    public function getAllDoctorsOfHospital($hospital_id){
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctors;
        $cnt =1;

        return view('doctors.doctors',compact('doctors', 'cnt'));
    }

    public function getAllDoctors(){
        $doctors = Doctor::with('hospital')->get();
        $cnt =1;
        return view('doctors.doctors',compact('doctors', 'cnt'));
    }
    public function getHospitalsHasDoctors()
    {
       $hospitals = Hospital::whereHas('doctors')->get();
       return $hospitals;
    }

    public function getHospitalsHasDoctorsMales(){
        $hospitals = Hospital::with('doctors')->whereHas('doctors',function ($q){
            $q->where('gender','male');
        })->get();
        return $hospitals;
    }

    public function getHospitalsNotHasDoctors(){
            $hospital = Hospital::whereDoesNtHave('doctors')->get();
            return $hospital;
    }

    public function deleteHospital($hospital_id){
//        $hospital = Hospital::with('doctors')->find($hospital_id);
//        if(!$hospital){
//            return redirect()->back()->with(['error'=>'hospital not found']);
//        }
//        foreach ($hospital->doctors as $doctor ){
//            $doctor->delete();
//        }

        $hospital = Hospital::find($hospital_id);
        $hospital->doctors()->delete();
        $hospital->delete();
        return redirect()->route('hospitals')->with(['success'=>'hospital deleted successfully']);
    }

    public function deleteDoctor($doctor_id){
        $doctor = Doctor::find($doctor_id);
        if(!$doctor){
            return redirect()->back()->with(['error'=>'Doctor not found']);
        }
        $doctor->delete();
        return redirect()->back()->with(['success'=>'Doctor deleted successfully']);
    }

    public function getDoctorServices()
    {
      /*  $doctor = Doctor::find(10);
        $services = $doctor->services;

        return $services;*/
        return Doctor::with('services')->find(10);
    }

    public function getServiceDoctors(){
        $service = Service::with('doctors')->find(1);
        return $service->doctors;
    }

    public function getDoctorServiceById($doctor_id){

        $doctor = Doctor::find($doctor_id);
        if(!$doctor){
            return redirect()->back()->with(['error'=>'Doctor not found']);
        }
        $services = $doctor->services;
        return view('doctors.services',compact('services'));
    }

    public function addServiceDoctor($doctor_id)
    {
        $doctors= Doctor::select('id' , 'name')->get();
        $services= Service::select('id' , 'name')->get();

        return view('doctors.addService' , compact(['doctors','services']));
    }

    public function storeServiceDoctor(Request $request){

        $doctor = Doctor::find($request->doctor_id);
        if(!$doctor){
            return redirect()->back()->with(['error'=>'Doctor not found']);
        }
//        $doctor->services()->attach($request->service_ids);
//        $doctor->services()->sync($request->service_ids);
        $doctor->services()->syncWithoutDetaching($request->service_ids);

        return  redirect()->back()->with(['success'=>'Service added successfully']);
    }

    public function getPatientDoctor()
    {
       $patient =  Patient::find(1);
        return $patient->doctor;
    }
    public function getCountryDoctors()
    {
//        $country  = Country::find(1);
//        return $country->doctors;
        $country = Country::with('doctors')->find(1);
        return $country;
    }

    public function getDoctor()
    {
       $doctors = Doctor::select('id' , 'name' , 'gender')->get();

     /*
       if(isset($doctors) && $doctors->count() > 0){
           foreach($doctors as $doctor){
               $doctor->gender = ($doctor->gender == '0')?'Male':'Female';
           }
            return $doctors;
       }
     */

       return $doctors;

    }


}
