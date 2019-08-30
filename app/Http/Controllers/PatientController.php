<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patients;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $user = Auth::user();
        return view('patient.register_patient',['title'=>$user->name]);
    }

    public function register_patient(Request $request)
    {
        //dd($request->all());
        $patient=new Patients;
        $patient->name=$request->reg_pname;
        $patient->address=$request->reg_paddress;
        $patient->occupation=$request->reg_poccupation;
        $patient->sex=$request->reg_psex;
        $patient->age=$request->reg_page;
        $patient->save();
        session()->flash('regpsuccess','Patient registered successfully !');
        return redirect()->back();
    }

    public function check_patient_view()
    {
        $user = Auth::user();
        return view('patient.check_patient_view',['title'=>$user->name]);
    }

    public function create_channel_view()
    {
        $user = Auth::user();
        return view('patient.create_channel_view',['title'=>$user->name]);
    }

}
