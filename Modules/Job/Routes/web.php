<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::prefix('job/create')->middleware('auth')->group(function() {
//     Route::get('/', 'JobController@create');
// });

// Route::prefix('job')->middleware('auth')->group(function() {
//     Route::get('/', 'JobController@index');
// });

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'role:admin'],
], function () {
    Route::resource('job', 'JobController');
    Route::post('view-job', 'JobController@viewJob')->name('viewJob');
});

// Job applications related routes
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['auth',],
    'as' => 'admin.',
], function () {
    Route::get('job/{jobId}/applications', 'ApplicationController@allApplications')->name('applications');
    Route::get('jobseeker/{jobseekerId}', 'ApplicationController@jobseekerInfos')->name('jobseeker.infos');
    Route::get('download-cv/{jobseekerId}', 'ApplicationController@downloadCV')->name('jobseeker.downloadcv');
});

// Route::group([
//     'middleware' => ['checkauth:employer', 'role:employer',],
//     'namespace' => 'Employer',
//     'prefix' => 'employer',
//     'as' => 'employer.',
// ], function () {
//     Route::resource('employer/job', 'JobController');
//     Route::get('job/{jobId}/applications', 'ApplicationController@allApplications')->name('applications');
//     Route::get('jobseeker/{jobseekerId}', 'ApplicationController@jobseekerInfos')->name('jobseeker.infos');
//     Route::get('download-cv/{jobseekerId}', 'ApplicationController@downloadCV')->name('jobseeker.downloadcv');
// });
