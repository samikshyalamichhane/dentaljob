<?php

namespace Modules\Front\Http\Controllers\Employer;

use App\Repositories\User\UserRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Job\Repositories\JobRepository;
use Modules\Jobseeker\Repositories\JobseekerRepository;

class ApplicationController extends Controller
{
   protected $job;
   protected $jobseeker;
   protected $user;
   public function __construct(JobRepository $job, JobseekerRepository $jobseeker, UserRepository $user)
   {
      $this->job = $job;
      $this->jobseeker = $jobseeker;
      $this->user = $user;
   }

   public function allApplications($jobId)
   {
      $datas['details'] = $this->job->where('employer_id', auth()->user()->employer->id)->with(['applications.jobseeker.user',])->findOrFail($jobId);
      return view('front::front.employer.job.allApplicants', $datas);
   }

   public function jobseekerInfos($jobSeekerUsername)
   {
      $datas['user'] = $this->user->with(['jobseeker.experiences', 'jobseeker.documents'])->where('username', $jobSeekerUsername)->firstOrFail();
      return view('front::front.employer.job.applicant', $datas);
   }

   public function downloadCV($jobSeekerId)
   {

      $pdfInfos = $this->job->downloadCV($jobSeekerId);
      [$jobseeker, $pdf] = $pdfInfos;


      return $pdf->download($jobseeker->first_name ? $jobseeker->first_name . '-cv.pdf' : 'jobseeker-cv.pdf');
   }
}
