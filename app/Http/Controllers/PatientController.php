<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patients;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $user = Auth::user();
        return view('patient.register_patient',['title'=>$user->name]);
    }

    public function register_patient(Request $request)
    {
        $user = Auth::user();
        //dd($request->all());
        $patient=new Patients;
        $patient->name=$request->reg_pname;
        $patient->address=$request->reg_paddress;
        $patient->occupation=$request->reg_poccupation;
        $patient->sex=$request->reg_psex;
        $patient->age=$request->reg_page;
        $patient->save();
        return redirect()->back();
    }
}
