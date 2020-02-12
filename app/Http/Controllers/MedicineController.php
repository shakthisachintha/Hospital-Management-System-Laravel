<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Storage;
use App\Patients;
use App\Medicine;
//use App\Appointment;
//use File;
use App\Prescription;
use App\Prescription_Medicine;
use DB;
//use stdClass;
//use Carbon\Carbon;
//use Auth;

class MedicineController extends Controller
{
    //

    public function searchSuggestion(Request $request){
        $keyword=$request->keyword;
        return response()->json([
            "sugestion" => ["shakthi","sachinta","blov"],
        ],200);
    }

    public function getherbs(){
        $herbs = DB::table('medicines')->get();
        // dd($herbs);
        return response()->json($herbs);
    }
    
    public function pharmacyValidate(Request $request)
    {
        $num = $request->number;
        $numlength = strlen((string) $num);
        if ($numlength < 5) {
            $rec = DB::table('prescriptions')->join('patients', 'prescriptions.patient_id', '=', 'patients.id')->select('patients.name as name', 'prescriptions.id as num', 'prescriptions.patient_id as pnum')->whereRaw(DB::Raw("Date(prescriptions.created_at)=CURDATE() and prescriptions.id='$num'"))->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num,
                    "pNum"=>$rec->pnum
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        } else {
            $rec = DB::table('prescriptions')->join('patients', 'prescriptions.patient_id', '=', 'patients.id')->select('patients.name as name', 'prescriptions.id as num', 'prescriptions.patient_id as pnum')->whereRaw(DB::Raw("Date(prescriptions.created_at)=CURDATE() and prescriptions.patient_id='$num'"))->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num,
                    "pNum"=>$rec->pnum
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        }
        $pmedicines = DB::table('medicine_prescription')
                    ->join('medicines', 'medicine_prescription.medicine_id', '=', 'medicines.id')
                    ->join('prescriptions', 'medicine_prescription.prescription_id', '=', 'prescriptions.id')
                    ->select('medicines.name_english', 'medicines.name_sinhala', 'medicine_prescription.note')
                    // ->where('medicine_prescription.prescription_id','=','prescriptions.id')
                    ->get();
        
    }

    public function issueMedicineView()
    {
        $user = Auth::user();
       
        // $pmedicines = DB::table('medicine_prescription')
        //             ->join('medicines', 'medicine_prescription.medicine_id', '=', 'medicines.id')
        //             ->join('prescriptions', 'medicine_prescription.prescription_id', '=', 'prescriptions.id')
        //             ->select('medicines.name_english', 'medicines.name_sinhala', 'medicine_prescription.note')
        //             // ->where('medicine_prescription.prescription_id','=','prescriptions.id')
        //             ->get();

        // $medPres = Prescription_Medicine::find($pmedicines->prescription_id);

        return view('patient.issueMedicineView', ['title' => $user->name, 
        // 'pmedicines' => $pmedicines
        // 'medid'=>$medPres
        ]);
        
        // $user = Auth::user();
        // return view('patient.issueMedicineView', ['title' => $user->name]);
    }

    public function issueMedicine(Request $request)
    {
        $prescription=Prescription::where('id',$request->appNum)->where('created_at','>=', date('Y-m-d').' 00:00:00')->where('patient_id',$request->pid)->first();
        $patient=Patients::find($prescription->patient_id);
       
        $pmedicines = DB::table('medicine_prescription')
                    ->join('medicines', 'medicine_prescription.medicine_id', '=', 'medicines.id')
                    ->join('prescriptions', 'medicine_prescription.prescription_id', '=', 'prescriptions.id')
                    ->select('medicines.name_english', 'medicines.name_sinhala', 'medicine_prescription.note')
                    // ->where('medicine_prescription.prescription_id','=','prescriptions.id')
                    ->get();

        $user = Auth::user();

        // $medissue=Prescription::where('id',$request->appNum)->where('created_at','>=', date('Y-m-d').' 00:00:00')->where('patient_id',$request->pid)->first();
        // $patient=Patients::find($prescription->patient_id);
    

        return view('patient.issueMedicineView', [
            'title' => ucWords($user->name),
            'appNum' => $request->appNum,
            'appID'=>$prescription->appointment_id,
            'pName' => $prescription->patient->name,
            'pSex' => $prescription->patient->sex,
            'pAge' => $patient->getAge(),
            'pid'=>$prescription->patient->id,
            // 'medicines'=>$pmed::all(),
            // 'medId'=>$pmedicines->prescription_id,
            // 'ename'=>$pmedicines->name_english,
            // 'sname'=>$pmedicines->name_sinhala

        ]);
    }
    
    

}
