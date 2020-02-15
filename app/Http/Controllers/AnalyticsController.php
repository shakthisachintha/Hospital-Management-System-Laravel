<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use Carbon\Carbon;
class AnalyticsController extends Controller
{
    //
    public function index(Request $request){
        $year=$request->year;
        return view('stat.index',['title'=>"Statistics",'year'=>$year]);

        $out_patients=Appointment::whereYear('created_at', date('Y'))->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('m');
        })->get();


    }
}
