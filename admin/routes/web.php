<?php

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

//user login urls
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('login', 'Auth\LoginController@login');

// Route::get('api-sync','ApiSyncController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'DashboardController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('home');
    Route::get('/', 'DashboardController@index')->name('dashboard');
    // Dashboard Charts
    Route::post('dashboard/getLineChartData', 'DashboardController@getLineChartData');
    Route::post('dashboard/getPieChartData', 'DashboardController@getPieChartData');

    //user
    Route::resource('user', 'UserController');
    Route::post('user-active', 'UserController@active')->name('user.active');
    Route::post('profile/update', 'UserController@profileUpdate')->name('profile.update');
    Route::post('user/password-rest', 'UserController@resetPassword')->name('user.password.rest');
    Route::post('user/data', 'UserController@getAll');

    // Product Main Category Route Part
    Route::resource('main-category','MainCategoryController');
    Route::post('main-category-all', 'MainCategoryController@getAll');
    Route::post('main-category-active', 'MainCategoryController@active');
    Route::post('main-category/{id}', 'MainCategoryController@destroy');

    // Product Sub Category Level 1 Route Part
    Route::resource('sub-category1','SubCategoryController');
    Route::post('sub-category1-all', 'SubCategoryController@getAll');
    Route::post('sub-category1-active', 'SubCategoryController@active');
    Route::post('sub-category1/{id}', 'SubCategoryController@destroy');

    // Product Sub Category Level 2 Route Part
    Route::resource('sub-category2','SubCategoryController2');
    Route::post('sub-category2-all', 'SubCategoryController2@getAll');
    Route::post('sub-category2-active', 'SubCategoryController2@active');
    Route::post('sub-category2-getSubCategoryByMainCategory', 'SubCategoryController2@getSubCategoryByMainCategory');
    Route::post('sub-category2/{id}', 'SubCategoryController2@destroy');

    // Product
    Route::resource('products', 'ProductController');
    Route::post('products/data', 'ProductController@data');
    Route::post('product-active', 'ProductController@active')->name('product.active');
    Route::post('products/create', 'ProductController@store');
    Route::post('products/{id}/update', 'ProductController@update');
    Route::post('products-getSubCategoryByMainCategory', 'ProductController@getSubCategoryByMainCategory');
    Route::post('products-getSubCategory2BySubCategory', 'ProductController@getSubCategory2BySubCategory');
    Route::post('products/{id}', 'ProductController@destroy');

    // Brand
    Route::resource('brands', 'BrandController');
    Route::post('brands/data', 'BrandController@data');
    Route::post('brand-active', 'BrandController@active')->name('brand.active');
    Route::post('brands/create', 'BrandController@store');
    Route::post('brands/{id}/update', 'BrandController@update');
    Route::post('view-brand', 'BrandController@viewBrand');


    });

Route::get('error/{id}', function($id)
{
  dd('ERROR CODE : '.$id);
});
