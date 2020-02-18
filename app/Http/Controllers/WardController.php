<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ward;
use Illuminate\Support\Facades\DB;




class WardController extends Controller
{
    //
    public function index(){
        $title='Wards';
        $docs=User::where(function ($query) {
            $query->where('user_type', '=', 'doctor')
                  ->orWhere('user_type', '=', 'admin');
        })->get();
        $data=DB::table('wards')->get();
        return view('ward.index',compact("title","docs","data"));
    }

    public function createWard(Request $request){
        $ward=new Ward();
        $ward->doctor_id=$request->doctor;
        $ward->ward_no=$request->ward_num;
        $ward->beds=$request->total_beds;
        $ward->free_beds=$request->free_beds;
        try {
            $ward->save();
            return redirect()->back()->with('success',"New Ward Added Success.");
        } catch (\Throwable $th) {
            return redirect()->back()->with('fail',"Error Occured!");
        }
    }


}
