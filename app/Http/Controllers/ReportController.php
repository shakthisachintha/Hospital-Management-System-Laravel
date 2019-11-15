<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

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
        if($request->type == "All"){
            $data = DB::table('attendances')
            ->join('users','attendances.user_id' , '=', 'users.id')
            ->select('users.id as id','attendances.start as start','users.name as name','users.user_type as type', 'attendances.id as count')
            ->whereBetween('attendances.start', [$request->start, $request->end])
            ->get();
            // ->whereRaw(DB::Raw('Date(created_at)=CURDATE()'))

            return view('reports/attendance-reports/all_attendance_report',['title' => $user->name,'details' => $data]);
        }


        if($request->type == "My Attendance"){
            $data = DB::table('attendances')
            ->join('users','attendances.user_id' , '=', 'users.id')
            ->select('users.id as id','attendances.start as start','users.name as name','users.user_type as type', 'attendances.id as count')
            ->whereBetween('attendances.start', [$request->start, $request->end])
            ->where('attendances.user_id',$user->id)
            ->get();

            return view('reports/attendance-reports/my_attendance_report',['title' => $user->name,'details' => $data]);
        }


        if($request->type == "Doctors"){
            $data = DB::table('attendances')
            ->join('users','attendances.user_id' , '=', 'users.id')
            ->select('users.id as id','attendances.start as start','users.name as name','users.user_type as type', 'attendances.id as count')
            ->whereBetween('attendances.start', [$request->start, $request->end])
            ->where('users.user_type','doctor')
            ->get();

            return view('reports/attendance-reports/doctors_attendance_report',['title' => $user->name,'details' => $data]);
        }


        if($request->type == "General Staff"){
            $data = DB::table('attendances')
            ->join('users','attendances.user_id' , '=', 'users.id')
            ->select('users.id as id','attendances.start as start','users.name as name','users.user_type as type', 'attendances.id as count')
            ->whereBetween('attendances.start', [$request->start, $request->end])
            ->where('users.user_type','general')
            ->orWhere('users.user_type','pharmacist')
            ->get();

            return view('reports/attendance-reports/staff_attendance_report',['title' => $user->name,'details' => $data]);
        }


    }


}
