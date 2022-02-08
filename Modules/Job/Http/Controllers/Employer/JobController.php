<?php

namespace Modules\Job\Http\Controllers\Employer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Job\Repositories\JobRepository;
use Modules\Jobcategory\Repositories\JobcategoryRepository;
use Modules\Employer\Repositories\EmployerRepository;
use Modules\Job\Entities\Job;
// use Modules\Jobcategory\Entities\Jobcategory;
use Image;
use Auth;



class JobController extends Controller
{

    private $model;
    private $jobcategory;
    private $employer;
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
        $jobCategories = $this->jobcategory->orderBy('created_at', 'desc')->get();
        // $datas['details'] = $details = $this->model->latest()->with('jobcategory')->get();
        $jobs = Job::with(['jobcategory',])->withCount(['applications'])->where('employer_id', auth()->id())->orderBy('created_at', 'DESC')->get();
        return view('job::employer.list', compact('jobCategories', 'jobs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $jobCategories = $this->jobcategory->orderBy('created_at', 'desc')->get();

        return view('job::employer.create', compact('jobCategories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $formData = $this->model->jobStore($request);
        $formData['employer_id'] = auth()->id();

        $this->model->create($formData);
        return redirect()->route('employer.job.index')->with('message', 'job created successfuly.');
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
        // dd($detail);
        // $employment = $this->employmentSalaryType->get();
        $jobCategories = $this->jobcategory->orderBy('created_at', 'desc')->get();
        // $employType = $this->employmentSalaryType->where('type', 'employment')->get();


        return view('job::employer.edit', compact('detail', 'jobCategories'));
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
        $formData['employer_id'] = auth()->id();

        $this->model->update($formData, $id);

        return redirect()->route('employer.job.index')->with('message', 'job edited successfuly.');
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

        return redirect()->route('employer.job.index')->with('message', 'job deleted successfuly.');
    }

    public function generateSlug($title, $slug, $oldRecord)
    {
        if (is_null($slug)) {
            $slugReturn = Str::slug($title);
        } else {
            $slugReturn = Str::slug($slug);
        }

        $count = $this->model->where('slug', $slugReturn)->count();

        if (!is_null($oldRecord)) {
            if ($oldRecord->slug == $slugReturn) {
                return $slugReturn;
            } else {
                if ($count > 0) {
                    return $slugReturn . '-' . $count;
                } else {
                    return $slugReturn;
                }
            }
        } else {
            if ($count > 0) {
                return $slugReturn . '-' . $count;
            } else {
                return $slugReturn;
            }
        }
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
