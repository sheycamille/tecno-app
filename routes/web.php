<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ThesisController;

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
})->name('login');

Route::post('/auth/login', [UserController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::resource('roles', RoleController::class)->names([
        'update' => 'update.role'
    ]);;

    Route::get('/theses', [ThesisController::class, 'index'])->name('theses.index');
    Route::post('/theses', [ThesisController::class, 'store'])->name('theses.store');
    Route::post('/update-thesis{id}', [ThesisController::class, 'update'])->name('theses.update');
    Route::post('/delete-thesis', [ThesisController::class, 'destroy'])->name('theses.destroy');

    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('/add-user', [UserController::class, 'addUser'])->name('user.add');
    Route::post('/update-user{id}', [UserController::class, 'updateUser'])->name('user.update');
    Route::post('/delete-user{id}', [UserController::class, 'deleteUser'])->name('user.delete');
});