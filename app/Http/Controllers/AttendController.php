<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Attendance;
use DB;

class AttendController extends Controller
{
    //
    public function myattend()
    {
        $rec = DB::table('attendances')->select(DB::raw('user_id,DATE(start) as date, MONTH(start) as month,DAY(start) as day ,YEAR(start) as year, sum(TIMESTAMPDIFF(MINUTE,start,end))/60 as duration'))
            ->where('user_id', \Auth::user()->id)->whereRaw(DB::raw('end is not null'))->groupBy('date')->get();

        $rec_more = DB::table('attendances')->select(DB::raw('user_id,DATE(created_at) as date,TIME(start) as start,TIME(end) as end, MONTH(created_at) as month,DAY(created_at) as day ,YEAR(created_at) as year, TIMESTAMPDIFF(MINUTE,start,end)/60 as duration'))
            ->where('user_id', \Auth::user()->id)->whereRaw(DB::raw('end is not null'))->get();

        return view('attendance.attendance', ['title' => "My Attendance", 'att_records' => $rec, 'att_more' => $rec_more]);
    }

    public function attendmore()
    {
        return view('attendance.more_attendance', ['title' => "More Attendance"]);
    }

    public function markAttendance(Request $data)
    {
        $finger_id = $data->input('finger');
        $timestamp = $data->input('time');
        // echo $finger_id;
        // echo $timestamp;
        if (User::where('fingerprint', $finger_id)->exists()) {
            $user = User::where('fingerprint', $finger_id)->first();
            if (DB::table('attendances')->whereRaw(DB::raw("user_id='$user->id' and date(start)=date('$timestamp') and end is null"))->exists()) {
                $rec = DB::table('attendances')->whereRaw(DB::raw("user_id='$user->id' and date(start)=date('$timestamp') and end is null"))->orderBy('start', 'asc')->first();
                // echo $rec;
                $x = Attendance::where('id', $rec->id)->first();
                $x->end = $timestamp;
                $x->save();
                // Log Activity
                activity()->performedOn($x)->withProperties(['User ID' => $user->id,'Finger ID'=>$finger_id,'Time'=>$timestamp,'Record ID'=>$x->id])->log('Attendance Record Updated');
            } else {
                $attend = new Attendance;
                $attend->user_id = $user->id;
                $attend->start = $timestamp;
                $attend->save();

                // Log Activity
                activity()->performedOn($attend)->withProperties(['User ID' => $user->id,'Finger ID'=>$finger_id,'Time'=>$timestamp,'Record ID'=>$attend->id])->log('New Attendance Record Added');
            }
        }
    }
}
