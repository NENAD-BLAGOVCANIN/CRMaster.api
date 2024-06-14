<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\SubmodulesController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
});


Route::group(['middleware' => 'auth:api'], function () {

    Route::get('users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);
    Route::get('/user/info', [UserController::class, 'info']);


    Route::get('/businesses', [BusinessController::class, 'index']);
    Route::get('/my-businesses', [BusinessController::class, 'myBusinesses']);
    Route::get('/business-info', [BusinessController::class, 'businessInfo']);
    Route::post('/businesses', [BusinessController::class, 'store']);
    Route::post('/switch-business', [BusinessController::class, 'switchBusiness']);
    Route::get('/businesses/{id}', [BusinessController::class, 'show']);
    Route::put('/business', [BusinessController::class, 'update']);
    Route::delete('/businesses/{id}', [BusinessController::class, 'destroy']);
    Route::get('/business/members', [BusinessController::class, 'businessMembers']);
    Route::post('/business/members', [BusinessController::class, 'addBusinessMember']);
    Route::delete('/business/members', [BusinessController::class, 'removeBusinessMember']);

    Route::get('/modules', [ModulesController::class, 'index']);
    Route::post('/modules', [ModulesController::class, 'store']);
    Route::get('/module/{module_id}', [ModulesController::class, 'show']);
    Route::get('/module/{module_id}/submodules', [SubmodulesController::class, 'index']);
    Route::post('/module/{module_id}/submodules', [SubmodulesController::class, 'store']);
    Route::get('/submodule/{submodule_id}', [SubmodulesController::class, 'show']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);


    Route::get('/my-tasks', [TasksController::class, 'index']);
    Route::get('/tasks/submodule/{submodule_id}', [TasksController::class, 'getSubmoduleTasks']);
    Route::post('/tasks', [TasksController::class, 'store']);
    Route::post('/tasks/toggle-assignee', [TasksController::class, 'toggleAssignee']);
    Route::get('/tasks/{id}', [TasksController::class, 'show']);
    Route::put('/tasks/{id}', [TasksController::class, 'update']);
    Route::delete('/tasks/{id}', [TasksController::class, 'destroy']);

    Route::group(['prefix' => '/people'], function () {
        Route::get('/', [PeopleController::class, 'index']);
        Route::get('/{id}', [PeopleController::class, 'show']);
        Route::post('/', [PeopleController::class, 'store']);
        Route::put('/{id}', [PeopleController::class, 'update']);
        Route::delete('/{id}', [PeopleController::class, 'destroy']);
    });

    Route::group(['prefix' => '/items'], function () {
        Route::get('/', [ItemsController::class, 'index']);
        Route::get('/{id}', [ItemsController::class, 'show']);
        Route::post('/', [ItemsController::class, 'store']);
        Route::put('/{id}', [ItemsController::class, 'update']);
        Route::delete('/{id}', [ItemsController::class, 'destroy']);
    });

    Route::get('/dashboard/stats', [DashboardController::class, 'getStats']);

});