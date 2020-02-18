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

    public function markIssued(Request $request){
        try {
            $pres_med=Prescription_Medicine::find($request->medid);
            $pres_med->issued="YES";
            $pres_med->save();
            $med=Medicine::find($pres_med->medicine_id);
            $med->qty+=1;
            $med->save();
            return response()->json([
                "code"=>200,
                "prescription"=>$request->medid,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "code"=>400,
                "prescription"=>$request->medid,
            ]);
        }
        
    }

    public function medIssueSave(Request $request){
        try {
            $presc=Prescription::find($request->presid);
            $presc->medicine_issued="YES";
            $presc->save();
            $medicines=Prescription_Medicine::where('prescription_id',$request->presid)->get();
            return view('medicine.receipt',compact('presc','medicines'));
        } catch (\Throwable $th) {
           return redirect()->back()->with('error',"Unkown Error Occured");
        }
        
    }

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

    public function issueMedicine($presid){
        $pmedicines=Prescription_Medicine::where('prescription_id',$presid)->get();
        $title="Issue Medicine ($presid)";
        $prescription=Prescription::find($presid);
        return view('patient.show',compact('pmedicines','title','presid','prescription'));
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
            $rec=Prescription::whereRaw('date(created_at)=curdate()')
            ->where('appointment_id',$num)->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->patient->name,
                    "appNum" => $rec->appointment_id,
                    "pNUM" => $rec->patient_id,
                    "pres_id"=>$rec->id,
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        } 
        else {
            $rec=Prescription::whereRaw('date(created_at)=curdate()')
            ->where('patient_id',$num)->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->patient->name,
                    "appNum" => $rec->appointment_id,
                    "pNUM" => $rec->patient_id,
                    "pres_id"=>$rec->id,
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

