<?php

namespace Modules\Advertisement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Advertisement\Repositories\AdvertisementRepository;
use Intervention\Image\Facades\Image;


class AdvertisementController extends Controller
{
    public function __construct(AdvertisementRepository $model)
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
        return view('advertisement::index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('advertisement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif|max:3048',
            'published_date' => 'required|date',
            'link' => 'sometimes|url',
            'expire_date' => 'required|date|after:published_date'
        ]);

        $formData = $request->except(['image', 'publish',]);
        $formData['publish'] = is_null($request->publish) ? 0 : 1;

        if ($request->hasFile('image')) {
            $formData['image'] = $this->imageProcessing($request->image, 'yes');
        }

        $this->model->create($formData);
        return redirect()->route('advertisement.index')->with('message', 'advertisement created successfuly.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('advertisement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $datas['detail'] = $detail = $this->model->findOrFail($id);
        return view('advertisement::edit', compact('detail'));
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
            'link' => 'sometimes|url',
            'published_date' => 'required|date',
            'expire_date' => 'required|date|after:published_date'
        ]);
        $oldRecord = $this->model->findOrFail($id);

        $formData = $request->except(['image', 'publish',]);

        $formData['publish'] = is_null($request->publish) ? 0 : 1;

        if ($request->hasFile('image')) {
            if ($oldRecord->image) {
                $this->unlinkImage($oldRecord->image);
            }
            $formData['image'] = $this->imageProcessing($request->image, 'yes');
        }
        $this->model->update($formData, $id);

        return redirect()->route('advertisement.index')->with('message', 'Advertisement edited successfuly.');
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

        return redirect()->route('advertisement.index')->with('message', 'Advertisement deleted successfuly.');
    }
    public function imageProcessing($image, $otherpath)
    {
        $input['imagename'] = Date("D-h-i-s") . '-' . rand() . '.' . $image->getClientOriginalExtension();
        $thumbPath = public_path('images/thumbnail');
        $mainPath = public_path('images/main');
        $listingPath = public_path('images/listing');

        $img = Image::make($image->getRealPath());
        $img->save($mainPath . '/' . $input['imagename']);

        if ($otherpath == 'yes') {
            $img1 = Image::make($image->getRealPath());
            $img1->resize(null, function ($constraint) {
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
