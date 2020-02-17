<?php

namespace App\Http\Controllers;

use App\noticeboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Contracts\Validation;
use Illuminate\Support\Facades\DB;


class NoticeboardController extends Controller
{

    public function addnotice(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'subject' => 'required|min:1',
            'description' => 'required|min:1'
        ]);

        $result = DB::table('noticeboards')
            ->insert([
                'subject' => $request->subject,
                'description' => $request->description,
                'user_id'=>$user->id,
                'time'=> date("Y-m-d H:i:s")
            ]);

        activity()->performedOn($user)->log('Notice added to the databasse!');

        return redirect()->back()->with("successnotice", "Notice added successfully !");
    }

    public function deletenotice(Request $data)
    {
        $user = Auth::user();
        // dd($data->id);
        DB::table('noticeboards')->where('id', '=', $data->id)->delete();
        activity()->performedOn($user)->log('Notice deleted from the databasse!');

        return redirect()->back()->with("successnotice", "Notice deleted successfully !");
    }
}
