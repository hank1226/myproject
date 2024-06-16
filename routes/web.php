<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\DHTsController;
use App\Http\Controllers\PZEMsController;
use App\Http\Controllers\MonitoringsController;
use Spatie\Html\Facades\Html;
use storage\public;




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


/*
Route::get('/hello', function () {
    return '<h1>hello world</h1>';
});

Route::get('/users/{id}/{name}', function($id,$name){
    return 'This user is '.$name. 'with the id of ' .$id;
});
*/



Route::get('/', [PagesController::class, 'index']);
Route::get('/{id}/dhtrecords', [MonitoringsController::class, 'dhtrecords']);
Route::get('/{id}/pzemrecords', [MonitoringsController::class, 'pzemrecords']);
Route::post('/getdhtrecords', [MonitoringsController::class, 'getdhtrecords']);
Route::post('/getpzemrecords', [MonitoringsController::class, 'getpzemrecords']);
Route::get('/sensors', [MonitoringsController::class, 'sensors']);

// Route::resource('posts', PostsController::class);
Route::resource('devices', DevicesController::class);
Route::resource('dhts', DHTsController::class);
Route::resource('pzems', PZEMsController::class);

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index']);

