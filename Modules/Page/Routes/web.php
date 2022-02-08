<?php

use Modules\Page\Http\Controllers\PageController;

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

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'role:admin'],
], function () {
    Route::resource('page', 'PageController');
});
Route::get('/delete/{id}', [PageController::class, 'remove'])->name('remove');
