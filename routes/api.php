<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\OrderController;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/{type}',[ProductController::class, 'getAllTypeProduct'])->name('getAllTypeProduct');
Route::get('/productofcategory/{type}',[ProductController::class, 'getProductOfCategory'])->name('getProductOfCategory');
Route::get('subcategory/{type}',[ProductController::class, 'getCategoryProduct'])->name('getCategoryProduct');
Route::get('/product/{id}',[ProductController::class, 'getProduct'])->name('getProduct');
Route::get('/productsimilar/{id}',[ProductController::class, 'getProductSimilar'])->name('getProductSimilar');
Route::get('/imageofproduct/{id}',[ImageController::class, 'getImageOfProduct'])->name('getImageOfProduct');
Route::get('/specification/{id}',[ProductController::class, 'getSpecification'])->name('getSpecification');
Route::get('/productofcart/products',[ProductController::class, 'getProductOfCart'])->name('getProductOfCart');

Route::get('/posts/allpost',[PostController::class, 'getAllPost'])->name('getAllPost');
Route::get('/posts/3post',[PostController::class, 'get3Post'])->name('get3Post');
Route::get('/posts/categoriespost',[PostController::class, 'getCategoryPost'])->name('getCategoryPost');
Route::get('/posts/{url}',[PostController::class, 'getSubCategoryPost'])->name('getSubCategoryPost');

Route::post('/order/orderproduct',[OrderController::class, 'orderProduct'])->name('orderProduct');
Route::post('/order/sendmail',[OrderController::class, 'sendMail'])->name('sendMail');
Route::get('/order/getprovince',[OrderController::class, 'getProvince'])->name('getProvince');
Route::get('/order/getdistrict/{id}',[OrderController::class, 'getDistrict'])->name('getDistrict');
Route::get('/order/getward/{id}',[OrderController::class, 'getWard'])->name('getWard');


// Route::get('/testmail/testroute', function() {
//     Mail::to('lmd16032002@gmail.com')->send(new MyTestEmail($name));
// });
