<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FormulariController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*email*/
Route::get('/send/email', [MailController::class, 'mail'])->middleware(['auth']);

/*formulari*/
Route::get('/formulari', [FormulariController::class, 'formulari'])->middleware(['auth'])->name('formulari');
Route::post('/formulari/dades', [FormulariController::class, 'dades'])->middleware(['auth'])->name('formulari.dades');

require __DIR__.'/auth.php';
