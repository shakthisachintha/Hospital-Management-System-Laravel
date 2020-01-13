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
//use App\Prescription_Medicine;
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
        
    }

    public function issueMedicineView()
    {
        $user = Auth::user();
        return view('patient.issueMedicineView', ['title' => $user->name]);
    }

    public function issueMedicine(Request $request)
    {
        $prescription=Prescription::where('id',$request->appNum)->where('created_at','>=', date('Y-m-d').' 00:00:00')->where('patient_id',$request->pid)->first();
        $patient=Patients::find($prescription->patient_id);

        if($request->ajax())
        {
            $medicine = DB::table('prescriptions')->join('medicines', 'prescriptions.medicines[id]', '=', 'medicines.id')->select('medcines.name_english as ename', 'medcines.name_sinhala as sname')->get();
            echo json_encode($medicine);
        }
        

        $user = Auth::user();

    

        return view('patient.issueMedicineView', [
            'title' => ucWords($user->name),
            'appNum' => $request->appNum,
            'appID'=>$prescription->appointment_id,
            'pName' => $prescription->patient->name,
            'pSex' => $prescription->patient->sex,
            'pAge' => $patient->getAge(),
            'pid'=>$prescription->patient->id,
            'medicines'=>Medicine::all(),
            'medId'=>$medicine->id
        ]);
    }
    
    

}
