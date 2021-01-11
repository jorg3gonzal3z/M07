<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvaController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;

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

Route::get('/prova', [ProvaController::class, 'prova'])->middleware(['auth']);

Route::get('/nou_usuari', [UserController::class, 'nou'])->middleware(['auth']);
Route::post('/nou_usuari/nou', [UserController::class, 'store'])->middleware(['auth']);

Route::get('/nou_usuari/info/{id}', [UserController::class, 'show'])->middleware(['auth']);

Route::get('/send/email', [MailController::class, 'mail'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


