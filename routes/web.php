<?php

use App\Http\Controllers\firebase\EmployeeController;
use Illuminate\Support\Facades\Route;

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

Route::get('employees',[EmployeeController::class,'index']);

Route::get('add-employees',[EmployeeController::class,'create']);

Route::post('add-employees',[EmployeeController::class,'store']);

// Route::post('add-employees',[ImageController::class,'store']);  //Add image

Route::get('edit-employee/{id}',[EmployeeController::class,'edit']);

Route::put('update-employee/{id}', [EmployeeController::class,'update']);

Route::get('delete-employee/{id}', [EmployeeController::class,'destroy']);



Route::get('/', function () {
    return view('welcome');
});
