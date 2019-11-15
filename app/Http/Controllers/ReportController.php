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
    public function view_attendance_report(){
        $user = Auth::user();
        return view('reports/attendance_reports',['title' => $user->name]);
    }
    public function gen_att_reports(Request $request){
        $user = Auth::user();
        $data = DB::table('activity_log')
        ->select('description','subject_id', 'subject_type', 'causer_type','properties','created_at','updated_at')
        ->orderBy('created_at', 'desc')
        ->get();
        // ->whereRaw(DB::Raw('Date(created_at)=CURDATE()'))
        return view('reports/attendance-reports/all_attandance_report',['title' => $user->name,'details' => $data]);
    }


}
