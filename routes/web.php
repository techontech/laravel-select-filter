<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::redirect('/', 'students');

Route::get('students', [StudentController::class, 'index'])->name('students');
Route::get('standards', [StudentController::class, 'getStandard'])->name('standards');
Route::get('results', [StudentController::class, 'getResult'])->name('results');
Route::get('students/records', [StudentController::class, 'records'])->name('students/records');
