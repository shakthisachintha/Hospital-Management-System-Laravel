<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Clinic;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewclinicreport()
    {
        $user = Auth::user();
        $data = Clinic::all();
        return view('reports/clinic_reports', ['title' => $user->name, 'clinic' => $data]);
    }

    public function printclinicreport(Request $data)
    {

        $user = Auth::user();

        return view('reports/print_clinic_report', ['name' => $user->name]);
    }
    public function view_mobile_clinic_report()
    {
        $user = Auth::user();
        return view('reports/mobile_clinic_reports', ['title' => $user->name]);
    }
    public function view_monthly_static_report()
    {
        $user = Auth::user();

        $start_date = date('Y/m/00');
        $end_date = date('Y/m/31');
        $no_of_employees = DB::table('attendances')
            ->whereBetween('attendances.start', [$start_date, $end_date])
            ->count(DB::raw('DISTINCT user_id'));
        $patient_count = DB::table('appointments')
            ->count(DB::raw('distinct number'));
        $avg_patient = ceil($patient_count / 30);

        $ward_count = DB::table('wards')
            ->count(DB::raw('distinct ward_no'));
        $bed_count = DB::table('wards')
            ->sum('beds');
        $inpatient_count = DB::table('inpatients')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->count(DB::raw('discharged'));
        $discharged_patinet_count = DB::table('inpatients')
            ->where('discharged', '=', 'YES')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->count(DB::raw('discharged'));

        $admindaycnt = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->whereBetween('attendances.start', [$start_date, $end_date])
            ->where('users.user_type', '=', 'admin')
            ->count(DB::raw('start'));

        $doctordaycnt = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->whereBetween('attendances.start', [$start_date, $end_date])
            ->where('users.user_type', '=', 'doctor')
            ->count(DB::raw('start'));

        $appointmentcnt = DB::table('appointments')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->count(DB::raw('id'));
        $distinctappcnt = DB::table('appointments')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->count(DB::raw('distinct patient_id'));
        $patientsecondarrival = $appointmentcnt - $distinctappcnt;

        return view('reports/monthly_static_report', [
            'title' => $user->name,
            'noemp' => $no_of_employees,
            'avgpatient' => $avg_patient,
            'wardcnt' => $ward_count,
            'bedcnt' => $bed_count,
            'inpcnt' => $inpatient_count,
            'dispcnt' => $discharged_patinet_count,
            'admindaycnt' => $admindaycnt,
            'doctordaycnt' => $doctordaycnt,
            'fa' => $distinctappcnt,
            'sa' => $patientsecondarrival,
            'total' => $appointmentcnt
        ]);
    }
    public function view_out_patient_report()
    {
        $user = Auth::user();
        return view('reports/out_patient_report', ['title' => $user->name]);
    }
    public function view_attendance_report()
    {
        $user = Auth::user();
        return view('reports/attendance_reports', ['title' => $user->name]);
    }

    public function view_ward_report()
    {
        $user = Auth::user();
        return view('reports/ward_reports', ['title' => $user->name]);
    }
    public function gen_att_reports(Request $request)
    {
        $user = Auth::user();
        $start_date = date_format(date_create($request->start), "Y/m/d");
        $end_date = date_format(date_create($request->end), "Y/m/d");

        if ($request->type == "All") {
            $data = DB::table('attendances')
                ->join('users', 'attendances.user_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'attendances.start as start',
                    'attendances.end as end',
                    'users.name as name',
                    'users.user_type as type',
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) > 7 THEN 1 ELSE NULL END) AS attended'),
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) < 5 THEN 1 ELSE NULL END) AS shortleave')
                )
                ->whereBetween('attendances.start', [$start_date, $end_date])
                ->groupBy('id')
                ->get();
        }


        if ($request->type == "My Attendance") {

            $data = DB::table('attendances')
                ->join('users', 'attendances.user_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'attendances.start as start',
                    'attendances.end as end',
                    'users.name as name',
                    'users.user_type as type',
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) > 7 THEN 1 ELSE NULL END) AS attended'),
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) < 5 THEN 1 ELSE NULL END) AS shortleave')
                )
                ->whereBetween('attendances.start', [$start_date, $end_date])
                ->where('attendances.user_id', $user->id)
                ->groupBy('id')
                ->get();
            // $data=User::find($user->id);

        }


        if ($request->type == "Doctors") {
            $data = DB::table('attendances')
                ->join('users', 'attendances.user_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'attendances.start as start',
                    'attendances.end as end',
                    'users.name as name',
                    'users.user_type as type',
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) > 7 THEN 1 ELSE NULL END) AS attended'),
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) < 5 THEN 1 ELSE NULL END) AS shortleave')
                )
                ->whereBetween('attendances.start', [$start_date, $end_date])
                ->where('users.user_type', 'doctor')
                ->groupBy('id')
                ->get();
        }


        if ($request->type == "General Staff") {
            $data = DB::table('attendances')
                ->join('users', 'attendances.user_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'attendances.start as start',
                    'attendances.end as end',
                    'users.name as name',
                    'users.user_type as type',
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) > 7 THEN 1 ELSE NULL END) AS attended'),
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) < 5 THEN 1 ELSE NULL END) AS shortleave')
                )
                ->whereBetween('attendances.start', [$start_date, $end_date])
                ->whereIn('users.user_type', ['pharmacist', 'general'])
                ->groupBy('id')
                // ->where('users.user_type','pharmacist')
                ->get();
        }

        return view('reports/attendance-reports/all_attendance_report', ['title' => $user->name, 'details' => $data, 'start' => $request->start, 'end' => $request->end, 'type' => $request->type]);
    }

    public function all_print_preview(Request $request)
    {

        $start_date = date_format(date_create($request->start), "Y/m/d");
        $end_date = date_format(date_create($request->end), "Y/m/d");

        $user = Auth::user();
        //get the attendance of all type
        if ($request->type == "All") {
            $data = DB::table('attendances')
                ->join('users', 'attendances.user_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'attendances.start as start',
                    'users.name as name',
                    'users.user_type as type',
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) > 7 THEN 1 ELSE NULL END) AS attended'),
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) < 5 THEN 1 ELSE NULL END) AS shortleave')
                )
                ->whereBetween('attendances.start', [$start_date, $end_date])
                ->groupBy('id')
                ->orderBy('type')
                ->get();
        }

        //get the attendance of mine
        if ($request->type == "My") {
            $data = DB::table('attendances')
                ->join('users', 'attendances.user_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'attendances.start as start',
                    'users.name as name',
                    'users.user_type as type',
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) > 7 THEN 1 ELSE NULL END) AS attended'),
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) < 5 THEN 1 ELSE NULL END) AS shortleave')
                )
                ->whereBetween('attendances.start', [$start_date, $end_date])
                ->where('attendances.user_id', $user->id)
                ->groupBy('id')
                ->orderBy('type')
                ->get();
        }

        //get the attendance of doctor
        if ($request->type == "Doctors") {
            $data = DB::table('attendances')
                ->rightJoin('users', 'attendances.user_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'attendances.start as start',
                    'users.name as name',
                    'users.user_type as type',
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) > 7 THEN 1 ELSE NULL END) AS attended'),
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) < 5 THEN 1 ELSE NULL END) AS shortleave')
                )
                ->whereBetween('attendances.start', [$start_date, $end_date])
                ->where('users.user_type', 'doctor')
                ->groupBy('id')
                ->orderBy('type')
                ->get();
        }

        //get the attendance of staff
        if ($request->type == "General") {
            $data = DB::table('attendances')
                ->join('users', 'attendances.user_id', '=', 'users.id')
                ->select(
                    'users.id as id',
                    'attendances.start as start',
                    'users.name as name',
                    'users.user_type as type',
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) > 7 THEN 1 ELSE NULL END) AS attended'),
                    DB::raw('count(CASE WHEN HOUR(TIMEDIFF(attendances.end, attendances.start )) < 5 THEN 1 ELSE NULL END) AS shortleave')
                )
                ->whereBetween('attendances.start', [$start_date, $end_date])
                ->whereIn('users.user_type', ['pharmacist', 'general'])
                ->groupBy('id')
                ->orderBy('type')
                // ->where('users.user_type','pharmacist')
                ->get();
        }

        //return to printing page view
        return view('reports/attendance-reports/all_print_preview', ['title' => $user->name, 'details' => $data]);
    }
}
