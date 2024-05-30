<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     echo "Cat";
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/users', [HomeController::class, 'users'])->name('users');
Route::get('/create', [HomeController::class, 'userCreate'])->name('user.create');
Route::post('/store', [HomeController::class, 'userStore'])->name('user.store');
Route::get('/edit/{id}', [HomeController::class, 'userEdit'])->name('user.edit');
Route::put('/update/{id}', [HomeController::class, 'userUpdate'])->name('user.update');
Route::delete('/delete/{id}', [HomeController::class, 'userDelete'])->name('user.delete');

Route::get('/login', [LoginController::class, 'userLogin'])->name('user.login');
Route::post('/login/process', [LoginController::class, 'userLoginProcess'])->name('user.login.process');
// Route::get('/login', [LoginController::class, 'userLogout'])->name('user.login.logout');
// https://www.youtube.com/playlist?list=PLRx0OlyTshRaeJxdgrbHDxQOe8z_Sixhd
// https://shouts.dev/articles/laravel-10-how-to-implement-sweet-alert
// https://shouts.dev/articles/laravel-create-dummy-data-using-factory-tinker