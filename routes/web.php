<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SetController;
use App\Models\Set;

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
    return view('welcome', [
        'sets' => Set::all(),
        'sets_chron' => Set::all()->sortByDesc('created_at')
    ]);
});

Route::resource('sets', SetController::class);

Route::post('/sets/{id}/upload-documents',
    [SetController::class, 'uploadDocuments'])->name('sets.uploadDocuments');
Route::get('/quick-reate',
    [SetController::class, 'quickCreate'])->name('sets.quickCreate');
Route::post('/quick-store',
    [SetController::class, 'quickStore'])->name('sets.quickStore');