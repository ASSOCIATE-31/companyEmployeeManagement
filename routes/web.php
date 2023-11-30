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
Route::get('/add/company', [CompanyController::class, 'create'])->name('add-company');
Route::post('/insert/company', [CompanyController::class, 'store'])->name('company.store');
Route::get('/list-company', [CompanyController::class, 'list'])->name('company.list');
