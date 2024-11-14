<?php

use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\KeywordController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\QuestionController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SitemapController;
use App\Http\Controllers\admin\TenderController;
use App\Http\Controllers\admin\TenderInquiryController;
use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\front\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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
Route::view('/certificate', 'user.certificate')->name('certificate');
Route::view('/contact', 'user.contact')->name('contact');
Route::post('/contact', [IndexController::class,'contactStore'])->name('contact.store');
Route::view('/about', 'user.about')->name('about');

Route::get('/tenders', [IndexController::class,'tender'])->name('front.tender');
Route::get('/fetch-tenders', [IndexController::class, 'fetchTenders'])->name('fetch.tenders');
Route::get('/tender/{id}', [IndexController::class,'tenderShow'])->name('front.tender.show');
Route::get('/tender/download/{id}', [IndexController::class,'tenderDownload'])->name('front.tender.download');
Route::post('/tender/inquiry', [IndexController::class,'tenderInquiry'])->name('front.tender.inquiry');
Route::get('/post/{id}/{slug}', [HomeController::class, 'single'])->name('front.single');


Route::post('user/register',[AuthController::class,'register'])->name('front.auth.register');
Route::post('user/login',[AuthController::class,'login'])->name('front.auth.login');
Route::post('user/logout', [AuthController::class, 'logout'])->name('front.auth.logout');
// Route::get('/', function () {
//     return view('auth/login');
// })->middleware('guest');
// Route::get('/', function () {
//     return view('auth/login');
// })->middleware('guest');

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});

Route::get('/admin', [DashboardController::class,'index'])->middleware('auth');
Route::group(['prefix' => 'admin', 'middleware' => ['auth'],], function () {
    Route::get('services/data', [ServiceController::class, 'getData'])->name('services.data');
    Route::get('/changeStatus/{id}', [ServiceController::class, 'changeStatus'])->name('services.changeStatus');
    Route::resource('services', ServiceController::class);
    Route::get('service/delete/{id}', [ServiceController::class, 'destroy'])->name('servicesss.delete');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth'],], function () {
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/delete/{id}', [ContactController::class, 'destroy'])->name('contacts.delete');
    Route::get('contacts/data', [ContactController::class, 'getData'])->name('contacts.data');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth'],], function () {
    Route::get('/delete/{id}', [TenderInquiryController::class, 'destroy'])->name('tender-inquiries.delete');
    Route::get('tender-inquiries', [TenderInquiryController::class, 'index'])->name('tender-inquiries.index');
    Route::get('/tender-inquiries/delete/{id}', [TenderInquiryController::class, 'destroy'])->name('tender-inquiries.delete');
    Route::get('inquiries/data', [TenderInquiryController::class, 'getData'])->name('tender-inquiries.data');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('tender/data', [TenderController::class, 'getData'])->name('tender.data');
    Route::get('tender', [TenderController::class, 'index'])->name('tender.index');
    Route::get('tender/create', [TenderController::class, 'create'])->name('tender.create');
    Route::post('tender/store', [TenderController::class, 'store'])->name('tender.store');
    Route::get('tender/{id}/edit', [TenderController::class, 'edit'])->name('tender.edit');
    Route::post('tender/update/{id}', [TenderController::class, 'update'])->name('tender.update');
    Route::get('tender/delete/{id}', [TenderController::class, 'destroy'])->name('tender.delete');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('users/data', [UserController::class, 'getData'])->name('users.data');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
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


Route::get('run-command/{name}', function($name) {
    if ($name === 'storage:link' && !function_exists('symlink')) {
        return response()->json([
            'error' => 'symlink() is not supported on this server.'
        ], 500);
    }

    try {
        Artisan::call($name);
        return response()->json([
            'output' => Artisan::output()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => 'Command failed: ' . $e->getMessage()
        ], 500);
    }
});


Route::get('copy-storage-files', function () {
    $source = storage_path('app/public');
    $destination = public_path('storage');

    if (!file_exists($destination)) {
        mkdir($destination, 0755, true);
    }

    $files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($files as $file) {
        $destPath = $destination . DIRECTORY_SEPARATOR . $files->getSubPathName();
        if ($file->isDir()) {
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }
        } else {
            copy($file, $destPath);
        }
    }

    return 'Files have been copied to public/storage';
});


