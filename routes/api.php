<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;



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
Route::prefix('admin')->controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:admin_api')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'me');
        Route::get('/detailmeja/{id}',[MejaController::class,'getdetailmeja']);

    });
Route::group([ 'middleware'  => ['jwt.verify']], function () {

    Route::group(['middleware' => ['api.superadmin']], function ()
    {

    });
    Route::group(['middleware' => ['api.admin']], function ()
    {

    });

    Route::get('/gagal_akses',function(){
        return Response()->json(['status'=>'gagal']);
    })->name('login');
});
});
// Route::middleware('auth:admin_api')->group(function () {
//meja
Route::get('/getmeja',[MejaController::class,'getMeja']);
Route::post('/createMeja',[MejaController::class,'createMeja']);
Route::put('/update_meja/{id}',[MejaController::class,'update_meja']);
Route::delete('/delete_meja/{id}',[MejaController::class,'destroymeja']);
// Route::get('/detailmeja/{id}',[MejaController::class,'getdetailmeja']);
//menu
Route::get('/getmenu',[MenuController::class,'getMenu']);
Route::post('/createMenu',[MenuController::class,'createMenu']);
Route::put('/update_menu/{id}',[MenuController::class,'update_menu']);
Route::delete('/delete_menu/{id}',[MenuController::class,'destroymenu']);


Route::get('/detailmenu/{id}',[MenuController::class,'getdetailmenu']);
//transaksi
Route::get('/get_transaksi',[TransaksiController::class, 'getTransaksi']);
Route::post('/create_transaksi',[TransaksiController::class, 'createTranksasi']);
Route::put('/update_transaksi/{id}',[TransaksiController::class, 'update_transaksi']);
Route::get('/get_detail_transaksi/{id}',[TransaksiController::class, 'getdetailtransaksi']);
Route::delete('/delete_transaksi/{id}',[TransaksiController::class, 'destroytransaksi']);
//user
Route::get('/getuser', [UserController::class, 'getUser']);
// });