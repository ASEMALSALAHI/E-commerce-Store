<?php

//use App\Http\Controllers\Admin\ProductListController;

use App\Http\Controllers\User\user_ProductDetailsController;
use App\Http\Controllers\User\user_ProductListController;
use App\Http\Controllers\User\user_SliderController;
use App\Http\Controllers\user_CategoryController;
use App\Http\Controllers\User\user_CartOrderController;
use App\Http\Controllers\User\user_ContactController;
use App\Http\Controllers\User\user_ReviewController;
use App\Http\Controllers\User\user_SiteInfoController;
use App\Http\Resources\CategoryCollection;
use App\Http\Controllers\Admin\CartController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Categories and Products  routes
Route::get('/products', [user_ProductListController::class, 'AllProductList']);
Route::get('/categories', [user_CategoryController::class,'AllCategory'])->name('all.categories');
Route::get('/categories/{id}', [user_CategoryController::class, 'CategoryById'])->name('category.byId');
Route::get('/subCategory/{id}', [user_CategoryController::class, 'subCategoryById'])->name('subCategory.byId');
Route::get('/products/{id}', [user_CategoryController::class, 'productbysubcategore'])->name('product.byId');
Route::get('/product/{id}', [user_ProductListController::class, 'getproduct'])->name('product.byID');
Route::get('/productdetails/{id}', [user_ProductDetailsController::class, 'productdetails'])->name('productdetails.byID');
Route::get('/productdetails', [user_ProductDetailsController::class, 'AllProductdetails'])->name('AllProductdetails');
Route::get('/getfulldetails', [user_ProductDetailsController::class, 'getfulldetails'])->name('getfulldetails');

//Cart routes
Route::post('/add_to_cart', [CartController::class, 'addtocart'])->name('addtocart');
Route::get('/cart/{id}', [CartController::class, 'viewcart'])->name('cart');
Route::get('/remove_cart/{id}', [CartController::class, 'removeFromCart'])->name('removefromcart');
Route::put('/cart-updatequantity/{cart_id}/{scope}', [CartController::class, 'updatequantity']);

//View sliders routes
Route::get('/sliders', [user_SliderController::class,'AllHomeSlider'])->name('all.homeslider');
//Oreders routes
Route::post('/add_order', [user_CartOrderController::class, 'addOrder'])->name('addorder');
Route::get('/order/{id}', [user_CartOrderController::class, 'viewOrder'])->name('viewOrder');
//Contacts routes
Route::post('/addmessage', [user_ContactController::class, 'addmessage'])->name('addmessage');
//Reviews routes
Route::post('/addreview', [user_ReviewController::class, 'addreview'])->name('addreview');
//SiteInfo routes
Route::get('/siteinfo', [user_SiteInfoController::class,'AllInformation'])->name('AllInformation');


Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/rregister', [App\Http\Controllers\Api\AuthController::class, 'register']);


//here with auth:api middleware
Route::group(['middleware' => 'CustomerAuth'], function () {
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/user', [App\Http\Controllers\Api\AuthController::class, 'user']);
});



