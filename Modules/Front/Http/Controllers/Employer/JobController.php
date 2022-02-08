<?php

namespace Modules\Front\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Modules\Employer\Repositories\EmployerRepository;
use Auth;
use Mail;
use Modules\Job\Repositories\JobRepository;
use Modules\Jobcategory\Repositories\JobcategoryRepository;

class JobController extends Controller
{

   protected $model;
   protected $jobcategory;

   public function __construct(JobRepository $model, JobcategoryRepository $jobcategory)
   {
      $this->model = $model;
      $this->jobcategory = $jobcategory;
   }
   /**
    * Display a listing of the resource.
    * @return Renderable
    */
   public function index()
   {
      $datas['details'] = $details = $this->model->withCount(['applications'])->where('employer_id', auth()->user()->employer->id)->where('job_status', 'open')->orderBy('created_at', 'DESC')->get();
      return view('front::front.employer.job.list', $datas);
   }

   /**
    * Show the form for creating a new resource.
    * @return Renderable
    */
   public function create()
   {
      $datas['jobCategories'] = $this->jobcategory->publish()->get();
      $datas['paused_jobs'] = $this->model->latest__publish()->with(['employer'])->where('job_status', 'paused')->take(10)->get();
      return view('front::front.employer.job.create', $datas);
   }

   /**
    * Store a newly created resource in storage.
    * @param Request $request
    * @return Renderable
    */
   public function store(Request $request)
   {

      $formData = $this->model->jobStore($request);
      $formData['employer_id'] = auth()->user()->employer->id;
      $formData['publish'] = 1;

      $this->model->create($formData);
      return redirect()->route('employer.job.index')->with('message', 'Job created successfuly.');
   }

   /**
    * Show the specified resource.
    * @param int $id
    * @return Renderable
    */
   public function show($id)
   {
      abort('404');
   }

   /**
    * Show the form for editing the specified resource.
    * @param int $id
    * @return Renderable
    */
   public function edit($id)
   {
      $datas['detail'] = $detail = $this->model->findOrFail($id);
      $datas['jobCategories'] = $this->jobcategory->publish()->get();
      $datas['paused_jobs'] = $this->model->latest__publish()->with(['employer'])->where('job_status', 'paused')->take(10)->get();
      return view('front::front.employer.job.edit', $datas);
   }

   /**
    * Update the specified resource in storage.
    * @param Request $request
    * @param int $id
    * @return Renderable
    */
   public function update(Request $request, $id)
   {
      dd($request->all());
      $oldRecord = $this->model->findOrFail($id);
      $formData = $this->model->jobsUpdate($request, $oldRecord);
      $formData['publish'] = $oldRecord->publish;

      $this->model->update($formData, $id);
      return redirect()->route('employer.job.index')->with('message', 'Job edited successfuly.');
   }

   /**
    * Remove the specified resource from storage.
    * @param int $id
    * @return Renderable
    */
   public function destroy($id)
   {
      $oldRecord = $this->model->findOrFail($id);

      $oldRecord->delete();

      return redirect()->route('employer.job.index')->with('message', 'Job deleted successfuly.');
   }

   public function get_job_by_type($jobtype)
   {
      $datas['details'] = $details = $this->model->withCount(['applications'])->where('employer_id', auth()->user()->employer->id)->where('job_status', $jobtype)->orderBy('created_at', 'DESC')->get();
      return response()->json([
         'type' => $jobtype,
         'html' => view('front::front.employer.job.jobtype', $datas)->render(),
      ]);
   }
}
