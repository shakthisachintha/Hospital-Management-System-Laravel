<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Contracts\Validation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNotices;
use DB;
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

    public function resetUser()
    {
        return view('users.resetuser', ['title' => "Reset User Account"]);
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
        //->with('image',$imageName);
    }

    public function createnoticeview()
    {

        return view('users.send_notices', ['title' => "Send Notices"]);
    }

    public function send_notice(Request $request)
    {

        $data = array(
            'message' => $request->message
        );

        $emailsarr = array();
        $receverlist = $request->input('receiverlist');
        foreach ($receverlist as $list) {
            $emailsarr[] = DB::table('users')->select('email')->where('user_type', $list)->get();
            $nolist[] = DB::table('users')->select('contactnumber')->where('user_type', $list)->get();
        }
        // dd($emailsarr);
        //userlata tp no eka na

        //dd($data['message']);
        if ($request->emails) {
            $this->email($data, $emailsarr);
        }
        if ($request->sms) {
            $this->sms($data, $nolist);
        }

        return back()->with('success', 'thanks for contacting us!');
    }

    public function email($data, $emaillist)
    {
        foreach ($emaillist as $key) {
            foreach ($key as $emails) {
                require '../vendor/autoload.php';
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("2017cs014@stu.ucsc.cmb.ac.lk");
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
        // $basic  = new \Nexmo\Client\Credentials\Basic('4618c9cf', 'u56udGx4em2dqQqD');
        // $client = new \Nexmo\Client($basic);

        // $message = $client->message()->send([
        // 'to' => 94767035067,//'94767035067',
        // 'from' => 'Nexmo',
        // 'text' => $data['message']
        // ]);
        foreach ($nolist as $key) {
            foreach ($key as $tpnumber) {
                $no="94".$tpnumber->contactnumber;
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
}
