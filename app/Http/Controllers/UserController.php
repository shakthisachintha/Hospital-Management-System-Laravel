<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showRegFingerprint(){

        return view('users.regfingerprint', ['title' => "Register New Fingerprint"]);
    }

    public function regFinger(Request $data){
        try{
            $user = User::find($data->userid);
            $user->fingerprint= $data->fingerid;
            $user->save();
            echo "Saved";
        }catch(\Exception $e){
            $error=$e->getMessage();
            echo $error;
        }
        
    }

    public function regNew(){
        return view('users.reguser', ['title' => "Register New User"]);
    }

    public function resetUser(){
        return view('users.resetuser', ['title' => "Reset User Account"]);
    }
}
