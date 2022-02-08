<?php

namespace Modules\Employer\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employer\Repositories\EmployerRepository;
use Modules\Jobseeker\Entities\Jobseeker;

class EmployerController extends Controller
{
    protected $model = null;
    public function __construct(EmployerRepository $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $datas['details'] = $details = $this->model->latest()->get();
        return view('employer::admin.list', $datas);
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
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $datas['detail'] = $detail = $this->model->findOrFail($id);
        return view('employer::admin.edit', $datas);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $oldRecord = $this->model->findOrFail($id);

        $formData = $this->model->employerUpdate($request, $oldRecord);

        $this->model->update($formData, $id);

        return redirect()->route('admin.employer.index')->with('message', 'Employer detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        abort(404);
    }
    public function jobseekerList()
    {
        $jobseeker = Jobseeker::latest()->get();
        return view('employer::admin.jobseeker-list', compact('jobseeker'));
    }
}
