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

Auth::routes();

// all
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/ajax-technology', 'Technology\\TechnologyController@dataAjaxTechnology')->name('ajax-technology');
    Route::get('/admin/get-picture/{type}/{search}', 'Picture\\PictureController@getPicture')->name('picture.get-picture');
    Route::get('/admin/ajax-equipment', 'Equipment\\EquipmentController@dataAjaxEquipment')->name('ajax-equipment');
});

// backend
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/', function () {
        return redirect('/admin');
    });

    Route::get('admin', function () {
        return view('backend.layouts.main');
    })->name('admin');

    Route::resource('admin/customer', 'Customer\\CustomerController', ['as' => 'customer']);

    Route::resource('admin/technology', 'Technology\\TechnologyController', ['as' => 'technology']);

    Route::resource('admin/technology-picture', 'TechnologyPicture\\TechnologyPictureController',
        ['as' => 'technology-picture']
    );

    Route::resource('admin/picture', 'Picture\\PictureController',
        ['as' => 'picture']
    );

    Route::resource('admin/equipment', 'Equipment\\EquipmentController', ['as' => 'equipment']);

    Route::resource('admin/equipment-assignment', 'EquipmentAssignment\\EquipmentAssignmentController',
        ['as' => 'equipment-assignment']
    );

    Route::resource('admin/service', 'Service\\ServiceController', ['as' => 'service']);

    Route::resource('admin/video', 'Video\\VideoController', ['as' => 'video']);

    Route::resource('admin/draft', 'Draft\\DraftController', ['as' => 'draft']);

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});
//frontend
Route::group(['middleware' => ['auth', 'sale']], function () {
    Route::get('/', function () {
        return redirect('/create/home');
    });

    Route::get('/create/{form}', 'FrontendController@index')->name('create-form');
    Route::get('/create/service/{array}', 'FrontendController@service')->name('create-service-form');
    Route::get('/session-clear', 'FrontendController@clear');

    Route::post('/customer-create', 'FrontendController@postCreateCustomer')->name('customer-post-create');
    Route::post('/service-create', 'FrontendController@postCreateService')->name('service-post-create');
    Route::post('/technology-create', 'FrontendController@postCreateTechnology')->name('technology-post-create');

    Route::get('/customer-create', 'FrontendController@createCustomer')->name('customer-create');
    Route::get('/admin/ajax-customer', 'Customer\\CustomerController@dataAjaxCustomer')->name('ajax-customer');

    Route::get('/load-equipment-assignment', 'FrontendController@equipment_assignment')->name('load-equipment-assignment');

//    Route::get('/home', 'HomeController@index')->name('home');

    //Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});
