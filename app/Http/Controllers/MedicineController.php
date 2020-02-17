<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Patients;
use App\Prescription;
//use Illuminate\Support\Facades\Storage;
use App\Prescription_Medicine;
//use App\Appointment;
//use File;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

//use stdClass;
//use Carbon\Carbon;
//use Auth;

class MedicineController extends Controller
{
    //

    public function searchSuggestion(Request $request)
    {
        $keyword = $request->keyword;
        return response()->json([
            "sugestion" => ["shakthi", "sachinta", "blov"],
        ], 200);
    }

    public function getherbs()
    {
        $herbs = DB::table('medicines')->get();
        // dd($herbs);
        return response()->json($herbs);
    }

    public function issueMedicineView()
    {
        $user = Auth::user();

        $pmedicines = DB::table('medicine_prescription')
        ->join('medicines', 'medicine_prescription.medicine_id', '=', 'medicines.id')
        ->join('prescriptions', 'medicine_prescription.prescription_id', '=', 'prescriptions.id')
        ->select('medicines.name_english', 'medicines.name_sinhala', 'medicine_prescription.note','prescriptions.patient_id')
        // ->whereDate(DB::Raw("Date(prescriptions.created_at,=,CURDATE()")
        // ->where('prescriptions.patient_id','=',$request->patientid)
        ->get();

        return view('patient.issueMedicineView',compact('pmedicines'), ['title' => "Issue MedicineN"]);
        // 'pmedicines' => $pmedicines
        // return view('patient.issueMedicineView', ['title' => "Issue Medicine"]);

    }

    public function issueMedicineValid(Request $request)
    {

        $num = $request->pNum;
        $numlength = strlen((string) $num);
        
        if ($numlength < 5) {
            $rec = DB::table('prescriptions')
                    ->join('patients', 'prescriptions.patient_id', '=', 'patients.id')
                    ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
                    ->select('patients.name as name', 'appointments.number as num', 'prescriptions.patient_id as pnum')
                    ->whereRaw(DB::Raw("Date(prescriptions.created_at)=CURDATE() and appointments.number='$num'"))
                    ->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num,
                    "pNUM" => $rec->pnum,
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        } 
        else {
            $rec = DB::table('prescriptions')
                    ->join('patients', 'prescriptions.patient_id', '=', 'patients.id')
                    ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
                    ->select('patients.name as name', 'appointments.number as num', 'prescriptions.patient_id as pnum')
                    ->whereRaw(DB::Raw("Date(prescriptions.created_at)=CURDATE() and prescriptions.patient_id='$num'"))
                    ->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num,
                    "pNUM" => $rec->pnum,
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        }

        
    }

    // public function issueMedicine(Request $request)

    // {
    //     $num = $request->pNum;
    //     // $user = Auth::user();

    //     $pmedicines = DB::table('medicine_prescription')
    //     ->join('medicines', 'medicine_prescription.medicine_id', '=', 'medicines.id')
    //     ->join('prescriptions', 'medicine_prescription.prescription_id', '=', 'prescriptions.id')
    //     ->select('medicines.name_english as ename', 'medicines.name_sinhala as sname', 'medicine_prescription.note as not')
    //     ->where('prescriptions.patient_id','=',$num)
    //     ->get();

       
    //     if ($pmedicines) {
    //         return response()->json([
    //             "exist" => true,
    //             "nameE" => $pmedicines->ename,
    //             "nameS" => $pmedicines->sname,
    //             "Note" => $pmedicines->not,
    //         ]);
    //     } else {
    //         return response()->json([
    //             "exist" => false,
    //         ]);
    //     }

    //     // return view('patient.issueMedicineView', ['title' => $user->name, 'pmedicines' => $pmedicines]);
    // }

    // public function show($id)
    // {
    //     // get the nerd

    //         $pmedicines = DB::table('medicine_prescription')
    //     ->join('medicines', 'medicine_prescription.medicine_id', '=', 'medicines.id')
    //     ->join('prescriptions', 'medicine_prescription.prescription_id', '=', 'prescriptions.id')
    //     ->select('medicines.name_english as ename', 'medicines.name_sinhala as sname', 'medicine_prescription.note as not')
    //     ->where('prescriptions.patient_id','=',$id)
    //     ->get();

    //     // show the view and pass the nerd to it
    //     return View::make('patient.show')
    //         ->with('pmedicines', $pmedicines);
    // }

}

