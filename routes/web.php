<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\SupperAdmin\CenterController;
use App\Http\Controllers\SupperAdmin\StaffController;
use App\Http\Controllers\WareHouse\HistoryAddNumberProductController;
use App\Http\Controllers\WareHouse\ProductController;
use App\Http\Controllers\WareHouse\RequestController;
use App\Http\Middleware\CheckHaveLogin;
use App\Models\HistoryAddNumberProduct;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class,'login'])->name('login');
Route::post('/', [AuthController::class,'processLogin'])->name('process_login');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => CheckHaveLogin::class
], function (){
   Route::group([
       'prefix' => 'web',
       'as' => 'web.',
   ],function (){
       Route::group([
           'prefix' => 'staff',
           'as' => 'staff.',
       ],function (){
           Route::get('/',[StaffController::class,'index'])->name('index');
           Route::get('/{id}',[StaffController::class,'get'])->name('get');
           Route::post('/store',[StaffController::class,'store'])->name('store');
           Route::post('/update',[StaffController::class,'update'])->name('update');
           Route::post('/delete',[StaffController::class,'delete'])->name('delete');
       });

       Route::group([
           'prefix' => 'center',
           'as' => 'center.',
       ],function (){
           Route::get('/',[CenterController::class,'index'])->name('index');
           Route::get('/{id}',[CenterController::class,'get'])->name('get');
           Route::post('/store',[CenterController::class,'store'])->name('store');
           Route::post('/update',[CenterController::class,'update'])->name('update');
           Route::post('/delete',[CenterController::class,'delete'])->name('delete');
       });

       Route::group([
           'prefix' => 'product',
           'as' => 'product.',
       ],function (){
           Route::get('/',[ProductController::class,'index'])->name('index');
           Route::get('/{id}',[ProductController::class,'get'])->name('get');
           Route::post('/store',[ProductController::class,'store'])->name('store');
           Route::post('/update',[ProductController::class,'update'])->name('update');
           Route::post('/delete',[ProductController::class,'delete'])->name('delete');
           Route::get('/history/add',[HistoryAddNumberProductController::class,'index'])->name('history');
           Route::post('/history/add',[HistoryAddNumberProductController::class,'addNumberProduct'])->name('addNumberProduct');

       });

       Route::group([
           'prefix' => 'request',
           'as' => 'request.',
       ],function (){
           Route::get('/',[RequestController::class,'index'])->name('index');
           Route::get('/{id}',[RequestController::class,'get'])->name('get');
           Route::post('/changeStatus',[RequestController::class,'changeStatus'])->name('changeStatus');
           Route::get('/exportRequestPdf/{id}',[RequestController::class,'exportPdf'])->name('exportRequestPdf');
       });
   });
});

Route::group([
    "prefix" => 'home',
    'middleware' => CheckHaveLogin::class
], function (){
   Route::get("/",[HomeController::class,'index'])->name('home');
   Route::get("/getInfoCheckOut/{id}",[HomeController::class,'getInfoCheckOut'])->name('getInfoCheckout');
   Route::post("/changeCart",[HomeController::class,'changeCart'])->name('changeCart');
   Route::post("/enterNumberProduct",[HomeController::class,'enterNumberProduct'])->name('enterNumberProduct');
   Route::post("/checkout",[HomeController::class,'checkout'])->name('checkout');
});

Route::get('/error',function (){
    return "Error";
})->name('error');
