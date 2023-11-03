<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StreamMessageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/welcome', function () {
//     return view('welcome');
// });
// Route::get('/alo', [UserController::class, 'getLogin'])->name('getLogin');
// Route::post('/alo', [UserController::class, 'postLogin'])->name('postLogin');

// Route::get('/home', [UserController::class, 'getHome'])->name('getHome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [UserController::class, 'getHome'])->name('getHome');

    Route::get('/posts', [PostController::class, 'getPosts'])->name('getPosts');
    Route::get('/addpost', [PostController::class, 'getAddPost'])->name('getAddPost');
    Route::get('/updatepost/{id}', [PostController::class, 'getUpdatePost'])->name('getUpdatePost');
    Route::post('/addpost', [PostController::class, 'postAddPost'])->name('postAddPost');
    Route::post('/updatepost/{id}', [PostController::class, 'postUpdatePost'])->name('postUpdatePost');
    Route::delete('/deletepost/{id}', [PostController::class, 'deletePost'])->name('deletePost');

    Route::get('/users', [UserController::class, 'getAllUser'])->name('getAllUser');
    Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/updateuser/{id}', [UserController::class, 'updateUser'])->name('updateUser');
    Route::post('/requestauthorization/{id}', [UserController::class, 'postRequestAuthorization'])->name('postRequestAuthorization');


    Route::get('/adduser', [UserController::class, 'getAddUser'])->name('getAddUser');
    Route::post('/adduser', [UserController::class, 'postAddUser'])->name('postAddUser');
    Route::delete('/adduser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');

    Route::get('/updateuser/{id}', [UserController::class, 'getUpdateUser'])->name('getUpdateUser');
    Route::post('/updateinfouser/{id}', [UserController::class, 'postUpdateUser'])->name('postUpdateUser');
    Route::post('/updatepassworduser/{id}', [UserController::class, 'postUpdatePasswordUser'])->name('postUpdatePasswordUser');

    Route::post('/acceptauthorization', [StreamMessageController::class, 'postAcceptAuthorization'])->name('postAcceptAuthorization');
    Route::post('/refuseauthorization', [StreamMessageController::class, 'postRefuseAuthorization'])->name('postRefuseAuthorization');


    Route::get('/products', [ProductController::class, 'getProducts'])->name('getProducts');
    Route::get('/addproduct', [ProductController::class, 'getAddProduct'])->name('getAddProduct');
    Route::post('/addproduct', [ProductController::class, 'postAddProduct'])->name('postAddProduct');
    Route::get('/updateproduct/{id}', [ProductController::class, 'getUpdateProduct'])->name('getUpdateProduct');
    Route::post('/updateproduct/{id}', [ProductController::class, 'postUpdateProduct'])->name('postUpdateProduct');
    Route::delete('/deleteproduct/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');

    Route::get('/manageproducts', [ProductController::class, 'getManageProducts'])->name('getManageProducts');

    Route::post('/addcategory', [CategoryController::class, 'postAddCategory'])->name('postAddCategory');

    Route::post('/addsubgroupspecification', [SpecificationController::class, 'postAddSubGroupSpecification'])->name('postAddSubGroupSpecification');

    Route::get('/customers', [CustomerController::class, 'getCustomers'])->name('getCustomers');
    Route::get('/customerdetail', [CustomerController::class, 'getCustomerDetail'])->name('getCustomerDetail');
});
Route::post('/updatemessage/{id}', [StreamMessageController::class, 'postUpdateMessage'])->name('postUpdateMessage');
Route::post('/updatesupplier', [SupplierController::class, 'postUpdateSupplier'])->name('postUpdateSupplier');
Route::post('/updatespecification', [SpecificationController::class, 'postUpdateSpecification'])->name('postUpdateSpecification');


require __DIR__.'/auth.php';
