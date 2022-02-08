<?php

namespace Modules\Job\Repositories;

use Modules\Job\Entities\Job;
use App\Repositories\Crud\CrudRepository;
use Carbon\Carbon;
use Image;
use Modules\Jobseeker\Repositories\JobseekerRepository;
use PDF, Auth;
use Illuminate\Support\Str;
use DateTimeZone, DateTime;




class JobRepository extends CrudRepository implements JobInterface
{
	public function __construct(Job $model, JobseekerRepository $jobseeker)
	{
		$this->model = $model;
		$this->jobseeker = $jobseeker;
	}

	public function create($data)
	{
		$detail = $this->model->create($data);
		return $detail;
	}

	public function update($data, $id)
	{
		return $this->model->find($id)->update($data);
	}

	public function jobStore($request)
	{
		// dd($request->all());
		$request->validate([
			'meta_title' => 'sometimes|max:70',
			'meta_description' => 'sometimes|max:160',
			'keywords' => 'sometimes',
			'job_title' => 'required',
			'country' => 'required',
			'jobcategory_id' => 'required|numeric',
			'town_city' => 'required',
			// 'street_address' => 'required',
			'job_description' => 'required',
			'application_receive_email' => 'required_without:application_receive_phone',
			'application_receive_phone' => 'required_without:application_receive_email',
			'job_status' => 'required',
			// 'application_receive' => 'required',
			'employer_name' => 'required',
			// 'employer_id' => 'required',
			'keyword' => 'sometimes',
			'published_date' => 'required|date',
			'deadline_date' => 'required|date|after:published_date',
			'offerred_salary_type' => 'sometimes',

			'currencies' => 'required_if:offerred_salary_type,range,fixed, range',
			'minimum_salary' => 'required_if:offerred_salary_type,range',
			'maximum_salary' => 'required_if:offerred_salary_type,range',
			'fixed_salary' => 'required_if:offerred_salary_type,fixed',

			'application_receive_email' => 'required_without:application_receive_phone',
			'application_receive_phone' => 'required_without:application_receive_email'
			// 'time_period' => 'required_if:offerred_salary_type,range,fixed, range'
		]);

		$formData = $request->except(['image', 'publish',  'slug', 'start_date']);

		$formData['publish'] = is_null($request->publish) ? 0 : 1;
		$formData['slug'] = $this->generateSlug($request->title, $request->slug, null);

		$application_received_email = '';
		$application_received_phone = '';

		$a = $request['application_receive_email'];
		$b = $request['application_receive_phone'];
		$a == 'on' ? $a_email = 'email_ok' : $a_email = 'email_not_ok';
		$b == 'on' ? $b_phone = 'phone_ok' : $b_phone = 'phone_not_ok';
		$formData['application_receive'] = $a_email . ',' . $b_phone;

		if ($request->hasFile('image')) {
			$formData['image'] = $this->imageProcessing($request->image, 870, 450, 'yes');
		}

		$timeNow = $this->getDateTime();

		$pub_date = $request->published_date . ' ' . $timeNow; //adds time to date coming from create form
		// dd($pub_date);
		$dead_date = $request->deadline_date . ' ' . $timeNow; //adds time to date coming from create form
		// dd($dead_date);
		$str_date = NULL;
		if ($request->start_date != 'no')
			$str_date = $request->start_date . ' ' . $timeNow; //adds time to date coming from create form



		$formData['published_date'] = $pub_date;
		$formData['deadline_date'] = $dead_date;
		$formData['start_date'] = $str_date;

		// dd($request->start_date);
		// $startDate = $request->start_date;
		// $startDate = $request->start_date . ' ' . $timeNow;
		// dd($formData);


		// $Date = new DateTime($request->start_date); // sample DateTime creation - also $Date = $user->updated_at; would work here

		// $startDate = $Date->format("Y-m-d H:i:s");

		// $startDate = $Date->format("Y-m-d");


		// $formData['start_date'] = $startDate;

		return $formData;
	}

	public function jobsUpdate($request, $oldRecord)
	{
		$request->validate([
			'meta_title' => 'sometimes|max:70',
			'meta_description' => 'sometimes|max:160',
			'keywords' => 'sometimes',
			'job_title' => 'required',
			'country' => 'required',
			'jobcategory_id' => 'required|numeric',
			'town_city' => 'required',
			// 'street_address' => 'required',
			'job_description' => 'required',
			'application_receive_email' => 'required_without:application_receive_phone',
			'application_receive_phone' => 'required_without:application_receive_email',
			'job_status' => 'required',
			'employer_name' => 'required',
			// 'employer_id' => 'required',
			'keyword' => 'sometimes',
			'published_date' => 'required|date',
			'deadline_date' => 'required|date|after:published_date',
			'offerred_salary_type' => 'sometimes',

			'currencies' => 'required_if:offerred_salary_type,range,fixed, range',
			'minimum_salary' => 'required_if:offerred_salary_type,range',
			'maximum_salary' => 'required_if:offerred_salary_type,range',
			'fixed_salary' => 'required_if:offerred_salary_type,fixed',
			// 'time_period' => 'required_if:offerred_salary_type,range,fixed, range'


		]);
		$formData = $request->except(['image', 'publish', 'application_receive_email', 'application_receive_phone']);

		$formData['publish'] = is_null($request->publish) ? 0 : 1;

		$application_received_email = '';
		$application_received_phone = '';
		$a = $request['application_receive_email'];
		$b = $request['application_receive_phone'];
		$a == 'on' ? $a_email = 'email_ok' : $a_email = 'email_not_ok';
		$b == 'on' ? $b_phone = 'phone_ok' : $b_phone = 'phone_not_ok';

		$formData['application_receive'] = $a_email . ',' . $b_phone;

		if ($request->hasFile('image')) {
			if ($oldRecord->image) {
				$this->unlinkImage($oldRecord->image);
			}
			$formData['image'] = $this->imageProcessing($request->image, 870, 450, 'yes');
		}

		$timeNow = $this->getDateTime();

		$pub_date = $request->published_date . ' ' . $timeNow; //adds time to date coming from create form
		$dead_date = $request->deadline_date . ' ' . $timeNow; //adds time to date coming from create form

		$formData['published_date'] = $pub_date;
		$formData['deadline_date'] = $dead_date;

		return $formData;
	}

	// public function jobUpdate($request, $oldRecord)
	// {
	// 	$request->validate($this->rules(), $this->messages());

	// 	$formData = $request->except(['profile_image', 'publish',]);

	// 	$formData['publish'] = is_null($request->publish) ? 0 : 1;

	// 	if ($request->profile_image) {

	// 		if ($oldRecord->profile_image) {
	// 			$this->unlinkImage($oldRecord->profile_image);
	// 		}

	// 		$profile_image = $request->file('profile_image');
	// 		$imageName = Date("D-h-i-s") . '-' . rand() . '.' . $profile_image->getClientOriginalExtension();
	// 		$profile_image->move(public_path('images/main'), $imageName);
	// 		$formData['profile_image'] = $imageName;
	// 	}

	// 	return $formData;
	// }

	public function downloadCV($jobSeekerId)
	{
		$jobseeker = $this->jobseeker->with(['experiences', 'documents'])->findOrFail($jobSeekerId);
		$pdf = PDF::loadView('front::front.cv', compact('jobseeker'));
		return [$jobseeker, $pdf];
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


	public function getDateTime()
	{
		$dtutc = Carbon::now(); //gives today's date, time and others like UTC, etc.
		$t = $dtutc->totimeString(); //extracts only time

		return $t;
	}
}
