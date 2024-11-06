<?php

use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\KeywordController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SitemapController;
use App\Http\Controllers\front\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

Route::view('/', 'welcome')->name('home');
Route::view('/gem-registration', 'user.gem-registration')->name('gem-registration');
Route::view('/service', 'user.service')->name('service');
Route::view('/certificate', 'user.certificate')->name('certificate');
Route::view('/contact', 'user.contact')->name('contact');
Route::post('/contact', [IndexController::class,'contactStore'])->name('contact.store');
Route::view('/about', 'user.about')->name('about');

Route::get('/post/{id}/{slug}', [HomeController::class, 'single'])->name('front.single');
// Route::get('/', function () {
//     return view('auth/login');
// })->middleware('guest');
// Route::get('/', function () {
//     return view('auth/login');
// })->middleware('guest');

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});

Route::view('/admin', 'admin.index')->middleware('auth');
Route::group(['prefix' => 'admin', 'middleware' => ['auth'],], function () {
    Route::get('services/data', [ServiceController::class, 'getData'])->name('services.data');
    Route::get('/delete/{id}', [ServiceController::class, 'destroy'])->name('services.delete');
    Route::get('/changeStatus/{id}', [ServiceController::class, 'changeStatus'])->name('services.changeStatus');
    Route::resource('services', ServiceController::class);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth'],], function () {
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/delete/{id}', [ContactController::class, 'destroy'])->name('contacts.delete');
    Route::get('contacts/data', [ContactController::class, 'getData'])->name('contacts.data');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.index');
    Route::put('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/password', [ProfileController::class, 'showPasswordForm'])->name('profile.password.form');
    Route::put('profile/password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('setting/{id}', [SettingController::class, 'update'])->name('setting.update');
});


