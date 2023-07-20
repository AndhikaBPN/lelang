<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangC;
use App\Http\Controllers\userC;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registerAdmin', [UserC::class,'registerAdmin']);
Route::post('registerPengguna', [UserC::class,'registerPengguna']);
Route::post('/login', [UserC::class,'login']);

Route::group(['middleware'=>['admin',]], function(){
    Route::post('/registerPetugas', [UserC::class,'registerPetugas']);
});


Route::get('/getbarang', [BarangC::class, 'index']);
Route::get('/getdetailbarang/{id}', [BarangC::class, 'show']);
