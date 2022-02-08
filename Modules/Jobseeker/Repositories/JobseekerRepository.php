<?php

namespace Modules\Jobseeker\Repositories;

use App\Repositories\Crud\CrudRepository;
use Image;
use Modules\Jobseeker\Entities\Jobseeker;
use Illuminate\Support\Facades\Auth;

class JobseekerRepository extends CrudRepository implements JobseekerInterface
{
	public function __construct(Jobseeker $model)
	{
		$this->model = $model;
	}
	public function create($data)
	{
		$detail = $this->model->create($data);
		// dd($detail);
		return $detail;
	}
	public function updateJobSeekerProfile($data, $id)
	{
		// dd($data);
		return $this->model->where('user_id', $id)->update($data, $id);
	}

	public function jobseekerUpdate($request, $oldRecord)
	{
		$request->validate($this->rules(), $this->messages());

		$formData = $request->except(['profile_image', 'publish',]);

		$formData['publish'] = is_null($request->publish) ? 0 : 1;

		if ($request->profile_image) {

			if ($oldRecord->profile_image) {
				$this->unlinkImage($oldRecord->profile_image);
			}

			$profile_image = $request->file('profile_image');
			$imageName = Date("D-h-i-s") . '-' . rand() . '.' . $profile_image->getClientOriginalExtension();
			$profile_image->move(public_path('images/main'), $imageName);
			$formData['profile_image'] = $imageName;
		}

		return $formData;
	}

	public function rules()
	{
		return  [
			'profile_image' => 'max:3048',
			'facebook' => 'nullable|url',
			'twitter' => 'nullable|url',
			'youtube' => 'nullable|url',
			'instagram' => 'nullable|url',
			'linkedin' => 'nullable|url',
			'whatsapp' => 'nullable|url',
		];
	}

	public function messages()
	{
		return  [
			'facebook.url' => 'facebook link must be url',
			'twitter.url' => 'twitter link must be url',
			'youtube.url' => 'youtube link must be url',
			'instagram.url' => 'instagram link must be url',
			'linkedin.url' => 'linkedin link must be url',
			'whatsapp.url' => 'whatsapp link must be url',
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
