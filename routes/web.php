<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\CkeditorController;

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\PlaceImageController;
use App\Http\Controllers\Admin\TourguideController;
use App\Http\Controllers\Admin\TourguideImageController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;

//---------- DalaHabo ----------//
Route::get('/', function () {
    return view('welcome');
});


//---------- DalaHabo Admin ----------//

#Đăng nhập
Route::get('admin/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/login/store', [LoginController::class, 'store']);

#Quên mật khẩu
Route::get('/admin/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.forgot');;
Route::post('/admin/forgot-password', [ForgotPasswordController::class, 'store']);

#Đặt lại mật khẩu
Route::get('/admin/reset-password', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('/admin/reset-password', [ResetPasswordController::class, 'store']);

//Require login
Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        #Dashboard
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('dashboard', [MainController::class, 'index']);

        #Thông tin tài khoản
        Route::prefix('user-profile')->group(function () {
            Route::get('/', [ProfileController::class, 'show_profile']);
            Route::post('/update', [ProfileController::class, 'updateInfo']);
            Route::post('/change-profile-picture', [ProfileController::class, 'updatePicture'])->name('admin.update.picture');
            Route::post('/change-password', [ProfileController::class, 'changePassword']);
        });
        
        #Đăng xuất
        Route::get('logout', [LoginController::class, 'logout']);

        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);
        Route::delete('destroy/services', [UploadController::class, 'destroy']);

        #Upload Gallery
        Route::post('upload-gallery/services', [GalleryController::class, 'store']);
        Route::post('ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');
        Route::get('ckeditor/file_browser', [CkeditorController::class, 'file_browser'])->name('file_browser');

        #Slider
        Route::prefix('sliders')->group(function () {
            Route::get('all', [SliderController::class, 'all']);
            Route::get('create', [SliderController::class, 'create']);
            Route::post('create', [SliderController::class, 'store']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::delete('destroy', [SliderController::class, 'destroy']);
            Route::delete('destroy-selected', [SliderController::class, 'destroySelected']);
        });

        #Danh mục
        Route::prefix('categories')->group(function () {
            Route::get('all', [CategoryController::class, 'all']);
            Route::get('create', [CategoryController::class, 'create']);
            Route::post('create', [CategoryController::class, 'store']);
            Route::get('edit/{category}', [CategoryController::class, 'show']);
            Route::post('edit/{category}', [CategoryController::class, 'update']);
            Route::delete('destroy', [CategoryController::class, 'destroy']);
            Route::delete('destroy-selected', [CategoryController::class, 'destroySelected']);
        });

        #Địa điểm
        Route::prefix('places')->group(function () {
            Route::get('all', [PlaceController::class, 'all']);
            Route::get('create', [PlaceController::class, 'create']);
            Route::post('create', [PlaceController::class, 'store']);
            Route::get('edit/{place}', [PlaceController::class, 'show']);
            Route::post('edit/{place}', [PlaceController::class, 'update']);
            Route::delete('destroy', [PlaceController::class, 'destroy']);
            Route::delete('destroy-selected', [PlaceController::class, 'destroySelected']);

            #Hình ảnh
            Route::get('galleries/{place}', [PlaceImageController::class, 'all']);
            Route::post('galleries/{place}', [PlaceImageController::class, 'store']);
            Route::delete('galleries/destroy', [PlaceImageController::class, 'destroy']);
            Route::delete('galleries/destroy-selected', [PlaceImageController::class, 'destroySelected']);
        });

        #Hướng dẫn viên
        Route::prefix('tourguides')->group(function () {
            Route::get('all', [TourguideController::class, 'all']);
            Route::get('create', [TourguideController::class, 'create']);
            Route::post('create', [TourguideController::class, 'store']);
            Route::get('edit/{tourguide}', [TourguideController::class, 'show']);
            Route::post('edit/{tourguide}', [TourguideController::class, 'update']);
            Route::delete('destroy', [TourguideController::class, 'destroy']);
            Route::delete('destroy-selected', [TourguideController::class, 'destroySelected']);


            #Hình ảnh
            Route::get('galleries/{tourguide}', [TourguideImageController::class, 'all']);
            Route::post('galleries/{tourguide}', [TourguideImageController::class, 'store']);
            Route::delete('galleries/destroy', [TourguideImageController::class, 'destroy']);
            Route::delete('galleries/destroy-selected', [TourguideImageController::class, 'destroySelected']);
        });

        #Yêu cầu thuê


        #Bài viết và bình luận
        Route::prefix('blogs')->group(function () {
            Route::get('all', [BlogController::class, 'all']);
            Route::get('create', [BlogController::class, 'create']);
            // Route::post('create', [TourguideController::class, 'store']);
            // Route::get('edit/{user}', [UserController::class, 'show']);
            // Route::post('edit/{tourguide}', [TourguideController::class, 'update']);
            // Route::delete('destroy', [TourguideController::class, 'destroy']);
        });

        #Tài khoản
        Route::middleware(['auth.isAdmin'])->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('all', [UserController::class, 'all']);
                Route::get('create', [UserController::class, 'create']);
                Route::post('create', [UserController::class, 'store']);
                Route::get('edit/{user}', [UserController::class, 'show']);
                Route::post('edit/{user}', [UserController::class, 'update']);
                Route::delete('destroy', [UserController::class, 'destroy']);
                Route::delete('destroy-selected', [UserController::class, 'destroySelected']);
            });
        });
    });
});
