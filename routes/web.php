<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SetController;
use App\Http\Controllers\CollectionController;
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
    return view('welcome', ['sets' => Set::all()]);
});

Route::resource('sets', SetController::class);
Route::resource('collections', CollectionController::class);

Route::post('/collections/{id}/upload-image',
    [CollectionController::class, 'uploadImage'])->name('collections.uploadImage');
Route::post('/collections/{id}/upload-documents',
    [CollectionController::class, 'uploadDocuments'])->name('collections.uploadDocuments');