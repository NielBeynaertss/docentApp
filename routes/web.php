<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\MainController;
use App\Models\Teacher;
use App\Http\Controllers\PageController;

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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::controller(RegistrationController::class)->group(function() {
    Route::get('/register', 'index')->name('register');
    Route::post('/store', 'store')->name('store');
});

Route::get('/main', [MainController::class, 'index']);

Route::get('/search/teachers', [MainController::class, 'search'])->name('search.teachers');
Route::get('/pages/{name}', [PageController::class, 'show'])->name('page.show');

Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::get('/teachers/filter', [MainController::class, 'filterTeachers'])->name('teachers.filter');

