<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendController extends Controller
{
    //
    public function myattend(Request $request)
    {
        if ($request->has('year')) {
            $rec = DB::table('attendances')
                ->select(DB::raw('user_id,DATE(start) as date, MONTH(start) as month,DAY(start) as day ,YEAR(start) as year, sum(TIMESTAMPDIFF(MINUTE,start,end))/60 as duration'))
                ->where('user_id', \Auth::user()->id)
                ->whereRaw("YEAR(created_at)=$request->year")
                ->whereRaw(DB::raw('end is not null'))
                ->orderBy('created_at', 'desc')->groupBy('date')->get();

            $rec_more = DB::table('attendances')
                ->select(DB::raw('user_id,DATE(created_at) as date,TIME(start) as start,TIME(end) as end, MONTH(created_at) as month,DAY(created_at) as day ,YEAR(created_at) as year, TIMESTAMPDIFF(MINUTE,start,end)/60 as duration'))
                ->where('user_id', \Auth::user()->id)
                ->whereRaw("YEAR(created_at)=$request->year")
                // ->whereRaw("MONTH(created_at)=MONTH(CURDATE())")
                ->whereRaw(DB::raw('end is not null'))
                ->orderBy('created_at', 'desc')->get();

            return view('attendance.attendance', ['title' => "My Attendance", 'att_records' => $rec, 'att_more' => $rec_more]);

        } else {

            $rec = DB::table('attendances')
                ->select(DB::raw('user_id,DATE(start) as date, MONTH(start) as month,DAY(start) as day ,YEAR(start) as year, sum(TIMESTAMPDIFF(MINUTE,start,end))/60 as duration'))
                ->where('user_id', \Auth::user()->id)
                ->whereRaw("YEAR(created_at)=YEAR(CURDATE())")
                ->whereRaw(DB::raw('end is not null'))
                ->orderBy('created_at', 'desc')->groupBy('date')->get();

            $rec_more = DB::table('attendances')
                ->select(DB::raw('user_id,DATE(created_at) as date,TIME(start) as start,TIME(end) as end, MONTH(created_at) as month,DAY(created_at) as day ,YEAR(created_at) as year, TIMESTAMPDIFF(MINUTE,start,end)/60 as duration'))
                ->where('user_id', \Auth::user()->id)
                ->whereRaw("YEAR(created_at)=YEAR(CURDATE())")
                // ->whereRaw("MONTH(created_at)=MONTH(CURDATE())")
                ->whereRaw(DB::raw('end is not null'))
                ->orderBy('created_at', 'desc')->get();

            return view('attendance.attendance', ['title' => "My Attendance", 'att_records' => $rec, 'att_more' => $rec_more]);
        }

    }

    public function attendmore(Request $data)
    {
        $ids = User::all();
        // $ids=DB::table('attendances')->select('user_id')->distinct()->get();
        dd($ids);
        return view('attendance.more_attendance', ['title' => "More Attendance", 'ids' => $ids]);
    }

    public function markAttendance(Request $data)
    {
        $finger_id = $data->input('finger');
        $timestamp = $data->input('time');

        if (User::where('fingerprint', $finger_id)->exists()) { //updating the end time of a attendance record
            $user = User::where('fingerprint', $finger_id)->first();
            if (DB::table('attendances')->whereRaw(DB::raw("user_id='$user->id' and date(start)=date('$timestamp') and end is null"))->exists()) {
                $rec = DB::table('attendances')->whereRaw(DB::raw("user_id='$user->id' and date(start)=date('$timestamp') and end is null"))->orderBy('start', 'asc')->first();
                $x = Attendance::where('id', $rec->id)->first();
                $x->end = $timestamp;
                $x->save();
                // Log Activity
                activity()->performedOn($x)->withProperties(['User ID' => $user->id, 'Finger ID' => $finger_id, 'Time' => $timestamp, 'Record ID' => $x->id])->log('Attendance Record Updated');

                return response()->json([
                    "status" => 200,
                    "name" => ucwords($user->name),
                    "fingerprint" => $finger_id,
                    "userid" => $user->id,
                ]);

            } else { //creating new attendance record
                $attend = new Attendance;
                $attend->user_id = $user->id;
                $attend->start = $timestamp;
                $attend->save();

                // Log Activity
                activity()->performedOn($attend)->withProperties(['User ID' => $user->id, 'Finger ID' => $finger_id, 'Time' => $timestamp, 'Record ID' => $attend->id])->log('New Attendance Record Added');

                return response()->json([
                    "status" => 200,
                    "name" => ucwords($user->name),
                    "fingerprint" => $finger_id,
                    "userid" => $user->id,
                ]);
            }
        } else {
            return response()->json([
                "status" => 400,
                "name" => ucwords("not found"),
                "fingerprint" => $finger_id,
                "userid" => -1,
            ]);
        }
    }
}
