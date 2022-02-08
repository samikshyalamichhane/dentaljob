<?php

namespace Modules\Jobseeker\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Jobseeker\Repositories\JobseekerRepository;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JobseekerController extends Controller
{

    protected $model = null;
   public function __construct(JobseekerRepository $model)
   {
      $this->model = $model;
   }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function getJobseekerDashboard()
    {
       return view('jobseeker::jobseeker.dashboard');
    }


    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('jobseeker::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
   {
      //
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
