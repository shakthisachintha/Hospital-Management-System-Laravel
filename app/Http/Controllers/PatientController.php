<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patients;
use Illuminate\Support\Facades\Storage;
use File;
use App\Appointment;
use DB;
use stdClass;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('patient.register_patient', ['title' => $user->name]);
    }

    public function register_patient(Request $request)
    {
        //dd($request->all());


        try {
            $patient = new Patients;
            $today_regs = (int) Patients::whereDate('created_at', date("Y-m-d"))->count();

            $number = $today_regs + 1;
            $year = date('Y') % 100;
            $month = date('m');
            $day = date('d');

            $reg_num = $year . $month . $day . $number;

            $patient->id = $reg_num;
            $patient->name = $request->reg_pname;
            $patient->address = $request->reg_paddress;
            $patient->occupation = $request->reg_poccupation;
            $patient->sex = $request->reg_psex;
            $patient->age = $request->reg_page;
            $patient->telephone = $request->reg_ptel;
            $patient->nic = $request->reg_pnic;
            $patient->image = $reg_num.".png";
            $patient->save();
            session()->flash('regpsuccess', 'Patient ' . $request->reg_pname . ' Registered Successfully !');
            session()->flash('pid', "$reg_num");

            $image = $request->regp_photo;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            \Storage::disk('local')->put("public/".$reg_num.".png", base64_decode($image));

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
            $rec = DB::table('appointments')->join('patients', 'appointments.patient', '=', 'patients.id')->select('patients.name as name', 'appointments.number as num', 'appointments.patient')->whereRaw(DB::Raw("Date(appointments.created_at)=CURDATE() and appointments.number='$num'"))->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        } else {
            $rec = DB::table('appointments')->join('patients', 'appointments.patient', '=', 'patients.id')->select('patients.name as name', 'appointments.number as num', 'appointments.patient')->whereRaw(DB::Raw("Date(appointments.created_at)=CURDATE() and appointments.patient='$num'"))->first();
            if ($rec) {
                return response()->json([
                    "exist" => true,
                    "name" => $rec->name,
                    "appNum" => $rec->num
                ]);
            } else {
                return response()->json([
                    "exist" => false,
                ]);
            }
        }
    }

    public function check_patient_view()
    {
        $user = Auth::user();
        return view('patient.check_patient_intro', ['title' => $user->name]);
    }

    public function checkPatient(Request $request)
    {
        $user = Auth::user();
        $pBloodPressure = new stdClass;
        $pBloodPressure->sys = 120;
        $pBloodPressure->dia = 80;
        $pBloodPressure->date = '2019-02-28';

        $pBloodSugar = new stdClass;
        $pBloodSugar->value = 100;
        $pBloodSugar->date = '2019-02-28';

        $pCholestrol = new stdClass;
        $pCholestrol->value = 100;
        $pCholestrol->date = '2019-02-28';

        $pHistory = new stdClass;


        return view('patient.check_patient_view', [
            'title' => $user->name,
            'appNum' => $request->appNum,
            'pName' => 'Shakthi Sachintha',
            'pSex' => "Male",
            'pAge' => 21,
            'pCholestrol' => $pCholestrol,
            'pBloodSugar' => $pBloodSugar,
            'pBloodPressure' => $pBloodPressure,
            'pHistory' => $pHistory,

        ]);
    }

    public function create_channel_view()
    {
        $user = Auth::user();
        $appointments = DB::table('appointments')->join('patients', 'appointments.patient', '=', 'patients.id')->select('patients.name', 'appointments.number', 'appointments.patient')->whereRaw(DB::Raw('Date(appointments.created_at)=CURDATE()'))->orderBy('appointments.created_at', 'desc')->get();

        return view('patient.create_channel_view', ['title' => $user->name, 'appointments' => $appointments]);
    }

    public function regcard($id)
    {
        $patient = Patients::find($id);
        $url = Storage::url($id.'.png');
        $data = [
            'name' => $patient->name,
            'sex' => $patient->sex,
            'id' => $patient->id,
            'reg' => explode(" ", $patient->created_at)[0],
            'dob'=>'1997-06-25',
            'url'=>$url,
        ];
        return view('patient.patient_reg_card', $data);
    }

    public function register_in_patient_view()
    {
        $user = Auth::user();
        return view('patient.register_in_patient_view', ['title' => "Register Inpatient"]);
    }

    public function makeChannel(Request $request)
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
                'age' => $patient->age,
                'id' => $patient->id,
                'appNum' => $num
            ]);
        } else {
            return response()->json([
                'exist' => false
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
        $app->patient = $pid;
        $app->save();
        try {
            $app->save();
            return response()->json([
                'exist' => true,
                'name' => $patient->name,
                'id' => $patient->id,
                'appID' => $app->id,
                'appNum' => $num
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'exist' => false,
            ]);
        }
    }
}
