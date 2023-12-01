<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Company\CompanyController;
use App\Http\Controllers\Admin\Employee\EmployeeController;

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
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*
|--------------------------------------------------------------------------
| Web Routes For Companies
|--------------------------------------------------------------------------
|  
*/
Route::get('/add/company', [CompanyController::class, 'create'])->name('add-company');
Route::post('/insert/company', [CompanyController::class, 'store'])->name('company.store');
Route::get('/list-company', [CompanyController::class, 'list'])->name('company.list'); 
Route::get('/update-company/{slug}', [CompanyController::class, 'update'])->name('company.update');  
Route::post('/update-company', [CompanyController::class, 'edit'])->name('company.edit');  
Route::get('/destroy-company/{slug}', [CompanyController::class, 'destroy'])->name('company.destroy');  
/*
|--------------------------------------------------------------------------
| Web Routes For Employees
|--------------------------------------------------------------------------
|  
*/
Route::get('/add/employee', [EmployeeController::class, 'create'])->name('add-employee');
Route::post('/store/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/list-employee', [EmployeeController::class, 'list'])->name('employee.list');
Route::get('/update-employee/{slug}', [EmployeeController::class, 'update'])->name('employee.update');  
Route::post('/update-employee', [EmployeeController::class, 'edit'])->name('employee.edit');  
Route::get('/destroy-employee/{slug}', [EmployeeController::class, 'destroy'])->name('employee.destroy');  