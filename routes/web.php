<?php

use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/employees', [EmployeeController::class, 'index']);

Route::get('/getEmployees', [EmployeeController::class, 'getEmployees']);

Route::post('/insertEmployee', [EmployeeController::class, 'insertEmployee']);

Route::post('/deleteEmployee', [EmployeeController::class, 'deleteEmployee']);

Route::post('/updateEmployee', [EmployeeController::class, 'updateEmployee']);

Route::get('/getEmployee', [EmployeeController::class, 'getEmployee']);


