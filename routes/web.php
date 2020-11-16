<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SectionController;
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
Route::get('/', function(){
    return "এইডা হইলো ইউজার ফ্রন্ট পেইজ। অইডাতে পরবর্তীতে কাজ করা হবে। আপাতত ব্যাক-এন্ড নিয়া  আছি।";
});


Route::prefix('admin')->namespace('Admin')->group(function () {

    // All the admin routes will be defined here:-
    Route::match(['get', 'post'],'/', [AdminController::class, 'login']);
    Route::group(['middleware'=>['admin']], function(){
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::get('settings', [AdminController::class, 'settings']);
        // Admin Details route
        Route::match(['get', 'post'],'update-admin-details', [AdminController::class, 'updateAdminDetails']);
        Route::post('check-current-pwd', [AdminController::class, 'chkCurrentPassword']);
        Route::post('update-current-pwd', [AdminController::class, 'updateCurrentPassword']);
        Route::get('logout', [AdminController::class, 'logout']);

        // Section Route
        Route::get('sections', [SectionController::class, 'sections']);
        Route::post('update-section-status', [SectionController::class, 'updateSectionStatus']);

        // Categories
        Route::get('categories', [CategoryController::class, 'categories']);
        Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);
        Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);
        //append category
        Route::post('append-categories-level', [CategoryController::class, 'appendCategoryLevel']);
        //Delete Category image
        Route::get('delete-category-image/{id}', [CategoryController::class, 'deleteCategoryImage']);
        // Delete Category
        Route::get('delete-category/{id}', [CategoryController::class, 'deleteCategory']);


        // Products Routs
        Route::get('products', [ProductsController::class, 'products']);
        Route::post('update-product-status', [ProductsController::class, 'updateProductStatus']);
        // Delete Category
        Route::get('delete-product/{id}', [ProductsController::class, 'deleteProduct']);
        // Add Edit Product
        Route::get('delete-product/{id}', [ProductsController::class, 'deleteProduct']);
        Route::match(['get','post'], 'add-edit-product/{id?}', [ProductsController::class, 'addEditProduct']);
        //Delete Product Image
        Route::get('delete-product-image/{id}', [ProductsController::class, 'deleteProductImage']);
        Route::get('delete-product-video/{id}', [ProductsController::class, 'deleteProductVideo']);

        // Attributes Routes
        Route::match(['get','post'], 'add-attributes/{id}', [ProductsController::class, 'addAttributes']);
        Route::post('edit-attributes/{id}', [ProductsController::class, 'editAttributes']);
        Route::post('update-attribute-status', [ProductsController::class, 'updateAttributeStatus']);
        Route::get('delete-attribute/{id}', [ProductsController::class, 'deleteAttribute']);

        // Images
        Route::match(['get','post'], 'add-images/{id}', [ProductsController::class, 'addImages']);
        Route::post('update-image-status', [ProductsController::class, 'updateImageStatus']);
        Route::get('delete-image/{id}', [ProductsController::class, 'deleteImage']);


    });
   
});

