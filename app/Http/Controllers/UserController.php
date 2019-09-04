<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function regFingerprint(){
        return view('users.regfingerprint', ['title' => "Register New Fingerprint"]);
    }

    public function regNew(){
        return view('users.reguser', ['title' => "Register New User"]);
    }

    public function resetUser(){
        return view('users.resetuser', ['title' => "Reset User Account"]);
    }
}
