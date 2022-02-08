<?php

namespace Modules\Job\Http\Controllers\Employer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Job\Repositories\JobRepository;
use Modules\Jobseeker\Repositories\JobseekerRepository;

class ApplicationController extends Controller
{
   protected $job;
   protected $jobseeker;
   public function __construct(JobRepository $job, JobseekerRepository $jobseeker)
   {
      $this->job = $job;
      $this->jobseeker = $jobseeker;
   }

   public function allApplications($jobId)
   {
      $datas['details'] = $this->job->where('employer_id', auth()->id())->with(['applications.jobseeker'])->findOrFail($jobId);
      return view('job::employer.applications.allApplications', $datas);
   }

   public function jobseekerInfos($jobSeekerId)
   {
      $datas['detail'] = $this->jobseeker->findOrFail($jobSeekerId);
      return view('job::employer.applications.jobseeker', $datas);
   }

   public function downloadCV($jobSeekerId)
   {
      $pdfInfos = $this->job->downloadCV($jobSeekerId);
      [$jobseeker, $pdf] = $pdfInfos;
      return $pdf->download($jobseeker->first_name ? $jobseeker->first_name . '-cv.pdf' : 'jobseeker-cv.pdf');
   }
}
