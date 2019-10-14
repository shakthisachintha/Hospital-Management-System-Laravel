<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Contracts\Validation;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegFingerprint()
    {

        return view('users.regfingerprint', ['title' => "Register New Fingerprint"]);
    }


    public function regFinger(Request $data)
    {

        $names=array(
            'userid'=>'User ID',
            'fingerid'=>'Fingerprint ID'
        );

        $rules = array(
            'userid' => 'numeric|required|between:1,60',
            'fingerid' => 'numeric|required|between:1,60',
        );


        $this->validate($data,$rules,[],$names);


        if (User::where('id', $data->userid)->exists()) {
            try {
                $user = User::find($data->userid);
                $user->fingerprint = $data->fingerid;
                $user->save();
                session()->flash('success', "Fingerprint ID For The User ID $data->userid Successfully Updated!");

                // Activity Log
                activity()->performedOn($user)->withProperties(['User ID'=> $data->userid,'Finger ID'=>$data->fingerid])->log('Fingerprint Resgistration Success');

                return redirect()->back();
            } catch (\Exception $e) {
                $error = $e->getMessage();
                session()->flash('fail', "Please Re-Check The User ID Or The Fingerprint ID.($error)");

                // activity log
                activity()->performedOn($user)->withProperties(['User ID'=> $data->userid,'Finger ID'=>$data->fingerid,'Error'=>$error])->log('Fingerprint Resgistration Fail');

                return redirect()->back();
            }
        } else {
            session()->flash('fail', "User Does Not Exist.Please Re-Check The UserID.");

            // activity log
            activity()->withProperties(['User ID'=> $data->userid,'Finger ID'=>$data->fingerid,'Error'=>'User Does Not Exist'])->log('Fingerprint Resgistration Fail');

            return redirect()->back();
        }
    }

    public function regNew()
    {
        return view('users.reguser', ['title' => "Register New User"]);
    }

    public function resetUser()
    {
        return view('users.resetuser', ['title' => "Reset User Account"]);
    }

    public function ChangeUserPassword(Request $request)
    {

        $this->validate($request,[
            'currentpassword'=>'required',
            'newpassword'=>'required|string|min:6',
            'newpasswordagain'=>'required|string|min:6'
        ]);

        if(!Hash::check($request->get('currentpassword'), Auth::user()->password)){
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('currentpassword'),$request->get('newpassword')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        if(strcmp($request->get('newpassword'),$request->get('newpasswordagain')) != 0){
            return redirect()->back()->with("error","New Password Again does not match with the New Paassword. Please check a again.");
        }

        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }
}
