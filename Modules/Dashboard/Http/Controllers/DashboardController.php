<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Modules\Jobseeker\Entities\Jobseeker;
use DateTime;
use Modules\Employer\Entities\Employer;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $total_categories = DB::table('jobcategories')->latest()->get();
        $total_jobseekers = DB::table('jobseekers')->latest()->get();
        $total_employers = DB::table('employers')->latest()->get();
        $total_users = DB::table('users')->latest()->get();
        $total_jobs = DB::table('jobs')->latest()->get();
        // $jobseekers = DB::table('jobseekers')->latest()->get();
        // dd($jobseekers);
        // $labels = $speeds->pluck('id');
        // $data = $speeds->pluck('speed');
        return view('dashboard::index', compact('total_categories', 'total_jobseekers', 'total_employers', 'total_users', 'total_jobs'));
    }

    public function getAllMonths()
    {
        $month_array = array();
        $posts_dates = Jobseeker::orderBy('created_at', 'ASC')->pluck('created_at');
        $posts_dates = json_decode($posts_dates);
        // return $posts_dates;


        if (!empty($posts_dates)) {
            foreach ($posts_dates as $unformatted_date) {
                // $dt = new DateTime($unformatted_date);
                // $d = date('Y-m-d', strtotime($unformatted_date->creation_date));
                $date = new \DateTime($unformatted_date);
                // $date = $dt->format('m/d/Y');
                // dd($date);

                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] = $month_name;
            }
        }
        return $month_array;
        // return $this->getMonthlyJobseekerCount(5);
    }

    public function getMonthlyJobseekerCount($month)
    {
        $monthly_post_count = Jobseeker::whereMonth('created_at', $month)->get()->count();
        return $monthly_post_count;
    }


    public function getMonthlyEmployerCount($month)
    {
        $monthly_post_count1 = Employer::whereMonth('created_at', $month)->get()->count();
        return $monthly_post_count1;
    }
    public function getMonthlyPostData()
    {

        $monthly_post_count_array = array();
        $monthly_post_count_array1 = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        $month_name_array1 = array();
        if (!empty($month_array)) {
            foreach ($month_array as $month_no => $month_name) {
                $monthly_post_count = $this->getMonthlyJobseekerCount($month_no);
                $monthly_post_count1 = $this->getMonthlyEmployerCount($month_no);
                array_push($monthly_post_count_array, $monthly_post_count);
                array_push($month_name_array, $month_name);
                array_push($monthly_post_count_array1, $monthly_post_count1);
                array_push($month_name_array1, $month_name);
            }
        }

        $max_no = max($monthly_post_count_array);
        $max = round(($max_no + 10 / 2) / 10) * 10;
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
        );
        $max_no = max($monthly_post_count_array1);

        $monthly_post_data_array1 = array(
            'months' => $month_name_array,
            'post_count_data' => $monthly_post_count_array1,
            'max' => $max,
        );

        // return $monthly_post_data_array;
        return response()->json([
            $monthly_post_data_array, $monthly_post_data_array1
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
