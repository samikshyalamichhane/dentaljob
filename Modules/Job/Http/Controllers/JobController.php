<?php

namespace Modules\Job\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Image;
use Modules\Employer\Repositories\EmployerRepository;
use Modules\Job\Repositories\JobRepository;
use Modules\Jobcategory\Entities\Jobcategory;
use Modules\Jobcategory\Repositories\JobcategoryRepository;
use Modules\Job\Entities\Job;
use Carbon\Carbon;
use Auth;
use DateTimeZone, DateTime;




class JobController extends Controller
{

    protected $model;
    protected $jobcategory;
    protected $employer;

    public function __construct(JobRepository $model, JobcategoryRepository $jobcategory, EmployerRepository $employer)
    {
        $this->model = $model;
        $this->jobcategory = $jobcategory;
        $this->employer = $employer;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $datas['details'] = $details = $this->model->withCount(['applications'])->latest()->get();
        return view('job::index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $jobCategories = $this->jobcategory->orderBy('created_at', 'desc')->get();
        $employers = $this->employer->orderBy('created_at', 'asc')->get();

        return view('job::create', compact('jobCategories', 'employers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $formData = $this->model->jobStore($request);
        $this->model->create($formData);
        return redirect()->route('job.index')->with('message', 'job created successfuly.');
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
        $detail = $this->model->findOrFail($id);
        // dd($detail->start_date);

        $pubDate = $detail->published_date->format('Y-m-d');
        $deadDate = $detail->deadline_date->format('Y-m-d');
        $startDate = $detail->start_date != null ? $detail->start_date->format('Y-m-d') : "";

        $jobCategories = $this->jobcategory->orderBy('created_at', 'desc')->get();

        $employers = $this->employer->orderBy('created_at', 'asc')->get();

        return view('job::edit', compact('detail', 'jobCategories', 'employers', 'pubDate', 'deadDate', 'startDate'));
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
        $formData = $this->model->jobsUpdate($request, $oldRecord);

        $this->model->update($formData, $id);

        return redirect()->route('job.index')->with('message', 'job edited successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $oldRecord = $this->model->findOrFail($id);

        if ($oldRecord->image) {
            $this->unlinkImage($oldRecord->image);
        }

        $oldRecord->delete();

        return redirect()->route('job.index')->with('message', 'job deleted successfuly.');
    }

    public function viewJob(Request $request)
    {
        // dd($request->id);
        $detail = $this->model->findOrFail($request->id);
        return view('job::preview', compact('detail'));
    }
    public function imageProcessing($image, $width, $height, $otherpath)
    {
        $input['imagename'] = Date("D-h-i-s") . '-' . rand() . '.' . $image->getClientOriginalExtension();
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
        $documentPath = public_path('document/') . $imagename;
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
