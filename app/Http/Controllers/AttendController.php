<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendController extends Controller
{
    //
    public function myattend()
    {
        return view('attendance.attendance', ['title' => "My Attendance"]);
    }

    public function attendmore()
    {
        return view('attendance.more_attendance', ['title' => "More Attendance"]);
    }

    
}
