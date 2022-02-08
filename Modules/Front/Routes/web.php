<?php

use App\Http\Controllers\Admin\PasswordResetController;
use Modules\Front\Http\Controllers\Employer\EmployerController;
use Modules\Front\Http\Controllers\Employer\JobController;
use Modules\Front\Http\Controllers\FrontController;
use Modules\Front\Http\Controllers\FooterController;

use Modules\Front\Http\Controllers\ProfileController;

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

// Route::prefix('front')->group(function() {
//     Route::get('/', 'FrontController@index');
// });

Route::group(['namespace' => 'front'], function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
    // Route::get('/', [FrontController::class, 'index']);
    // Route::get('home', [FrontController::class, 'index'])->name('home');
    Route::get('login', [FrontController::class, 'login'])->name('jobseeker.login');
    Route::post('jobseeker/login', [FrontController::class, 'postJobseekerLogin'])->name('postJobseekerLogin');


    Route::get('/job-detail', [FrontController::class, 'jobDetail'])->name('jobDetail');
    Route::get('register', [FrontController::class, 'register'])->name('jobseeker.register');
    Route::post('/jobseeker/register', [FrontController::class, 'postJobseekerRegister'])->name('postJobseekerRegister');
    //     // Route::get('/student-register', [DefaultController::class, 'studentRegister'])->name('studentRegister');
    Route::get('job-detail/{slug}', [FrontController::class, 'jobInner'])->name('jobInner');
    Route::get('search', [FrontController::class, 'search'])->name('search');
    Route::get('searchjobs', [FrontController::class, 'findAll'])->name('findAll');
    Route::get('search-on-key-up', [FrontController::class, 'searchOnKeyUp'])->name('searchOnKeyUp');

    // Jobseeker verification routes
    Route::get('account-activate/{activation_token}', [FrontController::class, 'verifyNewAccount'])->name('verifyNewAccount');
    // Route::get('account-activate/{username}', [DefaultController::class, 'verifyNewAccount'])->name('verifyNewAccount');
    Route::get('verification/code', [FrontController::class, 'verificationCode'])->name('verificationCode');
    Route::post('send-verification-email-link', [FrontController::class, 'sendVerificationLink'])->name('sendVerificationLink');
    Route::get('verification/{activation_token}', [FrontController::class, 'resendVerification'])->name('resendVerification');
    //Password Reset
    Route::get('password/reset', [FrontController::class, 'resetForm'])->name('password.reset');
    Route::post('send-email-link', [PasswordResetController::class, 'sendEmailLink'])->name('sendEmailLink');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'passwordResetForm'])->name('passwordResetForm');
    Route::post('update-password', [PasswordResetController::class, 'updatePassword'])->name('updatePassword');
    //Password Change
    Route::get('password/change', [PasswordResetController::class, 'changePasswordForm'])->name('changePasswordForm');
    Route::post('password/change', [PasswordResetController::class, 'changePassword'])->name('changePassword');
});

Route::group(['namespace' => 'front', 'middleware' => ['FrontMiddleware'], 'prefix' => 'jobseeker',], function () {

    Route::post('profile-info/edit/work-experience', [ProfileController::class, 'updateExperience'])->name('updateExperience');

    Route::get('profile-info/{username}', [ProfileController::class, 'profileInfo'])->name('profileInfo');
    Route::get('profile-info/{username}/edit', [ProfileController::class, 'editProfile'])->name('editProfile');
    // Route::post('profile-info/edit/work-experience', [ProfileController::class, 'updateExperience'])->name('updateExperience');
    Route::post('profile-info/edit/{id}', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('profile-info/{username}/applied-jobs', [ProfileController::class, 'appliedJobs'])->name('appliedJobs');
    Route::get('all-jobs', [ProfileController::class, 'allJobs'])->name('allJobs');
    Route::get('/delete/{id}', [ProfileController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');



    Route::post('profile-info/edit/{id}/additional-documents', [ProfileController::class, 'additionalDocuments'])->name('additionalDocuments');
    Route::get('overview', [FrontController::class, 'overview'])->name('overview');
    Route::post('apply', [FrontController::class, 'apply'])->name('apply');
    Route::get('logout', [FrontController::class, 'logout'])->name('logout');
});
Route::get('all-jobs', [ProfileController::class, 'allJobs'])->name('allJobs');
Route::group([
    'namespace' => 'Employer',
    'as' => 'employer.'
], function () {
    Route::post('employer-register', [EmployerController::class, 'postEmployerRegister'])->name('post.register');
    Route::get('employer-account-activate/{activation_token}', [EmployerController::class, 'verifyNewAccount'])->name('verifyNewAccount');

    Route::post('employer-login', [EmployerController::class, 'postEmployerLogin'])->name('post.login');

    Route::group(['middleware' => ['checkauth:employer', 'role:employer'],], function () {
        Route::get('employer-profile/{employerId}/edit', [EmployerController::class, 'getEmployerProfile'])->name('getProfile');
        Route::put('employer-profile/{employerId}', [EmployerController::class, 'updateEmployerProfile'])->name('updateProfile');
        Route::get('company-profile/{employername}', [EmployerController::class, 'getCompanyProfile'])->name('getCompanyProfile');
        Route::get('employer-overview/{employername}', [EmployerController::class, 'getEmployerOverview'])->name('getEmployerOverview');

        // New laravel routing system shows error... so using old way
        Route::get('job/{jobId}/applications', 'ApplicationController@allApplications')->name('applications');
        Route::get('applicant/{username}', 'ApplicationController@jobseekerInfos')->name('jobseeker.infos');
        Route::get('download-cv/{jobseekerId}', 'ApplicationController@downloadCV')->name('jobseeker.downloadcv');

        Route::get('job/job-type/{job_type}', 'JobController@get_job_by_type')->name('job.jobtype');
        Route::resource('job', 'JobController');
    });
});

Route::get('/alljobs', [FooterController::class, 'getAllJobs'])->name('getAllJobs');
Route::get('/city/{town_city}', [FooterController::class, 'locations'])->name('city.locations');
Route::get('/category/{slug}', [FooterController::class, 'jobByCategories'])->name('jobByCategories');
Route::get('/all-categories', [FooterController::class, 'allCategories'])->name('allCategories');
Route::get('/all-locations', [FooterController::class, 'allLocations'])->name('allLocations');
Route::get('company/{employername}', [EmployerController::class, 'CompanyProfile'])->name('CompanyProfile');
Route::get('profile-detail/{username}', [ProfileController::class, 'profileDetail'])->name('profileDetail');
Route::get('download/{id}', [ProfileController::class, 'downloadCv'])->name('downloadCv');
Route::get('/{slug}', [FooterController::class, 'dynamicPages'])->name('getPages');


// Route::get('/{slug}', [FooterController::class, 'pageNotFound'])->name('pageNotFound');
