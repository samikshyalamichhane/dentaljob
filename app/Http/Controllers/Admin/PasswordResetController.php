<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Models\Password;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function resetForm()
    {
        return view('admin.sendLink');
    }
    public function sendEmailLink(Request $request)
    {
        // dd($request->all());
        $this->validate($request, ['email' => 'required']);
        $details = $this->user->where('email', $request->email)->first();
        // dd($details);
        if ($details) {
            $randomNumber = str_random(10);

            $token_withSlash = bcrypt($randomNumber);

            $token = str_replace('/', '', $token_withSlash);
            // saving token and user name
            $savedata = ['email' => $request->email, 'token' => $token, 'created_at' => \Carbon\Carbon::now()->toDateTimeString()];
            Password::insert($savedata);
            //sending email link
            $data = ['email' => $request->email, 'token' => $token];
            Mail::send('email.emailLinkTemplate', $data, function ($message) use ($data) {
                $message->to($data['email'])->from(env('MAIL_FROM_ADDRESS'));
                $message->subject('Password Reset link');
            });
            return redirect()->back()->with('flash_message_error', 'Email has been sent!');
        } else {
            return redirect()->back()->with('flash_message_error', 'Email does not exist');
        }
    }
    public function passwordResetForm(Request $request, $token)
    {
        if (isset($token) && $token != "") {
            $data = DB::table('password_resets')->where('token', $token)->first();

            if ($data) {
                return view('admin.passwordReset', compact('data'));
            } else {
                echo "token is wrong";
            }
        } else {
            echo "token not found";
        }
    }
    public function updatePassword(Request $request)
    {
        $detail = $this->user->where('email', $request->email)->first();
        $formData = $request->all();
        if ($request->password) {
            $formData['password'] = bcrypt($request->password);
        }
        $detail->update($formData);
        return redirect()->route('home')->with('message', "Password has been changed");
    }


    public function changePasswordForm()
    {
        return view('front::front.jobseeker.change-password');
    }
    public function changePassword(Request $request)
    {
        // dd($request->password);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'required|min:6|same:new_password',
        ]);

        // $user = $this->user->find(auth()->user()->id);

        if (Hash::check($request->old_password, auth()->user()->password)) {

            $user = $this->user->find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
            // dd($user);
            return redirect()->back()->with('message', "Password has been changed");
        } else {
            return redirect()->back()->with('error', "Password do not match with old one.");
        }
    }
}
