<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::group(['middleware' => '','namespace'=>'api'],function(){

    Route::post('/ById',[CategoryController::class,'ById']);
    Route::post('/checkStatus',[CategoryController::class,'checkStatus']);
    //Route::post('admin/login', [CategoryController::class, 'login']);
    //Route::get('login', [ProductController::class, 'login']);
    //Route::post('index', [ProductController::class,'index']);


Route::post('login', [ProductController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:sanctum')->group(function () {
    Route::post('index/{id}', [ProductController::class, 'index']);
 //});

//Route::group(['prefix' => 'admin','namespace'=>'Admin'],function () {
//    Route::post('login', 'AuthController@login');




/*Route::group(['middleware' => '','namespace'=>'api'],function() {

    //Route::put('update', [ProductController::class,'update']);
    Route::put('view', [ProductController::class, 'view']);
});*/

Route::post('create', [CategoryController::class,'create']);
Route::post('show/{id}', [CategoryController::class,'show']);
Route::post('delete/{id}', [CategoryController::class,'delete']);
Route::put('update/{id}', [CategoryController::class,'update']);
Route::post('list', [CategoryController::class,'list']);



Route::apiResource('todo-list',TodoListController::class);


Route::apiResource('todo-list.task',TaskController::class)
    ->except('show')
    ->shallow();

Route::post('/register',RegisterController::class)
    ->name('user.register');

Route::post('/login',LoginController::class)
    ->name('user.login');
