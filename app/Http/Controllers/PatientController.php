<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
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
        $this->validate($request,[
            'name' => 'required'
        ]);
        return 123;
        // return view('patient.register_patient',['title'=>$user->name]);
    }
}
