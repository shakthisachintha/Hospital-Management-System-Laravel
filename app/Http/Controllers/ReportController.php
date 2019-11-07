<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewclinicreport(){
        $user = Auth::user();
        return view('reports/clinic_reports',['title' => $user->name]);
    }
    public function view_mobile_clinic_report(){
        $user = Auth::user();
        return view('reports/mobile_clinic_reports',['title' => $user->name]);
    }
    public function view_monthly_static_report(){
        $user = Auth::user();
        return view('reports/monthly_static_report',['title' => $user->name]);
    }
    public function view_out_patient_report(){
        $user = Auth::user();
        return view('reports/out_patient_report',['title' => $user->name]);
    }

}
