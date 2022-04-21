<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AggregationController;
use App\Models\Aggregation;

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
        'aggregation' => Aggregation::all(),
        'aggregations_chron' => Aggregation::all()->sortByDesc('created_at')
    ]);
});

Route::resource('aggregations', AggregationController::class);

Route::post('/sets/{id}/upload-documents',
    [AggregationController::class, 'uploadDocuments'])->name('aggregations.uploadDocuments');
Route::get('/quick-reate',
    [AggregationController::class, 'quickCreate'])->name('aggregations.quickCreate');
Route::post('/quick-store',
    [AggregationController::class, 'quickStore'])->name('aggregations.quickStore');
