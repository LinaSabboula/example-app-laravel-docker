<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Area;
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

Route::get('/city', function (){
    return DB::table('cities')->get();
});

Route::get('/gov', function (){
    return DB::table('governments')->get();
});

Route::get('/area', function (){
    return DB::table('areas')->get();
});

Route::get('/search/{search}', function ($search) {
    return $search;
})->where('search', '.*');


