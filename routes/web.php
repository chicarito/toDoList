<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailQuesController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\TaskerController;
use App\Http\Controllers\WorkerController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;



Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('/postlogin', 'postlogin');
    Route::get('/logout', 'logout');
});

Route::controller(AdminController::class)->middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    route::get('/admin', 'index');
    route::post('/store-user', 'store');
    route::get('/edit-user/{id}', 'edit');
    route::post('/update-user/{id}', 'update');
    route::get('/delete-user/{id}', 'delete');
});

Route::middleware(['auth', RoleMiddleware::class . ':tasker'])->group(function () {
    Route::controller(TaskerController::class)->group(function () {
        Route::get('/tasker', 'index');
        Route::post('/add-quest', 'store');
        Route::get('/edit-quest/{id}', 'edit');
        Route::post('/update-quest/{id}', 'update');
        Route::get('/delete-quest/{id}', 'delete');
        Route::get('/all-quest', 'all_quest');
    });
    Route::controller(DetailQuesController::class)->group(function () {
        Route::get('/add-detail-quest/{id}', 'add_detail_task');
        Route::post('/add-quest-detail', 'store_detail_task');
        Route::get('/edit-quest-detail/{id}', 'edit_detail_task');
        Route::post('/update-quest-detail/{id}', 'update_detail_task');
        Route::get('/delete-quest-detail/{id}', 'delete_detail_task');
        Route::get('/show-quest-detail/{id}', 'show_detail_quest');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':worker'])->group(function () {
    Route::controller(WorkerController::class)->group(function () {
        Route::get('/worker', 'index');
        Route::post('/add-task', 'store');
        Route::get('/edit-task/{id}', 'edit');
        Route::post('/update-task/{id}', 'update');
        Route::get('/delete-task/{id}', 'delete');
        Route::get('/add-task-detail/{id}', 'add_detail_task');
        Route::post('/store-task-detail', 'store_detail_task');
        Route::get('/edit-task-detail/{id}', 'edit_detail_task');
        Route::post('/update-task-detail/{id}', 'update_detail_task');
        Route::get('/all-task', 'all_task');
    });
    Route::controller(QuestController::class)->group(function () {
        Route::get('/quest', 'all_quest');
        Route::get('/quest/detail-quest/{id}', 'detail_quest');
        Route::get('/quest/update-quest/{id}', 'edit_quest');
        Route::post('/quest/post-update/{id}', 'update_quest');
        
    });
});















// menampilkan quest kepada worker yang dituju
// menampilkan notifikasi quest kepada worker
