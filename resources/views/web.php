<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['middleware'=>'PreventBack'])->group(function(){
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'isAdmin', 'PreventBack']], function(){
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('update-profile-info', [AdminController::class, 'updateInfo'])->name('adminUpdateInfo');
    Route::post('change-profile-picture', [AdminController::class, 'updatePicture'])->name('adminPictureUpdate');
    Route::post('change-password', [AdminController::class, 'changePassword'])->name('adminChangePassword');

    Route::resource('students', StudentController::class);
});


Route::group(['prefix'=>'user', 'middleware'=>['auth', 'isUser', 'PreventBack']], function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('settings', [UserController::class, 'settings'])->name('user.settings');
    Route::post('update-profile-info', [UserController::class, 'updateInfo'])->name('userUpdateInfo');
    Route::post('studentupdate-profile-info', [UserController::class, 'studentupdateInfo'])->name('studentUpdateInfo');
    Route::post('change-profile-picture', [UserController::class, 'updatePicture'])->name('userPictureUpdate');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('userChangePassword');
});


