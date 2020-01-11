<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Storage;
use App\Patients;
//use App\Medicine;
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

        $user = Auth::user();

    //     $prescriptions=Prescription::where('patient_id',$appointment->patient_id);
        


    //     $pBloodPressure = new stdClass;
    //     $pBloodPressure->sys = 120;
    //     $pBloodPressure->dia = 80;
    //     $pBloodPressure->date = '2019-02-28';

    //     $pBloodSugar = new stdClass;
    //     $pBloodSugar->value = 100;
    //     $pBloodSugar->date = '2019-02-28';

    //     $pCholestrol = new stdClass;
    //     $pCholestrol->value = 100;
    //     $pCholestrol->date = '2019-02-28';

    //     $pHistory = new stdClass;


        return view('patient.issueMedicineView', [
            'title' => ucWords($user->name),
            'appNum' => $request->appNum,
            'appID'=>$prescription->appointment_id,
            'pName' => $prescription->patient->name,
            'pSex' => $prescription->patient->sex,
            'pAge' => $patient->getAge(),
    //         'pCholestrol' => $pCholestrol,
    //         'pBloodSugar' => $pBloodSugar,
    //         'pBloodPressure' => $pBloodPressure,
    //         'pHistory' => $pHistory,
    //         'inpatient'=>$appointment->admit,
            'pid'=>$prescription->patient->id,
            // 'medicines'=>Medicine::all(),
        ]);
    }
    
    

}
