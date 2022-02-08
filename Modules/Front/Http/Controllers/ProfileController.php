<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
// use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Jobseeker\Entities\Jobseeker;
use Modules\Jobseeker\Entities\Additional_document;
use Modules\Jobseeker\Repositories\JobseekerRepository;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Modules\Jobseeker\Entities\Applied_job;
use Modules\Job\Entities\Job;
use Modules\Front\Entities\Profile;
use Modules\Title\Entities\Title;
use File, PDF, Validator;
use Modules\Jobseeker\Entities\Past_experience;
use Input;
use Illuminate\Support\Facades\Session;

use Illuminate\Foundation\Validation\ValidatesRequests;

class ProfileController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function __construct(JobseekerRepository $jobseeker)
  {
    $this->jobseeker = $jobseeker;
  }

  public function profileInfo($username)
  {
    $username = Auth::user()->username;
    $user = User::where('username', $username)->first();
    $id = Auth::id();
    $title = Title::where('id',$user->title_id)->first();
    $jobseeker = Jobseeker::with(['experiences', 'documents'])->where('user_id', $id)->first();
    return view('front::front.jobseeker.profile', compact('user', 'jobseeker','title'));
  }

  public function profileDetail($username)
  {
    // $username = Auth::user()->username;
    $user = User::where('username', $username)->first();
    dd($user);
    $id = $user->id;
    $title = Title::where('id',$user->title_id)->first();
    $jobseeker = Jobseeker::with(['experiences', 'documents'])->where('user_id', $id)->first();
    return view('front::front.jobseeker.profile', compact('user', 'jobseeker'));
  }


  public function downloadCv($id)
  {
    $jobseeker = Jobseeker::with(['experiences', 'documents'])->where('user_id', $id)->first();
    $pdf = PDF::loadView('front::front.jobseeker.cv', compact('jobseeker'));
    return $pdf->stream('pdfview.pdf');
  }


  public function editProfile($id)
  {
    $id = Auth::id();
    $title_user = User::where('id',$id)->first();
    $title = Title::where('id',$title_user->title_id)->first();
    // dd($title);
    $user = Jobseeker::where('user_id', $id)->with('experiences')->with('documents')->first();
    return view('front::front.jobseeker.edit-profile', compact('user','title'));
  }

  public function updateProfile(Request $request)
  {
    $id = Auth::id();
    $old = $this->jobseeker->where('user_id', $id)->firstOrFail();

    $validator = Validator::make($request->all(), [
      'first_name' => 'sometimes',
      'middle_name' => 'nullable',
      'last_name' => 'sometimes',
      'email' => 'email|max:255',
      'mobile' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
      'gdc_number' => 'nullable|min:2|max:10',
      'country' => 'sometimes',
      'street' => 'sometimes',
      'gender' => 'sometimes',
      // 'other_desc'=>'required_if:gender,=,"others"',
      'profession' => 'sometimes',
      'city_county' => 'sometimes',
      'postal_code' => 'sometimes',
      'profile_image' => 'mimes:jpeg,png,jpg',
      'resume' => 'mimes:pdf,doc,docx,jpeg,jpg,png',
      'cover_letter' => 'mimes:pdf,doc,docx,jpeg,jpg,png',

    ]);
    if ($validator->fails()) {
      return redirect()->back()->withInput()->withErrors($validator)->with(['tab' => $request->tab]);
    }

    $value = $request->except('profile_image', 'resume', 'cover_letter', '_token', 'email', 'tab');
    if ($request->gender = 'others') {
      $value['other_desc'] = $request->other_desc;
    } else {
      $value['other_desc'] = null;
    }
    if ($request->hasFile('profile_image')) {
      if ($old->profile_image) {
        $this->unlinkImage($old->profile_image);
      }
      $value['profile_image'] = $this->imageProcessing($request->file('profile_image'));
    }

    if ($request->hasFile('resume')) {
      if ($old->resume) {
        $this->unlinkImage($old->resume);
      }
      $value['resume'] = $this->documentProcessing($request->resume);
    }

    if ($request->hasFile('cover_letter')) {
      if ($old->cover_letter) {
        $this->unlinkImage($old->cover_letter);
      }
      $value['cover_letter'] = $this->documentProcessing($request->cover_letter);
    }

    $value['user_id'] = Auth::id();
    $this->jobseeker->updateJobSeekerProfile($value, Auth::id());
    return redirect()->back()->withInput()->with(['message' => 'Jobseeker Updated Successfully']);
  }

  public function updateExperience(Request $request)
  {
    $customMessages['job_title.required'] = "Job title is required";
    $customMessages['company_name.required'] = "Comapny name is required";

    foreach ($request->get('job_title') as $key => $value) {
      $customMessages['job_title.' . $key . '.required'] = "Job title is required";
    }
    foreach ($request->get('company_name') as $key => $value) {
      $customMessages['company_name.' . $key . '.required'] = "Company Name is required";
    }
    foreach ($request->get('start_date') as $key => $value) {
      $customMessages['start_date.' . $key . '.required'] = "Start Date is required";
    }
    foreach ($request->get('end_date') as $key => $value) {
      $customMessages['end_date.' . $key . '.required'] = "End Date is required";
    }
    foreach ($request->get('end_date') as $key => $value) {
      $customMessages['end_date.' . $key . '.after'] = "End Date must be after start date";
    }

    $validator = Validator::make($request->all(), [
      'job_title' => 'required|array',
      'job_title.*' => 'required|string',
      'company_name' => 'required|array',
      'company_name.*' => 'required|string',
      'start_date' => 'required|array',
      'start_date.*' => 'required|date',
      'end_date' => 'required|array',
      'end_date.*' => 'required|date|after:start_date.*'
    ], $customMessages);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->with(['tab' => $request->tab, 'work-exp-count' => (int) $request->get('work-exp-count')]);
    }
    $id = Auth::id();
    $jobseeker = Jobseeker::where('user_id', $id)->with('experiences')->first();
    $data = $request->all();
    $exp = Past_experience::find($request->exp_id);
    $value = $request->except('_token', 'tab');
    if (isset($request->exp_id) && !empty($request->exp_id)) {
      foreach ($value['job_title'] as $item) {
        $exp->jobseeker_id = $jobseeker->id;
        $exp->job_title = $item;
        foreach ($data['start_date'] as $value)
          $exp->start_date = $value;
        foreach ($data['end_date'] as $value)
          $exp->end_date = $value;
        foreach ($data['company_name'] as $value)
          $exp->company_name = $value;
        $exp->save();
      }
    } else {
      foreach ($value['job_title'] as $item) {
        $attributes = new Past_experience();
        $attributes->jobseeker_id = $jobseeker->id;
        $attributes->job_title = $item;

        foreach ($data['start_date'] as $value)
          $attributes->start_date = $value;
        foreach ($data['end_date'] as $value)
          $attributes->end_date = $value;
        foreach ($data['company_name'] as $value)
          $attributes->company_name = $value;
        $attributes->save();
      }
    }
    return redirect()->back()->with(['tab' => $request->tab, 'message' => 'Past experience Added Successfully']);

    // return redirect()->back()->with('message', 'Past experience Added Successfully');
  }


  public function additionalDocuments(Request $request)
  {
    $customMessages['title.required'] = "Title is required";
    $customMessages['documents.required'] = "Document is required";

    foreach ($request->get('title') as $key => $value) {
      $customMessages['title.' . $key . '.required'] = "Title is required";
    }
    // foreach ($request->get('documents') as $key => $value) {
    //   $customMessages['documents.' . $key . '.required'] = "Documents is required";
    // }
    $validator = Validator::make($request->all(), [
      'title' => 'required|array',
      'title.*' => 'required',
      'documents' => 'required|array',
      'documents.*' => 'required|mimes:jpg,jpeg,png,pdf,doc, docx|max:2048',
      'tab' => 'required'
    ], $customMessages);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->with(['tab' => $request->tab, 'work-exp-count' => (int) $request->get('work-exp-count')]);
    }
    $id = Auth::id();
    $data = $request->documents;
    $jobseeker = Jobseeker::where('user_id', $id)->first();

    if ($request->documents) {
      $path = public_path() . '/files';
      if (!File::exists($path)) {
        File::makeDirectory($path, 0777, true, true);
      }
      $temp = array();
      foreach ($request->title as $key => $title) {
        $documentName =  "document-" . date('Ymdhis') . rand(0, 1234) . "." . $request->documents[$key]->getClientOriginalExtension();
        $request->documents[$key]->move($path, $documentName);
        $temp[] = array(
          'jobseeker_id' => $jobseeker->id,
          'documents' => $documentName,
          'title' => $title
        );
      }
      $additionaldocs = new Additional_document();
      $additionaldocs->insert($temp);
    }
    return redirect()->back()->with(['tab' => $request->tab, 'message' => 'Documents Added Successfully']);
  }

  public function update(Request $request, $id)
  {
  }
  public function delete(Request $request, $id)
  {
    $record = Additional_document::findorfail($id);
    if ($record->documents) {
      $this->unlinkImage($record->documents);
    }

    $success = $record->delete();
    if ($success) {
      if (!empty($record->documents) && file_exists(public_path() . '/files/' . $record->documents)) {
        unlink(public_path() . '/files/' . $record->documents);
      }
      $request->session()->flash('success', 'Deleted Successfully');
    } else {
      $request->session()->flash('error', 'Sorry couldnot delete');
    }
    return redirect()->back()->with('message', 'Document Deleted Successfuly.');
  }
  public function appliedJobs()
  {
    $jobseeker = Jobseeker::where('user_id', auth()->id())->first();
    $applied_jobs = Applied_job::where('jobseeker_id', $jobseeker->id)->get();
    $applied_jobs_id = [];
    foreach ($applied_jobs as $item) {
      array_push($applied_jobs_id, $item->job_id);
    }
    if (count($applied_jobs_id) > 0) {
      $applies = Job::whereIn('id', $applied_jobs_id)->get();
    } else {
      $applies = [];
    }
    return view('front::front.jobseeker.all-applied-jobs', compact('applies'));
  }

  public function allJobs()
  {
    $alljobs = Job::whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->where('publish', 1)->orderBy('created_at', 'desc')->take(6)
      ->get();
    return view('front::front.jobseeker.all-job', compact('alljobs'));
  }

  public function imageProcessing($profile_image)
  {
    $input['imagename'] = time() . '.' . $profile_image->getClientOriginalExtension();
    $thumbPath = public_path('images/thumbnail');
    $mainPath = public_path('images/main');
    $listingPath = public_path('images/listing');

    $img1 = Image::make($profile_image->getRealPath());
    $img1->save($mainPath . '/' . $input['imagename']);
    $img2 = Image::make($profile_image->getRealPath());
    $img2->save($listingPath . '/' . $input['imagename']);
    $img1 = Image::make($profile_image->getRealPath());
    $img1->fit(90, 100)->save($thumbPath . '/' . $input['imagename']);

    $destinationPath = public_path('/images');
    return $input['imagename'];
  }

  public function documentProcessing($document)
  {
    $input['documentName'] = "document-" . date('Ymdhis') . rand(0, 1234) . "." . $document->getClientOriginalExtension();
    $document->move(public_path('files'), $input['documentName']);
    return $input['documentName'];
  }

  public function unlinkImage($imagename)
  {
    $thumbPath = public_path('images/thumbnail/') . $imagename;
    $mainPath = public_path('images/main/') . $imagename;
    $listingPath = public_path('images/listing/') . $imagename;
    $documentPath = public_path('files/') . $imagename;
    if (file_exists($thumbPath)) {
      unlink($thumbPath);
    }

    if (file_exists($mainPath)) {
      unlink($mainPath);
    }

    if (file_exists($listingPath)) {
      unlink($listingPath);
    }

    if (file_exists($documentPath)) {
      unlink($documentPath);
    }
    return;
  }
}
