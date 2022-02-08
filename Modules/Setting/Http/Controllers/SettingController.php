<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Repositories\SettingRepository;
use Image;


class SettingController extends Controller
{
    public function __construct(SettingRepository $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $datas['detail'] = $detail = $this->model->first();
        return view('setting::index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        abort(404);
        return view('setting::create');
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
        abort(404);
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

        $request->validate($this->rules(), $this->messages());
        $formData = $request->except(['logo_left', 'logo_right', 'favicon']);

        if ($request->logo_left) {
            if ($oldRecord->logo_left) {
                $this->unlinkImage($oldRecord->logo_left);
            }
            $logo = $request->file('logo_left');
            $imageName = Date("D-h-i-s") . '-' . rand() . '.logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/main'), $imageName);
            $formData['logo_left'] = $imageName;
        }

        if ($request->favicon) {
            if ($oldRecord->favicon) {
                $this->unlinkImage($oldRecord->favicon);
            }
            $logo = $request->file('favicon');
            $imageName = Date("D-h-i-s") . '-' . rand() . '.logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/main'), $imageName);
            $formData['favicon'] = $imageName;
        }

        if ($request->logo_right) {
            if ($oldRecord->logo_right) {
                $this->unlinkImage($oldRecord->logo_right);
            }
            $logo = $request->file('logo_right');
            $imageName = Date("D-h-i-s") . '-' . rand() . '.logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/main'), $imageName);
            $formData['logo_right'] = $imageName;
        }


        $oldRecord->update($formData);
        return redirect()->route('setting.index')->with('message', 'Setting updated Successfully');
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

    public function rules()
    {
        $rules = [
            'site_name' => 'required',
            'link1' => 'sometimes|url',
            'link2' => 'sometimes|url',
            'logo_left' => 'max:3048',
            'logo_right' => 'max:3048',
            // 'meta_title' => 'sometimes|max:70',
            // 'meta_description' => 'sometimes|max:160',
            'keywords' => 'sometimes'
            // 'contactus_image' => 'dimensions:max_width=2000,max_height=2000|mimes:jpg,jpeg,png,gif|max:3048',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            // 'contactus_image.dimensions' => 'Upto 2000 * 2000 size is allowed',
        ];
    }

    public function imageProcessing($image, $width, $height, $otherpath)
    {

        $input['imagename'] = Date("D-h-i-s") . '-' . rand() . '.' . $image->getClientOriginalExtension();
        $thumbPath = public_path('images/thumbnail');
        $mainPath = public_path('images/main');
        $listingPath = public_path('images/listing');

        $img = Image::make($image->getRealPath());
        $img->fit($width, $height)->save($mainPath . '/' . $input['imagename']);

        // with no fit
        // $img->save($mainPath . '/' . $input['imagename']);

        if ($otherpath == 'yes') {
            $img->fit($width / 2, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($listingPath . '/' . $input['imagename']);

            $img->fit(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbPath . '/' . $input['imagename']);
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


// if ($request->hasFile('about__bg__image')) {
//     if ($oldRecord->about__bg__image) {
//         $this->unlinkImage($oldRecord->about__bg__image);
//     }
//     $formData['about__bg__image'] = $this->imageProcessing($request->file('about__bg__image'), 1370, 500, 'yes');
// }
