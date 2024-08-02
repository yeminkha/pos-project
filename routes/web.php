<?php

use App\Models\order;
use App\Models\product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\allbookController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserListController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReadinGuideController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\TempOrderListController;

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

Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('homePage', [AuthController::class, 'homePage'])->name('homePage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('registerPage');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    //user
    Route::middleware([UserAuthMiddleware::class])->group(function () {

        // Route::get('/bookPage/{id}',[ProductController::class,'bookPage'])->name('bookPage');
        Route::get('/bookPage/{id}', [ProductController::class, 'bookPage'])->name('bookPage');

        Route::post('/reaction', [ReactionController::class, 'reaction'])->name('reaction');

        Route::get('/getCart', [TempOrderListController::class, 'getCart'])->name('getCart');
        Route::get('deleteTempList', [TempOrderListController::class, 'deleteTempList']);
        Route::get('/tempOrderListPage', [TempOrderListController::class, 'tempOrderListPage'])->name('tempOrderListPage');
        Route::get('updateSessionData', [TempOrderListController::class, 'updateSessionData']);
        Route::get('/orderPage', [OrderController::class, 'orderPage'])->name('orderPage');
        Route::post('order/', [OrderController::class, 'order'])->name('order');

        Route::get('/servicePage', [ReadinGuideController::class, 'servicePage'])->name('servicePage');
        Route::get('/newBooks', [allBookController::class, 'newBooks'])->name('newBooks');
        Route::get('/mostSell', [allBookController::class, 'mostSell'])->name('mostSell');
        Route::get('/editorFav', [allBookController::class, 'editorFav'])->name('editorFav');
        Route::get('/suya', [allBookController::class, 'suya'])->name('suya');
        Route::get('/classic', [allBookController::class, 'classic'])->name('classic');
        Route::get('/dropSearchList/{key}', [allBookController::class, 'dropSearchList'])->name('dropSearchList');
        Route::get('/bookSearch/{key}', [allBookController::class, 'bookSearch'])->name('bookSearch');
        Route::get('/bookSearchMain/{key}', [allBookController::class, 'bookSearchMain'])->name('bookSearchMain');
        Route::get('/arthurSearch/{key}', [allBookController::class, 'arthurSearch'])->name('arthurSearch');
        Route::get('/arthurSearchInput', [allBookController::class, 'arthurSearchInput'])->name('arthurSearchInput');

        Route::get('/readingGuideSearch/{key}', [ReadinGuideController::class, 'readingGuideSearch'])->name('readingGuideSearch');
        Route::get('/readingGuide', [ReadinGuideController::class, 'readingGuide'])->name('readingGuide');
        Route::get('readingGuideBookPage/{key}', [ReadinGuideController::class, 'readingGuideBookPage'])->name('readingGuideBookPage');
        Route::post('/book', [allbookController::class, 'book'])->name('book');
        Route::get('orderDetail/{key}', [OrderController::class, 'orderDetail'])->name('orderDetail');

        Route::get('/accMain', [AccController::class, 'mainPage'])->name('accMain');
        Route::get('/accInfo', [AccController::class, 'accInfo'])->name('accInfo');
    });

    //admin
    Route::middleware([AdminAuthMiddleware::class])->group(function () {

        //main category
        Route::post('mainCategory/create', [MainCategoryController::class, 'mainCategoryCreate'])->name('mainCategoryCreate');
        Route::get('mainCategory/edit/{key}', [MainCategoryController::class, 'mainCategoryEditPage'])->name('mainCategoryEditPage');
        Route::post('mainCategory/update', [MainCategoryController::class, 'mainCategoryUpdate'])->name('mainCategoryUpdate');
        Route::get('/mainCategory/delete', [mainCategoryController::class, 'mainCategoryDelete']);

        //category
        Route::get('category/create/page', [MainCategoryController::class, 'categoryCreatePage'])->name('categoryCreatePage');
        Route::post('category/create', [CategoryController::class, 'categoryCreate'])->name('categoryCreate');
        Route::get('category/list/page', [CategoryController::class, 'categoryListPage'])->name('categoryListPage');
        Route::get('category/edit/{key}', [CategoryController::class, 'categoryEditPage'])->name('categoryEditPage');
        Route::post('category/update', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
        Route::get('/category/delete', [CategoryController::class, 'categoryDelete']);

        //product
        Route::get('product/create/page', [ProductController::class, 'productCreatePage'])->name('productCreatePage');
        Route::post('product/create', [ProductController::class, 'productCreate'])->name('productCreate');
        Route::get('product/list/page', [ProductController::class, 'productListPage'])->name('productListPage');
        Route::get('product/edit/page/{key}', [ProductController::class, 'productEditPage'])->name('productEditPage');
        Route::post('product/update', [ProductController::class, 'productUpdate'])->name('productUpdate');
        Route::get('/product/delete', [ProductController::class, 'productDelete']);

        //order
        Route::get('order/list/page', [OrderController::class, 'orderListPage'])->name('orderListPage');
        Route::get('seeOrderPage/{key}', [OrderController::class, 'seeOrderPage'])->name('seeOrderPage');
        Route::get('/order/status/update', [OrderController::class, 'orderStatusChange']);
        Route::get('orderedBookPage', [OrderController::class, 'orderedBookPage']);

        // admin list
        Route::get('user/list/page/{role}', [UserListController::class, 'userListPage'])->name('userListPage');
        Route::get('/user/delete', [UserListController::class, 'userDelete']);
        Route::get('/user/role', [UserListController::class, 'userRole']);
        Route::get('/user/detail/{id}', [UserListController::class, 'userDetail'])->name('userDetail');
    });

    //acc
    Route::get('/acc/edit', [AccController::class, 'accEdit'])->name('accEdit');
    Route::post('/acc/update', [AccController::class, 'accUpdate'])->name('accUpdate');

    //password
    Route::get('admin/pass/edit', [AccController::class, 'passEdit'])->name('passEdit');
    Route::post('admin/pass/update', [AccController::class, 'passUpdate'])->name('passUpdate');
});
