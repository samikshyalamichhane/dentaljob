<?php

namespace Modules\Employer\Http\Controllers\Employer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Auth;
use Session;

class LoginController extends Controller
{
   public function getEmployerLogin()
   {
      return view('employer::employer.login');
   }
   public function postEmployerLogin(Request $request)
   {
      $request->validate([
         'email'    => 'required',
         'password' => 'required',
      ]);
      $user = User::where('email', $request->email)->where('role', 'employer')->first();
      // dd(auth()->user()->employer->id);

      if (!$user) {
         return back()->with('message', 'User not found');
      }

      if (!\Hash::check($request->password, $user->password)) {
         return back()->with('message', 'Invalid Username\Password');
      }

      if ($user->role == 'employer' && $user->publish == 0) {
         return back()->with('message', "Your account is not published! Please contact Team.");
      }


      if ($user->role == 'employer' && $user->is_active == 0) {
         return back()->with('message', "Your account is not active! Please contact Team.");
      }

      if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {

         if (is_null(auth()->user())) {

            return redirect()->route('employer.getEmployerLogin')->with('message', 'Login unsuccessfull. Please contact Admin');
         }

         return redirect()->route('employer.employer.edit', auth()->user()->employer->id);
      } else {
         return back()->withInput()->withErrors(['email' => 'something is wrong!']);
      }
   }
   public function employerLogout()
   {
      Auth::logout();
      Session::flush();
      return redirect()->route('jobseeker.login');
   }
}
