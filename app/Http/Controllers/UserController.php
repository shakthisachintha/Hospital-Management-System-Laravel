<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Contracts\Validation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNotices;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

// require 'vendor/autoload.php';

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

        $names = array(
            'userid' => 'User ID',
            'fingerid' => 'Fingerprint ID'
        );

        $rules = array(
            'userid' => 'numeric|required|between:1,60',
            'fingerid' => 'numeric|required|between:1,60',
        );


        $this->validate($data, $rules, [], $names);


        if (User::where('id', $data->userid)->exists()) {
            try {
                $user = User::find($data->userid);
                $user->fingerprint = $data->fingerid;
                $user->save();
                session()->flash('success', "Fingerprint ID For The User ID $data->userid Successfully Updated!");

                // Activity Log
                activity()->performedOn($user)->withProperties(['User ID' => $data->userid, 'Finger ID' => $data->fingerid])->log('Fingerprint Resgistration Success');

                return redirect()->back();
            } catch (\Exception $e) {
                $error = $e->getMessage();
                session()->flash('fail', "Please Re-Check The User ID Or The Fingerprint ID.($error)");

                // activity log
                activity()->performedOn($user)->withProperties(['User ID' => $data->userid, 'Finger ID' => $data->fingerid, 'Error' => $error])->log('Fingerprint Resgistration Fail');

                return redirect()->back();
            }
        } else {
            session()->flash('fail', "User Does Not Exist.Please Re-Check The UserID.");

            // activity log
            activity()->withProperties(['User ID' => $data->userid, 'Finger ID' => $data->fingerid, 'Error' => 'User Does Not Exist'])->log('Fingerprint Resgistration Fail');

            return redirect()->back();
        }
    }

    public function regNew()
    {
        return view('users.reguser', ['title' => "Register New User"]);
    }

    public function resetUserView()
    {
        return view('users.resetuser', ['title' => "Reset User Account"]);
    }

    public function resetUser(Request $request)
    {
        $reset_user_id = $request->userid;
        $admin_pw = $request->admin_password;

        if (!Hash::check($admin_pw, Auth::user()->password)) {
            return redirect()->back()->with("error", "Your Entered Password Does Not Matches With Your Current Password.Please Check Again.");
        } else if ($usr = User::find($reset_user_id)) {
            $usr->password = bcrypt("12345678");
            try {
                $usr->save();
                return redirect()->back()->with('success', "User " . ucWords($usr->name) . "'s(UserID: $usr->id) Password Reset To System Default(12345678) Password.");
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', "Unkown Error Occured.Try Later.");
            }
        } else {
            return redirect()->back()->with('error', "User($reset_user_id) Does Not Exist.");
        }
    }

    public function changeUserPassword(Request $request)
    {

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword' => 'required|string|min:6',
            'newpasswordagain' => 'required|string|min:6'
        ]);


        if (!Hash::check($request->get('currentpassword'), Auth::user()->password)) {
            return redirect()->back()->with("errorpw", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0) {
            return redirect()->back()->with("errorpw", "New Password cannot be same as your current password. Please choose a different password.");
        }

        if (strcmp($request->get('newpassword'), $request->get('newpasswordagain')) != 0) {
            return redirect()->back()->with("errorpw", "New Password Again does not match with the New Paassword. Please check a again.");
        }

        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        //activity log
        activity()->performedOn($user)->log('Password changed !');

        return redirect()->back()->with("successpw", "Password changed successfully !");
    }

    public function changeUserPropic(Request $request)
    {

        $this->validate($request, [
            'propic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $imageName = time() . '.' . $request->propic->getClientOriginalExtension();
        $destinationPath = '/images/' . $imageName;
        $request->propic->move(public_path('images'), $imageName);

        User::where('id', $user_id)->update(array(
            'img_path' => $destinationPath
        ));

        //activity log
        activity()->performedOn($user)->log('Profile Picture Changed!');

        return back()
            ->with('success', 'You have successfully upload image.');
    }

    public function createnoticeview()
    {
        $notices = DB::table('noticeboards')->select('*')->orderBy('time', 'desc')->get();
        return view('users.send_notices', ['title' => "Send Notices", 'notices' => $notices]);
    }

    public function send_notice(Request $request)
    {
        $count = 0;
        $data = array(
            'message' => $request->message
        );

        $emailsarr = array();
        $receverlist = $request->input('receiverlist');

        if ($receverlist) {
            foreach ($receverlist as $list) {
                $emailsarr[] = DB::table('users')->select('email')->where('user_type', $list)->get();
                $nolist[] = DB::table('users')->select('contactnumber')->where('user_type', $list)->get();
            }
        } else {
            return back()->with('unsuccess', 'Select at least one receiver!!!');
        }

        if ($request->emails) {
            $this->email($data, $emailsarr);
            $count = 1;
        }

        if ($request->sms) {
            $this->sms($data, $nolist);
            $count = 1;
        }
        if ($count == 0) {
            return back()->with('unsuccess', 'Select at least one method to send the notice!!!');
        }

        return back()->with('success', 'Messages Sent Successfully!');
    }

    public function email($data, $emaillist)
    {
        foreach ($emaillist as $key) {
            foreach ($key as $emails) {
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("aurwedicHospitalkesbawa@gov.lk", "Aurwedic Hospital- KESBAWA");
                $email->setSubject("Aurwedic Hospital- KESBAWA");
                $email->addTo($emails->email);
                $email->addContent("text/plain", $data['message']);
                $email->addContent(
                    "text/html",
                    $data['message']
                );
                $sendgrid = new \SendGrid(env('SEND_KEY'));
                try {
                    $response = $sendgrid->send($email);
                    print $response->statusCode() . "\n";
                    print_r($response->headers());
                    print $response->body() . "\n";
                } catch (Exception $e) {
                    echo 'Caught exception: ' . $e->getMessage() . "\n";
                }
            }
        }
    }

    public function sms($data, $nolist)
    {
        foreach ($nolist as $key) {
            foreach ($key as $tpnumber) {
                $no = "94" . $tpnumber->contactnumber;

                $user = "94767035067";
                $password = "3056";
                $text = urlencode($data['message']);
                $to = $no;

                $baseurl = "http://www.textit.biz/sendmsg";
                $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
                $ret = file($url);

                $res = explode(":", $ret[0]);

                if (trim($res[0]) == "OK") {
                    echo "Message Sent - ID : " . $res[1];
                } else {
                    echo "Sent Failed - Error : " . $res[1];
                }
            }
        }
    }

    public function changecontactnumber(Request $data)
    {

        $this->validate($data, [
            'newcontactnum' => 'required|min:9|max:10'
        ]);

        $user = Auth::user();
        $user->contactnumber = $data->get('newcontactnum');
        $user->save();

        // $user_id = $user->id;
        // DB::table('users')
        //     ->where('id', $user_id)
        //     ->limit(1)
        //     ->update(array('contactnumber' => $data->newcontactnum));

        activity()->performedOn($user)->log('Contact number changed successfully!');

        return redirect()->back()->with("successcn", "Contact number changed successfully !");
    }
    public function changeemail(Request $data)
    {

        $this->validate($data, [
            'newemail' => 'required|string|email|max:255|min:1'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        DB::table('users')
            ->where('id', $user_id)
            ->limit(1)
            ->update(array('email' => $data->newemail));

        activity()->performedOn($user)->log('Email changed successfully!');

        return redirect()->back()->with("successmail", "Email changed successfully !");
    }

    public function editprofile(Request $data)
    {
        $this->validate($data, [
            'name' => 'required|string',
            'education' => 'required|string',
            'location' => 'required|string',
        ]);
        $user = Auth::user();
        $user_id = $user->id;

        DB::table('users')
            ->where('id', $user_id)
            ->limit(1)
            ->update(array(
                'name' => $data->name,
                'education' => $data->education,
                'skills' => $data->skills,
                'location' => $data->location,
                'notes' => $data->notes
            ));

        activity()->performedOn($user)->log('User details updated!');

        return redirect()->back()->with("successedit", "Changes added to the database successfully !");
    }
}
