<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DataTablesController;
use App\Http\Controllers\DtController;
use App\Http\Controllers\sharkController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DepositController;
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

//student all route
Route::get('/student/view',[StudentController::class,'studentView']);
Route::post('/student/store',[StudentController::class,'studentAdd'])->name('student.add');
Route::get('/student/{id}',[StudentController::class,'getStudentById']);
Route::post('/student/update',[StudentController::class,'studentUpdate'])->name('student.update');


//employee all route
Route::get('/employees',[EmployeeController::class,'index']);
Route::post('/addemployee',[EmployeeController::class,'store']); 
Route::get('/get-employees',[EmployeeController::class,'getEmployee']);
Route::get('/edit-employee/{id}', [EmployeeController::class, 'editEmployee']);
Route::put('/update-employee/{id}', [EmployeeController::class, 'updateEmployee']);
Route::delete('/delete/employee/{id}', [EmployeeController::class, 'deleteEmployee']);

//datatable all route
Route::get('/ajax-datatable-crud', [DataTablesController::class, 'index']);
Route::post('add-update-book', [DataTablesController::class, 'store']);
Route::post('edit-book', [DataTablesController::class, 'edit']);
Route::post('delete-book', [DataTablesController::class, 'destroy']);

//department datatable all routes




Route::get('/dt', [DtController::class, 'index']);
Route::get('/dt/getdata', [DtController::class, 'getData']);
Route::post('dt/postData',[DtController::class, 'postData']);
Route::get('dt/editData/{id}', [DtController::class, 'editData']);
Route::post('dt/updateData/{id}',[DtController::class, 'updateData']);
Route::get('dt/deleteData/{id}', [DtController::class, 'deleteData']);


//shark route 
Route::resource('sharks', sharkController::class);

//post resource controller
Route::resource('posts', PostController::class);

//deposit route
Route::get('/deposit',[DepositController::class,'index'])->name('deposit.index');
Route::post('/deposit/store',[DepositController::class,'store'])->name('deposit.store');
Route::post('/deposit/update/{id}',[DepositController::class,'update'])->name('deposit.update');
Route::get('/deposit/delete/{id}',[DepositController::class,'delete'])->name('deposit.delete');


