<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Contracts\Validation;

class UserController extends Controller
{
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
                return redirect()->back();
            } catch (\Exception $e) {
                $error = $e->getMessage();
                session()->flash('fail', "Please Re-Check The User ID Or The Fingerprint ID.($error)");
                return redirect()->back();
            }
        } else {
            session()->flash('fail', "User Does Not Exist.Please Re-Check The UserID.");
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
}
