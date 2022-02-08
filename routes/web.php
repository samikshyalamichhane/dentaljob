<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Front\JobseekerLoginController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Front\DefaultController;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('optimize-clear', function () {
    Artisan::call('optimize:clear');
    // dd(Artisan::output());
    // return redirect()->route('home');
});

Route::group([], function () {
    Route::get('admin/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('postLogin', [LoginController::class, 'postLogin'])->name('admin.postLogin');
    Route::get('password-reset', [PasswordResetController::class, 'resetForm'])->name('password-reset');
    Route::post('send-email-link', [PasswordResetController::class, 'sendEmailLink'])->name('sendEmailLink');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'passwordResetForm'])->name('passwordResetForm');
    Route::post('update-password', [PasswordResetController::class, 'updatePassword'])->name('updatePassword');
});


Route::group(['middleware' => 'auth', 'prefix' => 'admin',], function () {
    Route::get('logout', [LoginController::class, 'admin__logout'])->name('admin.logout');
});
