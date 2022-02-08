<?php

namespace Modules\Front\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\EmailSetting\Repositories\EmailSettingRepository;
use Modules\EmailSetting\Entities\Emailsetting;
use Modules\Employer\Repositories\EmployerRepository;
use Modules\Title\Entities\Title;
use Auth;
use Mail;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class EmployerController extends Controller
{
   protected $employer;
   protected $user;

   public function __construct(EmailSettingRepository $emailsetting, EmployerRepository $employer, UserRepository $user)
   {
      $this->employer = $employer;
      $this->user = $user;
      $this->emailsetting = $emailsetting;
   }

   public function postEmployerRegister(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'first_name' => 'required',
         'last_name' => 'required',
         'name' => 'required|string',
         'email' => 'required|email|unique:users',
         'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
         'password' => 'required|confirmed',
         'terms_condition' => 'required'

      ]);
      $email_message = $this->emailsetting->where('publish', 1)->first();

      //   dd( env('MAIL_FROM_ADDRESS'));
      if ($validator->fails()) {
         return redirect()->back()->withInput()->withErrors($validator)->with(['tab' => $request->tab]);
      }
      // $request->validate([
      //    'name' => 'required|string',
      //    'email' => 'required|email|unique:users',
      //    'password' => 'required|confirmed',
      //    'terms_condition' => 'required'
      // ]);
      $name = explode(' ', $request->name);
      // dd($name[0]);
      $username = strtolower($name[0] . rand(10, 1000));
      $formData = $request->except(['password', 'terms-condition', 'terms_condition']);
      $formData['publish'] = 0;
      $formData['username'] = $username;
      $formData['terms_condition'] = is_null($request->terms_condition) ? 0 : 1;
      $formData['role'] = 'employer';
      $formData['title_id'] = $request->title_id;
      $formData['password'] = bcrypt($request->password);
      $formData['activation_link'] = \Str::random(63);
      $link = route('employer.verifyNewAccount', $formData['activation_link']);
      $first_name = $name[0];
      $role = $formData['role'];
      $formData['title_id'] = $request->title_id;
      $title = Title::where('id',$request->title_id)->first();

      $email = Emailsetting::first();
      $string = str_replace(
         array('{first_name}','{role}','{activation_link}','{organization_name}','{last_name}','{title}'),
         array("$request->first_name", "$role", "$link", "$first_name", "$request->last_name","$title->title"),
         $email->employer_activation_email_body
     );
   //   dd($string);
      $userExist = $this->user->create($formData);
      if ($userExist)
         $user = $this->user->where('email', $request->email)->first();

      $empData = [
         'user_id' => $user->id,
         'organization_summary' => $request->name,
         'employer_name' => $request->name,
         'organization_name' => $request->name,
         'mobile_number' => $request->mobile_number,
         'employer_email' => $request->email,
         'first_name' => $request->first_name,
         'last_name' => $request->last_name,
         'publish' => 1
      ];
      // dd($empData);

      $this->employer->create($empData);

      $mail_data = [
         // 'name' => $formData['name'],
         'name' => $name[0],
         'email' => $request->email,
         'role' => $formData['role'],
         'link' => route('employer.verifyNewAccount', $formData['activation_link']),
         'home' => route('home'),
         'email_message' => $string,
      ];

      Mail::send('email.account-activation-mail', $mail_data, function ($message) use ($mail_data, $request, $email) {
         $message->to($request->email)->from(env('MAIL_FROM_ADDRESS'), $email->employer_email_from_name);
         $message->subject($email->employer_activation_email_subject);
      });
      return redirect()->back()->with('message', 'Please check your email. Activation link has been send');
   }

   public function VerifyNewAccount($token, Request $request)
   {
      if (!$token) {
         $request->session()->flash('error', 'Invalid Request.');
         return redirect()->route('jobseeker.register');
      }

      $length = strlen($token);

      if ($length < 63) {
         $request->session()->flash('error', 'Invalid Activation link found.');
         return redirect()->route('jobseeker.register');
      }

      $user = $this->user->where('activation_link', $token)->first();

      if (!$user) {
         $request->session()->flash('message', 'Invalid Activation link found.');
         return redirect()->route('jobseeker.register');
      }

      if ($user->activation_link == $token) {
         $user['activation_link'] = null;
         $user['publish']     = 1;
         $user['is_active']     = 1;

         // $this->employer->create(['user_id' => $user->id,]);
      } else {
         $request->session()->flash('message', 'Invalid Activation link found.');
         // this register form for employer is on same page i.e on jobseeker register page
         return redirect()->route('jobseeker.register');
      }

      $success  = $user->save();

      if ($success) {
         // this login form for employer is on same page i.e on jobseeker login page
         return redirect()->route('jobseeker.login')->with(['message' => 'Thank You ! Your Account Has been Activated. Please click on employer tab', 'type' => 'success']);
      } else {
         $request->session()->flash('message', 'Sorry There was a problem while activating your  account. Please try again.');

         return redirect()->back();
      }
   }

   public function postEmployerLogin(Request $request)
   {

      $validator = Validator::make($request->all(), [
         'email' => 'required|email',
         'password' => 'required|min:6',
      ]);
      if ($validator->fails()) {
         return redirect()->back()->withInput()->withErrors($validator)->with(['tab' => $request->tab]);
      }

      $user = $this->user->where('email', $request->email)->where('role', 'employer')->where('publish', 1)->first();

      if (!$user) {
         return back()->with('flash_message_error', 'User not found or Please log in as Employer');
      }

      if (!\Hash::check($request->password, $user->password)) {
         return back()->with('flash_message_error', 'Invalid Password');
      }

      if ($user->role == 'employer' && $user->publish == '0') {
         return redirect()->back()->with(['message' => 'Please contact admin', 'type' => 'danger']);
      }

      if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
         return redirect()->route('employer.getProfile', $user->employer->id)->with(['message' => 'Please update your profile', 'type' => 'success']);
      } else {
         return back()->withInput()->withErrors(['email' => 'something is wrong!']);
      }
   }

   public function getEmployerProfile($employerId)
   {
      $detail = $this->employer->findOrFail($employerId);
      $title = Title::where('id',$detail->user->title_id)->first();
      return view('front::front.employer.edit-profile', compact('detail','title'));
   }

   public function updateEmployerProfile(Request $request, $employerId)
   {
      $oldRecord = $this->employer->findOrFail($employerId);

      $formData = $this->employer->employerUpdate($request, $oldRecord);
      $formData['publish'] = $oldRecord->publish;

      $this->employer->update($formData, $employerId);
      return redirect()->back()->with(['message' => 'Profile updated successfully', 'type' => 'success']);
   }

   public function getCompanyProfile($employername)
   {
      $detail = $this->user->where('username', $employername)->with('employer')->first();
      $title = Title::where('id',$detail->title_id)->first();
      return view('front::front.employer.company-profile', compact('detail','title'));
   }

   public function CompanyProfile($employername)
   {
      $datas['detail'] = $this->user->where('username', $employername)->with(['employer','title'])->first();
      return view('front::front.employer.company', $datas);
   }

   public function getEmployerOverview($employername)
   {
      $datas['detail'] = $this->user->where('username', $employername)->with('employer')->first();
      return view('front::front.employer.overview', $datas);
   }
}
