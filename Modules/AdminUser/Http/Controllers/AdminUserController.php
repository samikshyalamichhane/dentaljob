<?php

namespace Modules\AdminUser\Http\Controllers;

use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Image;

class AdminUserController extends Controller
{

    private $user;
    public $access_options = [
        'user' => 'user',
        'jobcategory' => 'jobcategory',
        'page' => 'page',
        'setting' => 'setting',
        'roleuser' => 'roleuser',
        'employer' => 'employer',
        'job' => 'job',
        'jobseeker' => 'jobseeker',
    ];

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = $this->user->latest()->where('role', '=', 'admin')->get();
        return view('adminuser::list', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access_options = $this->access_options;
        return view('adminuser::create', compact('access_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/^[a-zA-ZÑñ\s]+$/',
            'email' => 'unique:users|email',
            'password' => 'required|confirmed|min:7',
            'access' => 'required',
            'image' => 'mimes: jpg,jpeg,png,gif|max:3048',
            'logo' => 'mimetypes:image/png,image/jpeg,image/jpg,image/svg|max:3048',
        ];

        $message = ['access.required' => "please select atleast one role",];
        $request->validate($rules, $message);
        $name = explode(' ', $request->name);
        $username = $name[0] . rand(10, 1000);

        $formData = $request->except('publish', 'password_confirmation', 'access');
        $formData['username'] = $username;
        $formData['publish'] = is_null($request->publish) ? 0 : 1;
        $formData['password'] = bcrypt($request->password);
        $formData['access_level'] = '';
        if ($request->access) {
            $accesses = $request->get('access');
            foreach ($accesses as $access) {
                $formData['access_level'] .= ($formData['access_level'] == "" ? "" : ",") . $access;
            }
        }

        $this->user->create($formData);
        return redirect()->route('user.index')->with('message', 'user added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $access_options = $this->access_options;

        $detail = $this->user->findOrFail($id);
        $oldAccesses = ($detail->access_level) ? explode(",", $detail->access_level) : array();

        return view('adminuser::edit', compact('detail', 'access_options', 'oldAccesses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $old = $this->user->find($id);

        $sameEmailVal = $old->email == $request->email ? true : false;
        $message = ['access.required' => "please select atleast one role"];

        $request->validate($this->rules($old->id, $sameEmailVal), $message);

        $formData = $request->except('publish', 'access', 'password', 'password_confirmation');

        $formData['publish'] = is_null($request->publish) ? 0 : 1;
        $formData['access_level'] = '';

        if ($request->password) {
            $formData['password'] = bcrypt($request->password);
        }

        if ($request->access) {
            $accesses = $request->get('access');
            foreach ($accesses as $access) {
                $formData['access_level'] .= ($formData['access_level'] == "" ? "" : ",") . $access;
            }
        }

        $this->user->update($formData, $id);
        return redirect()->route('user.index')->with('message', 'user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->destroy($id);
        return redirect()->back()->with('message', 'user deleted successfully');
    }
    public function rules($oldId = null, $sameEmailVal = false)
    {
        $rules =  [
            'email' => 'unique:users|email',
            'image' => 'mimes:jpg,png,jpeg,gif|max:3048',
            'logo' => 'mimetypes:image/png,image/jpeg,image/jpg,image/svg|max:3048',
            'access' => 'required',
            'password' => 'confirmed',
        ];
        if ($sameEmailVal) {
            $rules['email'] = 'unique:users,email,' . $oldId . '|max:255';
        }
        return $rules;
    }

    public function imageProcessing($image, $width, $height, $otherpath)
    {

        $input['imagename'] = Date("D-h-i-s") . '-' . rand() . '-' . '.' . $image->getClientOriginalExtension();
        $thumbPath = public_path('images/thumbnail');
        $mainPath = public_path('images/main');
        $listingPath = public_path('images/listing');

        $img = Image::make($image->getRealPath());
        $img->fit($width, $height)->save($mainPath . '/' . $input['imagename']);

        if ($otherpath == 'yes') {
            $img1 = Image::make($image->getRealPath());
            $img1->resize($width / 2, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($listingPath . '/' . $input['imagename']);

            $img1->fit(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath . '/' . $input['imagename']);
            $img1->destroy();
        }

        $img->destroy();
        return $input['imagename'];
    }

    public function unlinkImage($imagename)
    {
        $thumbPath = public_path('images/thumbnail/') . $imagename;
        $mainPath = public_path('images/main/') . $imagename;
        $listingPath = public_path('images/listing/') . $imagename;
        if (file_exists($thumbPath)) {
            unlink($thumbPath);
        }

        if (file_exists($mainPath)) {
            unlink($mainPath);
        }

        if (file_exists($listingPath)) {
            unlink($listingPath);
        }

        return;
    }

    public function allCustomers()
    {
        $details = $this->user->latest()->where('role', '=', 'customer')->get();
        return view('admin.customer.list', compact('details'));
    }

    public function customerEdit($id)
    {
        $detail = $this->user->latest()->where('role', '=', 'customer')->findOrFail($id);
        $exhibitors = $this->exhibitor->latest()->where('publish', 1)->get();
        return view('admin.customer.edit', compact('detail', 'exhibitors'));
    }

    public function customerUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-ZÑñ\s]+$/',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|confirmed|min:7',
            'mobile' => 'required|numeric|digits:10',
        ]);
        $formData = $request->except('password', 'publish', 'isActive');

        if ($request->password) {
            $formData['password'] = bcrypt($request->password);
        }

        $formData['publish'] = is_null($request->publish) ? 0 : 1;

        if (is_null($request->isActive)) {
            $formData['isActive'] = 0;
        } else {
            $formData['activation_link'] = null;
            $formData['isActive']     = 1;
        }
        // dd($formData);
        $this->user->update($formData, $id);
        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function exportAllStudents()
    {
        return Excel::download(new AllStudentsExport(), 'allstudent.xlsx');
    }
    // public function sendReminder()
    // {
    //   $dashboard_composer = $this->setting->first();
    //   $details = $this->user->where('publish',1)->where('role', 'customer')->get();
    //   foreach($details as $detail) {
    //       $value = [
    //         'detail' => $detail,

    //         ];
    //     // Mail::send('email.send-reminder', $value, function ($message) use ($detail) {
    //     //     $message->to($detail->email)->from('info@ecanfair.com');
    //     //     $message->subject('Mark your calendar for 14th ECAN Educational Fair (Virtual)');
    //     // });

    //     $userName = 'inimates';
    //     $password = 'nepal123$';

    //     // $message = 'Dear '.$detail->name . ','. ' Exhibition will be started after ' . \Carbon\Carbon::parse($dashboard_composer->exhb_start_date)->diffInDays(null, true) . ' days on ' . \Carbon\Carbon::parse($dashboard_composer->exhb_start_date)->format("d M, Y") . '(' . $dashboard_composer->exhb_start_time .')';
    //     $message = 'We would like to take this opportunity to confirm your attendance for 14th ECAN Educational Fair (Virtual) which is ' . \Carbon\Carbon::parse($dashboard_composer->exhb_start_date)->diffInDays(null, true) . ' days away.  We will be live from '. $dashboard_composer->exhb_start_time . ' am to ' .$dashboard_composer->exhb_end_time.' pm on 15th-18th January, 2021. For query (Whatsapp/Viber/Call): 9810331576';
    //     $destination = $detail->mobile; //9999999999
    //     $sender = 'OneUp';
    //     $url = 'http://api.ininepal.com/api/index?';

    //     $urlQuery = http_build_query([
    //         'username' => $userName,
    //         'password' => $password,
    //         'destination' => $destination,
    //         'message' => $message,
    //         'sender' => $sender
    //     ]);


    //     $url_final = $url . $urlQuery;
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url_final);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //   }



    //   return redirect()->back()->with('send-reminder', 'Reminder send successfully');
    // }

    public function sendReminder()
    {
        // $dashboard_composer = $this->setting->first();
        // $users = User::where('publish', 1)->where('role', 'customer')->get();
        // dispatch(new SendEmailJob($users));
        // dispatch(new SendReminderSMS($users, $dashboard_composer));

        // try {
        //     foreach ($users as $user) {
        //         Mail::to($user->email)->queue(new ReminderEmail($user->name));
        //     }
        // } catch (\Exception $e) {
        //     dd($e);
        // }

        return redirect()->back();
    }

    public function sendReminderEmail()
    {
        $users = User::where('publish', 1)->where('role', 'customer')->get();
        // this
        dispatch(new SendEmailJob($users));
        // or

        // try {
        //     foreach ($users as $user) {
        //         Mail::to($user->email)->queue(new ReminderEmail($user->name));
        //     }
        // } catch (\Exception $e) {
        //     dd($e);
        // }


        return redirect()->back()->with('send-reminder', 'Reminder send successfully');
    }

    public function sendReminderSMS()
    {
        $dashboard_composer = $this->setting->first();
        $users = User::where('publish', 1)->where('role', 'customer')->get();
        dispatch(new SendReminderSMS($users, $dashboard_composer));
        return redirect()->back()->with('send-reminder', 'Reminder send successfully');
    }
}
