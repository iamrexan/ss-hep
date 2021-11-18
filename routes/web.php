<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;

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

Route::middleware(['auth'])->prefix('dashboard')->group(function() {
  Route::get('/', function () {
      return view('dashboard');
  })->name('dashboard');

  Route::get('employee/all', '\App\Http\Controllers\Admin\EmployeeController@getAllEmployeeSalaryList')->name('employee.all.data');
  Route::get('employee/summary', '\App\Http\Controllers\Admin\EmployeeController@getEmployeeSummaryData')->name('employee.summary.data');
  Route::get('employee/month-wise/list', '\App\Http\Controllers\Admin\EmployeeController@index')->name('employee.month.view');
  Route::get('employee/month-wise', '\App\Http\Controllers\Admin\EmployeeController@getEmployeesEachMonthSalaryData')->name('employee.month.data');
});

require __DIR__.'/auth.php';
