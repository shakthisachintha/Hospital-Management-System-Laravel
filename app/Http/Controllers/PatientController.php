<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Clinic;
use App\inpatient;
use App\Http\Controllers\Redirect;
use App\Medicine;
use App\Patients;
use App\Prescription;
use App\Prescription_Medicine;
use App\Ward;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;
use Carbon\Carbon;

class PatientController extends Controller
{
    protected $wardArray;

    public function __construct()
    {
        $this->middleware('auth');
        $this->wardList = ['' => 'Select Ward No'] + Ward::pluck('id', 'ward_no')->all();
    }

    public function index()
    {
        $user = Auth::user();
        return view('patient.register_patient', ['title' => $user->name]);
    }

    public function patientHistory($id){
        $prescs=Prescription::where('patient_id',$id)->orderBy('created_at','desc')->get();
        $title="Patient History ($id)";
        return view('patient.history.index',compact('prescs','title'));
    }

    public function patientProfileIntro(Request $request){
        if($request->has('pid')){
            return redirect()->route('patientProfile',$request->pid);
        }else{
            return view('patient.profile.intro',['title'=>"Patient Profile"]);
        }
    }

    public function patientDelete($id,$action){
        if($action=="delete"){
            Patients::find($id)->delete();
        }if($action=='restore'){
            Patients::withTrashed()->find($id)->restore();
        }
        return redirect()->route('patientProfile',$id);
    }

    public function patientProfile($id){
        $patient=Patients::withTrashed()->find($id);
        $hospital_visits=1;
        $status="Active";
        $last_seen=explode(" ",$patient->updated_at)[0];
        if ($patient->trashed()) {
            $status="Inactive";
        }
        $hospital_visits+=Prescription::where('patient_id',$patient->id)->count();
        
        return view('patient.profile.profile',
        [
            'title'=>$patient->name,
            'patient'=>$patient,
            'status'=>$status,
            'last_seen'=>$last_seen,
            'hospital_visits'=>$hospital_visits
            
            ]);
    }

    public function searchPatient(Request $request)
    {
        return view('patient.search_patient_view', ['title' => "Search Patient","old_keyword"=>null, "search_result" => ""]);
    }

    public function patientData(Request $request)
    {
        if ($request->cat == "name") {
            $result = Patients::withTrashed()->where('name', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        if ($request->cat == "nic") {
            $result = Patients::withTrashed()->where('nic', 'LIKE', '%' . $request->keyword . '%')->get();

        }
        if ($request->cat == "telephone") {
            $result = Patients::withTrashed()->where('telephone', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        return view('patient.search_patient_view', ["title" => "Search Results","old_keyword"=>$request->keyword, "search_result" => $result]);
    }

    public function registerPatient(Request $request)
    {
        try {
            $patient = new Patients;
            $today_regs = (int) Patients::whereDate('created_at', date("Y-m-d"))->count();

            $number = $today_regs + 1;
            $year = date('Y') % 100;
            $month = date('m');
            $day = date('d');

            $reg_num = $year . $month . $day . $number;

            $date = date_create($request->reg_pbd);

            $patient->id = $reg_num;
            $patient->name = $request->reg_pname;
            $patient->address = $request->reg_paddress;
            $patient->occupation = $request->reg_poccupation;
            $patient->sex = $request->reg_psex;
            $patient->bod = date_format($date, "Y-m-d");
            $patient->telephone = $request->reg_ptel;
            $patient->nic = $request->reg_pnic;
            $patient->image = $reg_num . ".png";

            $patient->save();
            session()->flash('regpsuccess', 'Patient ' . $request->reg_pname . ' Registered Successfully !');
            session()->flash('pid', "$reg_num");

            $image = $request->regp_photo; // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            \Storage::disk('local')->put("public/" . $reg_num . ".png", base64_decode($image));

            // Log Activity
            activity()->performedOn($patient)->withProperties(['Patient ID' => $reg_num])->log('Patient Registration Success');

            return redirect()->back();
        } catch (\Exception $e) {
            // do task when error
            $error = $e->getCode();
            // log activity
            activity()->performedOn($patient)->withProperties(['Error Code' => $error, 'Error Message' => $e->getMessage()])->log('Patient Registration Failed');

            if ($error == '23000') {
                session()->flash('regpfail', 'Patient ' . $request->reg_pname . ' Is Already Registered..');
                return redirect()->back();
            }
        }
    }

    public function validateAppNum(Request $request)
    {
        $num = $request->number;
        $numlength = strlen((string) $num);
        if ($numlength < 5) {
            $rec = DB::table('appointments')->join('patients', 'appointments.patient_id', '=', 'patients.id')->select('patients.name as name', 'appointments.number as num', 'appointments.patient_id as pnum')->whereRaw(DB::Raw("Date(appointments.created_at)=CURDATE() and appointments.number='$num'"))->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num,
                    "pNum" => $rec->pnum,
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        } else {
            $rec = DB::table('appointments')->join('patients', 'appointments.patient_id', '=', 'patients.id')->select('patients.name as name', 'appointments.number as num', 'appointments.patient_id as pnum')->whereRaw(DB::Raw("Date(appointments.created_at)=CURDATE() and completed='NO' and appointments.patient_id='$num'"))->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num,
                    "pNum" => $rec->pnum,
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        }
    }

    public function checkPatientView()
    {
        $user = Auth::user();
        return view('patient.check_patient_intro', ['title' => "Check Patient"]);
    }

    public function checkPatient(Request $request)
    {
        $appointment = Appointment::where('number', $request->appNum)->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')->where('patient_id', $request->pid)->orderBy('created_at', 'desc')->first();

        if ($appointment->completed == "YES") {
            return redirect()->route('check_patient_view')->with('fail', "This Appointment Has Already Been Channeled.");
        }

        $patient = Patients::find($appointment->patient_id);

        $user = Auth::user();

        $prescriptions = Prescription::where('patient_id', $appointment->patient_id)->orderBy('created_at', 'DESC')->get();

        $pBloodPressure = new stdClass;
        $pBloodPressure->flag = false;

        $pBloodSugar = new stdClass;
        $pBloodSugar->flag = false;

        $pCholestrol = new stdClass;
        $pCholestrol->flag = false;

        foreach ($prescriptions as $prescription) {

            if (!$pBloodPressure->flag == true) {
                $bp = json_decode($prescription->bp)->value;
                if ($bp != null) {
                    $pBloodPressure->sys = explode("/", $bp)[0];
                    $pBloodPressure->dia = explode("/", $bp)[1];
                    $pBloodPressure->date = json_decode($prescription->bp)->updated;
                    $pBloodPressure->flag = true;

                }
            }

            if (!$pCholestrol->flag == true) {
                $cholestrol = json_decode($prescription->cholestrol)->value;
                if ($cholestrol != null) {
                    $pCholestrol->value = $cholestrol;
                    $pCholestrol->date = json_decode($prescription->cholestrol)->updated;
                    $pCholestrol->flag = true;
                }
            }

            if (!$pBloodSugar->flag == true) {
                $sugar = json_decode($prescription->blood_sugar)->value;
                if ($sugar != null) {
                    $pBloodSugar->value = $sugar;
                    $pBloodSugar->date = json_decode($prescription->blood_sugar)->updated;
                    $pBloodSugar->flag = true;
                }
            }

        }

        $updated = "No Previous Visits";
        if($prescriptions->count()>0){
            $updated = explode(" ", $prescriptions[0]->created_at)[0];
        }
        // $updated = explode(" ", $prescriptions[0]->created_at)[0];

        $pHistory = new stdClass;

        $assinged_clinics=Patients::find($request->pid)->clinics;
       
        $clinics = Clinic::all();
    

        return view('patient.check_patient_view', [
            'title' => "Check Patient",
            'appNum' => $request->appNum,
            'appID' => $appointment->id,
            'pName' => $appointment->patient->name,
            'pSex' => $appointment->patient->sex,
            'pAge' => $patient->getAge(),
            'pCholestrol' => $pCholestrol,
            'pBloodSugar' => $pBloodSugar,
            'pBloodPressure' => $pBloodPressure,
            'pHistory' => $pHistory,
            'inpatient' => $appointment->admit,
            'pid' => $appointment->patient->id,
            'medicines' => Medicine::all(),
            'updated' => $updated,
            'assinged_clinics' => $assinged_clinics,
            'clinics' => $clinics
        ]);
    }

    public function addToClinic(Request $request)
    {
        foreach ($request->clinic as $clinic) {
            $c=Clinic::find($clinic);
            $c->addPatientToClinic($request->pid);
        }
        $assinged_clinics=Patients::find($request->pid)->clinics;
        $clinics = Clinic::all();
        $pid=$request->pid;
        $html_list = view('patient.patinet_clinic', compact('pid','assinged_clinics','clinics'))->render();
        $html_already = view('patient.patient_clinic_registered', compact('assinged_clinics','clinics'))->render();
        return response()->json([
            'code'=>200,
            'html_already'=>$html_already,
            'html_list'=>$html_list,
        ]);
    
    }

    public function markInPatient(Request $request)
    {
        $pid = $request->pid;
        $app_num = $request->app_num;
        $user = Auth::user();
        $appointment = Appointment::where('number', $app_num)->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')->where('patient_id', $pid)->first();
        if ($appointment->admit == "NO") {
            $appointment->admit = "YES";
            $appointment->doctor_id = $user->id;
            $appointment->save();
            return response()->json([
                'success' => true,
                'appid' => $appointment->id,
                'pid' => $pid,
                'app_num' => $app_num,
            ]);
        }
    }

    public function checkPatientSave(Request $request)
    {
        $user = Auth::user();
        $presc = new Prescription;
        $presc->doctor_id = $user->id;
        $presc->patient_id = $request->patient_id;
        $presc->diagnosis = $request->diagnosis;
        $presc->appointment_id = $request->appointment_id;

        $presc->medicines = json_encode($request->medicines);

        $bp = new stdClass;
        $bp->value = $request->pressure;
        $bp->updated = Carbon::now()->toDateTimeString();
        $presc->bp = json_encode($bp);

        $gloucose = new stdClass;
        $gloucose->value = $request->glucose;
        $gloucose->updated = Carbon::now()->toDateTimeString();
        $presc->blood_sugar = json_encode($gloucose);

        $cholestrol = new stdClass;
        $cholestrol->value = $request->cholestrol;
        $cholestrol->updated = Carbon::now()->toDateTimeString();
        $presc->cholestrol = json_encode($cholestrol);

        $presc->save();

        $appointment = Appointment::find($request->appointment_id);
        $appointment->completed = "YES";
        $appointment->doctor_id = $user->id;
        $appointment->save();

        foreach ($request->medicines as $medicine) {
            $med = Medicine::where('name_english', strtolower($medicine['name']))->first();
            $pres_med = new Prescription_Medicine;
            $pres_med->medicine_id = $med->id;
            $pres_med->prescription_id = $presc->id;
            $pres_med->note = $medicine['note'];
            $pres_med->save();
        }

        // Log Activity
        activity()->performedOn($presc)->withProperties(['Patient ID' => $request->patient_id, 'Doctor ID' => $user->id, 'Prescription ID' => $presc->id, 'Appointment ID' => $request->appointment_id, 'Medicines' => json_encode($request->medicines)])->log('Check Patient Success');

        return http_response_code(200);
    }

    public function create_channel_view()
    {
        $user = Auth::user();
        $appointments = DB::table('appointments')->join('patients', 'appointments.patient_id', '=', 'patients.id')->select('patients.name', 'appointments.number', 'appointments.patient_id')->whereRaw(DB::Raw('Date(appointments.created_at)=CURDATE()'))->orderBy('appointments.created_at', 'desc')->get();

        return view('patient.create_channel_view', ['title' => "Channel Appointments", 'appointments' => $appointments]);
    }

    public function regcard($id)
    {
        $patient = Patients::find($id);
        $url = Storage::url($id . '.png');
        $data = [
            'name' => $patient->name,
            'sex' => $patient->sex,
            'id' => $patient->id,
            'reg' => explode(" ", $patient->created_at)[0],
            'dob' => $patient->bod,
            'url' => $url,
        ];
        return view('patient.patient_reg_card', $data);
    }

    public function register_in_patient_view()
    {
        $user = Auth::user();
        return view('patient.register_in_patient_view', ['title' => "Register Inpatient"]);
    }

    public function regInPatientValid(Request $request)
    {
        $pNum = $request->pNum;
        $patient = DB::table('patients')->join('appointments', 'patients.id', '=', 'appointments.patient_id')->select('patients.id as id','patients.name as name','patients.sex as sex','patients.address as address','patients.occupation as occ','patients.telephone as tel','patients.nic as nic', 'appointments.admit as ad','patients.bod as bod')->whereRaw(DB::Raw("patients.id='$pNum' and appointments.admit='YES'"))->first();
        if ($patient) {

            return response()->json([
                'exist' => true,
                'name' => $patient->name,
                'sex' => $patient->sex,
                'address' => $patient->address,
                'occupation' => $patient->occ,
                'telephone' => $patient->tel,
                'nic' => $patient->nic,
                'age' => Patients::find($patient->id)->getAge(),
                'id' => $patient->id
            ]);
        } else {
            return response()->json([
                'exist' => false,
            ]);
        }
    }

    public function store_inpatient(Request $request)
     {
        $pid=$request->reg_pid;
        $test=Patients::find($pid);
        $test1=new inpatient;
   
        $test->civil_status=$request->reg_ipcondition;
        $test->birth_place=$request->reg_ipbirthplace;
        $test->nationality=$request->reg_ipnation;
        $test->religion=$request->reg_ipreligion;
        $test->income=$request->reg_inpincome;
        $test->guardian=$request->reg_ipguardname;
        $test->guardian_address=$request->reg_ipguardaddress;
        
        $test1->patient_id=$request->reg_pid;
        $test1->ward_id=$request->reg_ipwardno;
        $test1->patient_inventory=$request->reg_ipinventory;
        $test1->approved_doctor=$request->reg_ipapprovedoc;
        $test1->incharge_doctor=$request->reg_ipinchrgedoc;
        $test1->house_doctor=$request->reg_iphousedoc;
        $test1->disease=$request->reg_admitofficer1;
        $test1->duration=$request->reg_admitofficer2;
        $test1->condition=$request->reg_admitofficer3;
        $test1->certified_officer=$request->reg_admitofficer4;
        
        $test->save();
        $test1->save();

        // decrement bed count by 1
        $getFB=Ward::where('id',$request->reg_ipwardno)->first();
        $decre=1;
        $newFB=$getFB->free_beds - $decre;
        Ward::where('id',$request->reg_ipwardno)->update(['free_beds'=>$newFB]);
        
        return redirect()->back();
    }

    public function get_ward_list()
    {
        $wardList = $this->wardList;
         return view('register_in_patient_view', compact('wardList'));
        // $wards = Ward::all();
        // dd($wardss);
        // return view('register_in_patient_view', compact(['wards']));
    }

    public function discharge_inpatient()
    {
        $user = Auth::user();
        return view('patient.discharge_inpatient_view', ['title' => "Discharge Inpatient"]);
    }

    public function disInPatientValid(Request $request)
    {
        $pNum = $request->pNum;
        $inpatient = DB::table('patients')->join('inpatients', 'patients.id', '=', 'inpatients.patient_id')->select('inpatients.patient_id as id','patients.name as name','patients.address as address','patients.telephone as tel', 'inpatients.discharged as dis')->whereRaw(DB::Raw("inpatients.patient_id='$pNum' and inpatients.discharged='NO'"))->first();

        if ($inpatient) {

            return response()->json([
                'exist' => true,
                'name' => $inpatient->name,
                'address' => $inpatient->address,
                'telephone' => $inpatient->tel,
                'id' => $inpatient->id
            ]);
        } else {
            return response()->json([
                'exist' => false,
            ]);
        }
    }

    public function store_disinpatient(Request $request)
    {
        $pid=$request->reg_pid;
        $test3=Inpatient::where('patient_id',$pid)->first();

        $timestamp = now();
        $test3->discharged='YES';
        $test3->discharged_date=$timestamp;
        $test3->description=$request->reg_medicalofficer1;
        $test3->discharged_officer=$request->reg_medicalofficer2;

        $test3->save();

        // increment bed count by 1
        $wardNo=$test3->ward_id;
        $getFB=Ward::where('id',$wardNo)->first();
        $incre=1;
        $newFB=$getFB->free_beds + $incre;
        Ward::where('id',$wardNo)->update(['free_beds'=>$newFB]);

        return redirect()->back();

    }

    public function getPatientData(Request $request)
    {
        $regNum = $request->regNum;
        $patient = Patients::find($regNum);
        if ($patient) {

            $num = DB::table('appointments')->select('id')->whereRaw(DB::raw("date(created_at)=CURDATE()"))->count() + 1;

            return response()->json([
                'exist' => true,
                'name' => $patient->name,
                'sex' => $patient->sex,
                'address' => $patient->address,
                'occupation' => $patient->occupation,
                'telephone' => $patient->telephone,
                'nic' => $patient->nic,
                'age' => $patient->getAge(),
                'id' => $patient->id,
                'appNum' => $num,
            ]);
        } else {
            return response()->json([
                'exist' => false,
            ]);
        }
    }

    public function addChannel(Request $request)
    {
        $app = new Appointment;
        $num = DB::table('appointments')->select('id')->whereRaw(DB::raw("date(created_at)=CURDATE()"))->count() + 1;
        $pid = $request->id;
        $patient = Patients::find($pid);

        $app->number = $num;
        $app->patient_id = $pid;
        $app->save();
        try {
            $app->save();
            return response()->json([
                'exist' => true,
                'name' => $patient->name,
                'id' => $patient->id,
                'appID' => $app->id,
                'appNum' => $num,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'exist' => false,
            ]);
        }
    }

    public function editPatientview(Request $request)
    {
        // dd($request->reg_pid);
        $user = Auth::user();
        // $data = DB::table('patients')->select('*')->where('id',$request->reg_pid)->first();
        $data = Patients::find($request->reg_pid);
        return view('patient.edit_patient_view', ['title' => "Edit Patient", 'patient' => $data]);
    }

    public function updatePatient(Request $result)
    {
        // dd($result->reg_pbd);
        $user = Auth::user();
        $data = Patients::find($result->reg_pid);
        $query = DB::table('patients')
            ->where('id', $result->reg_pid)
            ->update(array(
                'name' => $result->reg_pname,
                'address' => $result->reg_paddress,
                'sex' => $result->reg_psex,
                'bod' => $result->reg_pbd,
                'occupation' => $result->reg_poccupation,
                'nic' => $result->reg_pnic,
                'telephone' => $result->reg_ptel,
            ));

        if ($query) {
            //activity log
            activity()->performedOn($user)->log('Patient details updated!');
            return redirect()
                ->route('searchPatient')
                ->with('success', 'You have successfully updated patient details.');
        } else {
            return redirect()
                ->route('searchPatient')
                ->with('unsuccess', 'Error in Updating details !!!');
        }

    }
}
