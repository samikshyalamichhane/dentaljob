<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Job\Entities\Job;
use Modules\Jobseeker\Entities\Jobseeker;
use Modules\Employer\Entities\Employer;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Str;
use Mail;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Jobseeker\Entities\Applied_job;
use Modules\Jobseeker\Entities\Past_experience;
// use Modules\Title\Entities\Title;
use Modules\Jobseeker\Repositories\JobseekerRepository;
use Modules\EmailSetting\Repositories\EmailSettingRepository;
use Modules\Title\Repositories\TitleRepository;
use Modules\Page\Entities\Page;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use function PHPUnit\Framework\isEmpty;
use Response;
use Illuminate\Support\Facades\Cookie;
use Modules\Advertisement\Entities\Advertisement;
use Modules\EmailSetting\Entities\Emailsetting;
use Modules\Title\Entities\Title;
use DateTime;
use Modules\Jobcategory\Entities\Jobcategory;

class FrontController extends Controller
{
   /**
    * Display a listing of the resource.
    * @return Renderable
    */
   // public function index()
   // {
   //     return view('front::front.index');
   // }
   public function __construct(TitleRepository $title,EmailSettingRepository $emailsetting, UserRepository $user, JobseekerRepository $jobseeker)
   {
      $this->user = $user;
      $this->jobseeker = $jobseeker;
      $this->title = $title;
      $this->emailsetting = $emailsetting;

      // $this->middleware('guest')->except('logout');
   }

   public function index()
   {
      $dt = \Carbon\Carbon::now();
      $alljobs = Job::published()->open()->orderBy('created_at', 'desc')
         ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->paginate(5);
      $advertisements = Advertisement::Published()
         ->where('place', 'left_sidebar')
         ->whereDate('expire_date', '>', $dt->format('Y-m-d'))
         ->first();
      // dd($advertisements);
      if (is_null(auth()->user())) {
         return view('front::front.jobseeker.index', compact('alljobs', 'advertisements'));
      }
      // if (is_null(auth()->user())) {
      //    $alljobs = Job::where('publish', 1)->orderBy('created_at', 'desc')->paginate(5);
      session_start();
      session_write_close();

      return view('front::front.jobseeker.index', compact('alljobs', 'advertisements'));
      // }
      // $alljobs = array();
      // $jobseeker = Jobseeker::where('user_id', auth()->id())->with('experiences')->first();
      // // dd($jobseeker->experiences->isEmpty());
      // if ($jobseeker->experiences->isEmpty()) {
      //    $searchResult = Job::latest()->where('publish', 1)->take(3)->get();

      //    if ($searchResult) {
      //       array_push($alljobs, $searchResult);
      //    }
      // }

      // // // dd($jobseeker->experiences);
      // foreach ($jobseeker->experiences as $exp) {
      //    // $exp->job_description;
      //    $searchResult = Job::whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())
      //       // ->where('job_description', 'like', '%' . $exp->job_description . '%')
      //       ->orWhere('job_title', 'like', '%' . $exp->job_title . '%')->paginate(3);
      //    // ->orWhere('job_requirements', 'like', '%' . $exp->job_requirements . '%')
      //    // ->orWhere('job_duties', 'like', '%' . $exp->job_duties . '%')
      //    // ->orWhere('benefits', 'like', '%' . $exp->benefits . '%')
      //    // ->take(3)->get();
      //    // dd($searchResult, $alljobs);
      //    array_push($alljobs, $searchResult);

      //    // if (count($searchResult) > 0) {
      //    //    foreach ($searchResult as $key => $search) {
      //    //       array_push($alljobs, $search);
      //    //    }
      //    // }
      // }
      // // dd($alljobs);

      // // return view('front::front.index', compact('alljobs'));

      // // dd(auth()->user());
      // return view('front::front.index', compact('alljobs'));
   }

   public function login(Request $request)
   {
      if (!Auth::check())
         return view('front::front.jobseeker.login');
      elseif (auth()->user()->role == 'admin' || auth()->user()->role == 'super-admin') {
         return redirect()->back()->with(['message' => 'Already Logged In as Admin or Super Admin. You need to logout first!!!', 'type' => 'danger']);
      }
      return redirect()->back()->with(['message' => 'Already Logged In!!!']);
   }


   public function postJobseekerLogin(Request $request)
   {
      if (auth()->check()) {
         Session::flush();
      }

      $this->validate($request, [
         'email' => 'required|email',
         'password' => 'required|min:6',

      ]);

      $user = User::where('email', $request->email)->where('role', 'jobseeker')->first();


      if (!$user) {
         return back()->with('message', 'User not found or User may not be Jobseeker! Please log in as Jobseeker');
      }

      if (!\Hash::check($request->password, $user->password)) {
         return back()->with('flash_message_error', 'Invalid Password');
      }
      if ($user->role == 'jobseeker' && $user->publish == '0' && $user->is_active == '0') {
         return redirect()->back()->with(['message' => 'Please contact admin', 'type' => 'danger']);
      }
      $credentials = $request->only('email', 'password');

      if (Auth::attempt($credentials)) {
         // logged in
         Session::put('frontSession', Auth::user());

         $userStatus = User::where('email', $request->email)->first();

         if ($userStatus->verified == 0) {
            session()->flush();
            return redirect()->back()->with(['flash_message_error' => 'Please confirm your email to activate your account!', 'verification_code_not_received' => true]);
         } else {
            $job_url = session('__jobURL');
            if (isset($job_url)) {
               return redirect()->to($job_url);
            }
            return redirect()->route('editProfile', auth()->user()->id);
         }
      } else {
         return redirect()->back()->with('flash_message_error', 'Invalid username or password');
      }
   }


   public function register()
   {
      if (!Auth::check()) {
         $titles = $this->title->where('publish',1)->get();
         return view('front::front.jobseeker.register',compact('titles'));
      } else {
         return redirect()->back();
      }
   }

   public function postJobseekerRegister(Request $request)
   {
      $request->validate([
         'first_name' => 'required',
         'middle_name' => 'nullable',
         'last_name' => 'required',
         'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
         'email' => 'required|email|unique:users|max:255',
         'password' => 'required',
         'confirm_password' => 'required|min:6|same:password',
         'terms_condition' => 'required',
      ]);
      // dd($request->all());

      $email_message = $this->emailsetting->where('publish', 1)->first();
      $name = explode(' ', $request->first_name);
      $username = strtolower($name[0] . rand(10, 1000));

      $formData = $request->except(['password', 'terms_condition']);
      $formData['password'] = bcrypt($request->password);
      $formData['username'] = $username;
      $formData['publish'] = 1;

      $formData['activation_link'] = \Str::random(63);
      $link = route('verifyNewAccount', $formData['activation_link']);
      $formData['name'] = $request->first_name . $request->middle_name . $request->last_name;
      $formData['terms_condition'] = is_null($request->terms_condition) ? 0 : 1;
      $form = $request->except('activation_link', 'terms_condition',  '_token');
      $formData['role'] = 'jobseeker';
      $formData['title_id'] = $request->title_id;
      $title = Title::where('id',$request->title_id)->first();
      $role = $formData['role'];
      $data = $this->user->create($formData);
      $form['user_id'] = $data->id;
      $form['mobile'] = $request->mobile;
      // dd($form['mobile']);
      $email = Emailsetting::first();
      // dd($email);
      // $string=str_replace('$first_name,$role',"$request->first_name,$$request->first_name",$email->email_desc);
      // $string=str_replace('$role,','$role',$email->email_desc);
      $string = str_replace(
         array('{first_name}','{role}','{activation_link}','{title}','{last_name}'),
         array("$request->first_name", "$role", "$link" ,"$title->title" ,"$request->last_name"),
         $email->email_desc
     );
   //   dd($string);
      $jobseeker = $this->jobseeker->create($form);
   //   dd($jobseeker);

      $mail_data = [
         // 'name' => $formData['name'],
         'name' => $request->first_name,
         'password' => $request->password,
         'email' => $request->email,
         'role' => $formData['role'],
         'link' => route('verifyNewAccount', $formData['activation_link']),
         'home' => route('home'),
         'email_message' => $string,

      ];

      

      Mail::send('email.account-activation-mail', $mail_data, function ($message) use ($mail_data, $request, $email) {
         $message->to($request->email)->from(env('MAIL_FROM_ADDRESS'), $email->activation_email_from_name);
         $message->subject($email->activation_email_subject);
      });

      return Redirect::back()->with('flash_message_error', "Please check your email for activation link");;
   }

   public function calDateTime($expireDate)
   {
      $dt = \Carbon\Carbon::now()->toDateTimeString();
      $startTime = \Carbon\Carbon::parse($dt);

      $dateTimeNow = $startTime->toDateTimeString();
      $expire_dateTime = $expireDate->toDateTimeString();

      $datetime1 = new DateTime($dateTimeNow); // 11 October 2013
      $datetime2 = new DateTime($expire_dateTime); // 13 October 2013

      $interval = $datetime2->diff(today(), false);
      // $interval = \Carbon\Carbon::parse($datetime2)->diffInDays(now(), false);
      // dd($interval);


      $calculated_date_time = [];

      $remaining_time = $interval->format("%H:%I:%S");
      $remaining_day = $interval->format('%R%a'); // +2 days
      $remaining_day = (int) $remaining_day;
      // dd($remaining_day, $remaining_time);


      $calculated_date_time = [];
      $calculated_date_time['remaining_time'] = $remaining_time;
      $calculated_date_time['remaining_day'] = $remaining_day;
      // dd($calculated_date_time);
      return $calculated_date_time;
      // dd($remaining_time, $remaining_day);
   }


   public function jobInner($slug)
   {
      // if (auth()->check() && (auth()->user()->role == 'super-admin' || auth()->user()->role == 'admin')) {
      //    return redirect()->back()->with('flash_message_error', 'Please login as jobseeker or employer');
      // }

      $job = Job::where('slug', $slug)->first();
      if ($job) {
         $dt = \Carbon\Carbon::now()->toDateTimeString();
         $startTime = \Carbon\Carbon::parse($dt);
         $dateTimeNow = $startTime->toDateTimeString();
         $rem_date_time = $this->calDateTime($job->deadline_date);

         //  $og['job_title'] = $job->job_title;
         //  $og['job_description'] = $job->job_description;
         //  $og['image'] = $job->employer->profile_image;
         // //  $meta['job_title'] = $job->job_title;
         // //  $meta['image'] = $job->employer->profile_image;
         // //  $meta['job_description'] = $job->job_description;

         $og['title'] = $job->meta_title;
         $og['description'] = $job->meta_description;
         $og['keywords'] = $job->keyword;
         // $og['job_title'] = $job->job_title;
         // $og['job_description'] = $job->job_description;
         $og['image'] = $job->employer->profile_image;
         //  dd($og['image']);
         //  $meta['job_title'] = $job->job_title;
         //  $meta['image'] = $job->employer->profile_image;
         //  $meta['job_description'] = $job->job_description;


         $applied = [];
         $similarjobs = Job::published()->open()->where('id', '!=', $job->id)->where('job_title', 'like', '%' . $job->job_title . '%')
            ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())
            ->where('job_requirements', 'like', '%' . $job->job_requirements . '%')->take(8)
            ->orderBy('published_date', 'DESC')
            ->get();

         if ($similarjobs->isEmpty()) {
            $similarjobs = Job::published()->open()->where('id', '!=', $job->id)
               ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())
               ->orderBy('published_date', 'DESC')->take(8)
               ->get();
         }
         // if (auth()->check()) {
         //    $jobseeker_role = auth()->user()->role;
         //    if ($jobseeker_role != 'jobseeker') {
         //       return view('front::front.job-detail', compact('job', 'similarjobs', 'applied'));
         //    }
         // }
         // dd(auth()->user());
         // if (auth()->user()->role != 'super-admin')
         //    dd(1);
         // else
         //    dd(2);
         if (auth()->check() && (auth()->user()->role === 'jobseeker')) {
            $id = auth()->user()->id;
            $jobseeker = $this->jobseeker->with(['jobs'])->where('user_id', $id)->first();
            $applied = Applied_job::where('job_id', $job->id)->where('jobseeker_id', $jobseeker->id)->get();
         } else {
            $jobseeker = $this->jobseeker->with(['jobs'])->first();
         }

         // if ($id != null) {
         //    $jobseeker = $this->jobseeker->with(['jobs'])->where('user_id', $id)->first();
         //    $applied = Applied_job::where('job_id', $jobs->id)->where('jobseeker_id', $jobseeker->id)->get();
         // } else {
         //    $jobseeker = $this->jobseeker->with(['jobs'])->first();
         // }


         return view('front::front.jobseeker.job-detail', compact('og', 'job', 'jobseeker', 'applied', 'similarjobs', 'rem_date_time', 'dateTimeNow'));
      } else
         return redirect()->back();
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
// dd($token);
      $user = $this->user->where('activation_link', $token)->first();
      // $user = $this->user->where(['activation_link' => $token])->first();
      // dd($user);

      if (!$user) {
         $request->session()->flash('message', 'Invalid Activation link found.');
         return redirect()->route('jobseeker.register');
      }

      if ($user->activation_link == $token) {
         $user['activation_link'] = null;
         $user['publish']     = 1;
         $user['is_active']     = 1;
         $user['verified']     = 1;
      } else {
         $request->session()->flash('message', 'Invalid Activation link found.');
         // this register form for employer is on same page i.e on jobseeker register page
         return redirect()->route('jobseeker.register');
      }

      $success  = $user->save();
      // dd($success);

      if ($success) {
         // this login form for employer is on same page i.e on jobseeker login page
         return redirect()->route('jobseeker.login')->with(['message' => 'Thank You ! Your Account Has been Activated.', 'type' => 'success']);
      } else {
         $request->session()->flash('message', 'Sorry There was a problem while activating your  account. Please try again.');

         return redirect()->back();
      }
   }

   public function logout()
   {
      Auth::logout();
      Session::flush();
      return redirect()->route('home');
   }

   public function verificationCode(Request $request)
   {

      return view('front::front.jobseeker.verificationcodelink');
   }

   public function sendVerificationLink(Request $request)
   {
      $details = $this->user->where('email', $request->email)->first();
      if ($details) {
         $formData['activation_link'] = $details->activation_link;
         $mail_data = [
            'name' => $details->name,
            'password' => $details->password,
            'email' => $request->email,
            'link' => route('resendVerification', $formData['activation_link']),
            'home' => route('home'),

         ];
         Mail::send('email.account-activation-mail', $mail_data, function ($message) use ($mail_data, $request) {
            $message->to($request->email)->from(env('MAIL_FROM_ADDRESS'));
            $message->subject('Please activate your account ');
         });
         return redirect()->route('jobseeker.login')->with('flash_message_error', 'Please check your email for activation link!');
      } else {
         return redirect()->back()->with('flash_message_error', 'Email doesnot exist!');
      }
   }


   public function resendVerification($token, Request $request)
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
         $user['verified']     = 1;
      } else {
         $request->session()->flash('message', 'Invalid Activation link found.');
         // this register form for employer is on same page i.e on jobseeker register page
         return redirect()->route('jobseeker.register');
      }

      $success  = $user->save();

      if ($success) {
         // this login form for employer is on same page i.e on jobseeker login page
         return redirect()->route('jobseeker.login')->with(['message' => 'Thank You ! Your Account Has been Activated.', 'type' => 'success']);
      } else {
         $request->session()->flash('message', 'Sorry There was a problem while activating your  account. Please try again.');

         return redirect()->back();
      }
   }

   public function resetForm()
   {
      return view('front::front.jobseeker.password-reset');
   }

   public function profileInfo($username)
   {
      $username = Auth::user()->username;
      $user = User::where('username', $username)->first();
      return view('front::front.jobseeker.profile', compact('user'));
   }

   public function overview()
   {
      $searchResults = array();
      $jobseeker = Jobseeker::where('user_id', auth()->id())->with('experiences')->first();
      $applied_jobs = Applied_job::where('jobseeker_id', $jobseeker->id)->get();

      $applied_jobs_id = [];
      foreach ($applied_jobs as $item) {
         array_push($applied_jobs_id, $item->job_id);
      }


      if (count($applied_jobs_id) > 0) {
         $applies = Job::whereIn('id', $applied_jobs_id)->orderby('created_at', 'desc')->take(5)->get();
      } else {
         $applies = [];
      }

      if ($jobseeker->experiences->isEmpty()) {
         $searchResult = Job::latest()->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->where('publish', 1)->orderby('created_at', 'desc')->take(5)->get();
         if ($searchResult) {
            array_push($searchResults, $searchResult);
         }
      }

      $job_titles = [];
      foreach ($jobseeker->experiences as $exp) {
         array_push($job_titles, $exp->job_title);
      }
      foreach ($job_titles as $job_title) {
         $dt = \Carbon\Carbon::now()->toDateTimeString();
         // dd($dt->addDays(1));
         // dd(Job::where('deadline_date', '>=', $dt)->get());
         $searchResult = Job::whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())
            // ->where('job_description', 'like', '%' . $exp->job_description . '%')
            ->where('job_title', 'like', '%' . $job_title . '%')
            ->get();
         if (count($searchResult) > 0) {
            array_push($searchResults, $searchResult);
         }
      }

      if (empty($searchResults)) {
         $searchResult = Job::latest()->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->where('publish', 1)->orderby('created_at', 'desc')->take(5)->get();
         if ($searchResult) {
            array_push($searchResults, $searchResult);
         }
      }

      // dd($searchResult);


      // dd($searchResults);

      return view('front::front.jobseeker.overview', compact('searchResults', 'applies'));
   }

   public function findAll()
   {
      $advertisements = Advertisement::Published()
         ->where('place', 'left_sidebar')
         ->first();
      $title = request()->get('title');
      if ($title != null) {
         $searched = Job::latest()->published()->open()
            ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->where('job_title', 'like', '%' . $title . '%')
            ->orWhere('job_description', 'like', '%' . $title . '%')
            ->orWhere('benefits', 'like', '%' . $title . '%')
            ->paginate(5);
      }
      return view('front::front.jobseeker.search', compact('searched', 'advertisements'));
   }

   public function search()
   {
      $title = request()->get('title');
      $place =  request()->get('location');
      $advertisements = Advertisement::Published()
         ->where('place', 'left_sidebar')
         ->first();
      $today_date = \Carbon\Carbon::now()->toDateString();
      // dd($s);
      // $date1 = Carbon::createFromFormat('Y-m-d H:i:s', '2021-01-02 12:10:00');
      // $date2 = Carbon::createFromFormat('Y-m-d H:i:s', '2021-01-02 11:10:00');

      // $result = $date1->gt($date2);
      // dd($result);

      $searched = Job::published()->open()
         ->where('town_city', 'LIKE', "%" . $place . "%")
         ->orWhereHas('jobcategory', function ($query) use ($title) {
            $query->where('title', 'like', '%' . $title . '%');
         })->paginate(5);


      foreach ($searched as $key => $s) {
         if (!$s->deadline_date->gt($today_date))
            $searched->forget($key);
      }


      return view('front::front.jobseeker.search', compact('searched', 'advertisements'));
   }


   public function searchOnKeyUp(Request $request)
   {
      $title = request()->get('title');

      if ($title != null) {
         $searched = Job::published()->open()->orderBy('created_at', 'desc')
            ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->where('job_title', 'LIKE', "%" . $title . "%")
            ->limit(10)->get();
      }

      // if ($place != null && empty($title)) {
      //    $searched = Job::where('town_city', 'LIKE', "%" . $place . "%")->select('job_title', 'town_city', 'slug')->limit(10)->get();
      // }
      // if ($title != null && empty($place)) {
      //    $searched = Job::where('job_title', 'LIKE', "%" . $title . "%")->select('job_title', 'town_city', 'slug')->limit(10)->get();
      // }
      // return the results
      return response()->json(['data' => $searched]);
   }

   public function apply(Request $request)
   {
      // dd($request->all());
      // dd(Jobseeker::findOrFail($request->jobseeker_id));
      $data = $request->except('_token');

      $job = Job::where('id', $request->job_id)->with('employer')->first();
      $jobseeker = Jobseeker::where('id', $request->jobseeker_id)->first();
      // dd($jobseeker->user->role);
      if ($jobseeker->user->role != 'jobseeker') {
         return redirect()->back()->with('message', 'Unauthorized access.');
      }
      $employer_name = $job->employer->employer_name;
      $jobseeker_name = $jobseeker->first_name . ' ' . $jobseeker->middle_name . ' ' . $jobseeker->last_name;
      $jobseeker_first_name = $jobseeker->first_name;
      $job_title = $job->job_title;
      $link = route('profileDetail', $jobseeker->user->username);
      // dd($link);
      $email = Emailsetting::first();
      // dd($email);
      // $string=str_replace('$first_name,$role',"$request->first_name,$$request->first_name",$email->email_desc);
      // $string=str_replace('$role,','$role',$email->email_desc);
      $string = str_replace(
         array('{employer_name}','{jobseeker_name}','{job_title}','{link}'),
         array("$employer_name", "$jobseeker_name","$job_title","$link"),
         $email->job_app
     );
     $reply_string = str_replace(
      array('{employer_name}','{jobseeker_name}','{job_title}'),
      array("$employer_name", "$jobseeker_first_name","$job_title"),
      $email->job_app_reply
  );
   //   dd($string);

      $mail_data = [
         'employer_name' => $job->employer->employer_name,
         'jobseeker_name' => $jobseeker->first_name . ' ' . $jobseeker->middle_name . ' ' . $jobseeker->last_name,
         'job_title' => $job->job_title,
         'email' => $jobseeker->email,
         'link' => route('profileDetail', $jobseeker->user->username),
         'email_message' => $string

      ];

      $mailSentToEmployer = Mail::send('email.job_application', $mail_data, function ($message) use ($mail_data, $job, $email) {
         $message->to($job->employer->employer_email)->from(env('MAIL_FROM_ADDRESS'), $email->job_email_from_name);
         $message->subject($email->job_app_subject);
      });


      $applied_job = Applied_job::create($data);
      if (!$applied_job) {
         return redirect()->back()->with('message', 'Application not sent.');
      }
      $mail_data1 = [
         'employer_name' => $job->employer->employer_name,
         'jobseeker_name' => $jobseeker->first_name . ' ' . $jobseeker->middle_name . ' ' . $jobseeker->last_name,
         'job_title' => $job->job_title,
         'email' => $jobseeker->email,
         'link' => route('profileDetail', $jobseeker->user->username),
         'reply_email_message' => $reply_string

      ];

      $mailSentFromEmployer = Mail::send('email.reply-from-emp', $mail_data1, function ($message) use ($jobseeker, $job, $email) {
         $message->to($jobseeker->email)->from($job->employer->employer_email, $email->job_reply_email_from_name);
         $message->subject($email->job_app_reply_subject);
      });

      if ($mailSentFromEmployer)
         return redirect()->back()->with('message', 'Application sent successfully. Please check your mail.');

      // $applied_job = Applied_job::create($data);

      return redirect()->back()->with('message', 'Application sent successfully.');
   }


   // public function dynamicPages($slug)
   // {
   //    //for about us
   //    if ($slug == 'about-us') {
   //       try {
   //          $detail = Page::published()->where('slug', $slug)->first();
   //          return view('front::front.pages.aboutus', compact('detail'));
   //          die;
   //       } catch (\Exception $ae) {
   //          abort('404');
   //       }
   //    }

   //    //for privacy policy
   //    if ($slug == 'privacy-policy') {
   //       try {
   //          // dd('hi');
   //          $detail = Page::published()->where('slug', $slug)->first();
   //          // dd($about);
   //          return view('front::front.pages.privacy-policy', compact('detail'));
   //          die;
   //       } catch (\Exception $ae) {
   //          abort('404');
   //       }
   //    }

   //    //for terms and condition
   //    if ($slug == 'terms-and-condition') {
   //       try {
   //          // dd('hi');
   //          $detail = Page::published()->where('slug', $slug)->first();
   //          // dd($about);
   //          return view('front::front.pages.terms-and-condition', compact('detail'));
   //          die;
   //       } catch (\Exception $ae) {
   //          abort('404');
   //       }
   //    }
   // }

   // public function pageNotFound()
   // {
   //    return view('front::front.jobseeker.page_not_found');
   // }
}
