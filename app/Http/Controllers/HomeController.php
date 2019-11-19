<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dash', [
            'title' => 'Dashboard',
        ]);
        // return view('home');
    }

    public function profile()
    {
        $user = Auth::user();
        $log = DB::table('activity_log')->select('description','subject_id', 'subject_type', 'causer_type','properties','created_at','updated_at')->orderBy('created_at', 'desc')->get();
        // ->whereRaw(DB::Raw('Date(created_at)=CURDATE()'))
        return view('profile', ['title' => $user->name, 'activity' => $log]);
    }

    public function setLocale($lan)
    {
        \Session::put('locale', $lan);
        return redirect()->back();
    }

}
