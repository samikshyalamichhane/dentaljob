<?php

namespace Modules\Jobcategory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Image;
use Modules\Jobcategory\Repositories\JobcategoryRepository;

class JobcategoryController extends Controller
{

    public function __construct(JobcategoryRepository $model)
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
        return view('jobcategory::list', $datas);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('jobcategory::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif|max:3048',
        ]);

        $formData = $request->except(['image', 'publish', 'slug',]);
        $formData['publish'] = is_null($request->publish) ? 0 : 1;

        if ($request->hasFile('image')) {
            $formData['image'] = $this->imageProcessing($request->image, 870, 450, 'yes');
        }

        $this->model->create($formData);
        return redirect()->route('jobcategory.index')->with('message', 'jobcategory created successfuly.');
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
        return view('jobcategory::edit', $datas);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif|max:3048',
        ]);
        $oldRecord = $this->model->findOrFail($id);

        $formData = $request->except(['image', 'publish', 'slug',]);

        $formData['publish'] = is_null($request->publish) ? 0 : 1;

        if ($request->hasFile('image')) {
            if ($oldRecord->image) {
                $this->unlinkImage($oldRecord->image);
            }
            $formData['image'] = $this->imageProcessing($request->image, 870, 450, 'yes');
        }

        $this->model->update($formData, $id);

        return redirect()->route('jobcategory.index')->with('message', 'jobcategory edited successfuly.');
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

        return redirect()->route('jobcategory.index')->with('message', 'jobcategory deleted successfuly.');
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
