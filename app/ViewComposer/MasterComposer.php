<?php

namespace App\ViewComposer;

use Illuminate\View\View;
use Modules\Setting\Repositories\SettingRepository;

class MasterComposer
{
	public function __construct(SettingRepository $setting)
	{
		$this->setting = $setting;
	}
	public function compose(View $view)
	{
		$data = $view->getData();
		$value = $this->setting->first();
		if (!isset($data['og'])) {
			$og = array('title' => '', 'description' => '', 'keywords' => '');

			$og['title'] = $value->meta_title;
			$og['description'] = $value->meta_description;
			$og['keywords'] = $value->keyword;
			$og['image'] = '';

			$view->with(['og' => $og]);
		}
		// if (!isset($data['og'])) {
		// 	$og = [
		// 		'job_title' => '',
		// 		'job_description' => '',
		// 		'keywords' => '',
		// 	];

		// 	$og['job_title'] = $value != null ? $value->meta_title : 'Dental Job Online';
		// 	$og['job_description'] = $value != null && $value->meta_description != null ? $value->meta_description : 'Denal Job Online';
		// 	$og['keywords'] = $value != null && $value->meta_keywords != null ? $value->meta_keywords : 'Denal Job Online';
		// 	$og['image'] = '';

		// 	$view->with(['og' => $og]);
		// }
	}
}
