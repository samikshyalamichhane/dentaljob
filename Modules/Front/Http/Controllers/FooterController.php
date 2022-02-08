<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Job\Entities\Job;
use Modules\Jobseeker\Entities\Jobseeker;
use Modules\Employer\Entities\Employer;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Str;
use Mail;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Jobseeker\Entities\Applied_job;
use Modules\Advertisement\Entities\Advertisement;
use Modules\Jobseeker\Entities\Past_experience;
use Modules\Jobseeker\Repositories\JobseekerRepository;
use Modules\Page\Entities\Page;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use function PHPUnit\Framework\isEmpty;
use Response;
use Illuminate\Support\Facades\Cookie;
use DateTime;
use Modules\Jobcategory\Entities\Jobcategory;
use Carbon\Carbon;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function dynamicPages($slug)
    {
        $page = Page::published()->where('slug', $slug)->first();
        if ($page) {
            //for about us
            if ($slug == 'about-us') {
                try {
                    $detail = Page::published()->where('slug', $slug)->first();
                    $og['title'] = $detail->meta_title;
                    $og['image'] = $detail->image;
                    $og['keywords'] = $detail->keyword;
                    $og['description'] = $detail->meta_description;
                    return view('front::front.pages.page', compact('detail', 'og'));
                    die;
                } catch (\Exception $ae) {
                    abort('404');
                }
            }

            //for privacy policy
            if ($slug == 'privacy-policy') {
                try {
                    $detail = Page::published()->where('slug', $slug)->first();
                    $og['title'] = $detail->meta_title;
                    $og['image'] = $detail->image;
                    $og['keywords'] = $detail->keyword;
                    $og['description'] = $detail->meta_description;
                    return view('front::front.pages.page', compact('detail', 'og'));
                    die;
                } catch (\Exception $ae) {
                    abort('404');
                }
            }

            //for terms and condition
            if ($slug == 'terms-and-condition') {
                try {
                    $detail = Page::published()->where('slug', $slug)->first();
                    $og['title'] = $detail->meta_title;
                    $og['image'] = $detail->image;
                    $og['keywords'] = $detail->keyword;
                    $og['description'] = $detail->meta_description;
                    return view('front::front.pages.page', compact('detail', 'og'));
                    die;
                } catch (\Exception $ae) {
                    abort('404');
                }
            }
        } else {
            abort(404);
        }
    }

    public function locations($town_city)
    {
        $job = Job::where('town_city', $town_city)->published()->open()->orderBy('created_at', 'desc')
            ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->take(6)->get();
        // dd($job);
        return view('front::front.jobseeker.location-job', compact('job', 'town_city'));
    }

    public function jobByCategories($slug)
    {
        $jobcategory = Jobcategory::where('slug', $slug)->with('jobs')->latest()->published()->first();
        $jobs = Job::where('jobcategory_id', $jobcategory->id)->published()->open()->orderBy('created_at', 'desc')
            ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->get();
        // dd($jobs);
        return view('front::front.jobseeker.category-job', compact('jobcategory', 'jobs'));
    }

    public function allCategories()
    {
        $jobcategory = Jobcategory::latest()->published()->with('jobs')->get();
        // dd($jobcategory);
        return view('front::front.jobseeker.all-category-jobs', compact('jobcategory'));
    }

    public function getAllJobs()
    {
        $dt = \Carbon\Carbon::now();
        $alljobs = Job::published()->open()->orderBy('created_at', 'desc')
            ->whereDate('deadline_date', '>=', \Carbon\Carbon::now()->toDateString())->get();

        if (is_null(auth()->user())) {
            return view('front::front.jobseeker.alljobs', compact('alljobs'));
        }
        return view('front::front.jobseeker.alljobs', compact('alljobs'));
    }

    public function allLocations()
    {
        $locations = Job::latest()->published()->select('town_city')->get();
        $jobDate = Job::whereDate('created_at', Carbon::today())->count();
        return view('front::front.jobseeker.all-location-jobs', compact('locations', 'jobDate'));
    }

    public function pageNotFound()
    {
        dd(23);
        return view('front::front.jobseeker.page_not_found');
    }
}
