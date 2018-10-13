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
 
 
Route::get('/', function () {
    return view('/auth/login');
});


//Route::get('/test/{username}', ['uses' => 'TestController@store']);
Route::resource('users','LdapController');

//all routes
Route::get('/', function () {
        return redirect('/admin');
    });
    Route::get('change/{locale}/{url}', 'HomeController@switch_lang')->name('auth.lang');

    Route::get('/admin/ajax-technology', 'Technology\\TechnologyController@dataAjaxTechnology')->name('ajax-technology');
    Route::get('/admin/ajax-technology-service', 'Technology\\TechnologyController@dataAjaxTechnologyService')
        ->name('ajax-technology-service');
    Route::get('/admin/get-picture/{type}/{search}', 'Picture\\PictureController@getPicture')->name('picture.get-picture');
    Route::get('/admin/ajax-equipment', 'Equipment\\EquipmentController@dataAjaxEquipment')->name('ajax-equipment');

    Route::get('/logout', 'Auth\LdapController@logout')->name('logout');

//backend routes
Route::get('/', function () {
        return redirect('/admin');
    });

    Route::get('admin', function () {
        return view('backend.layouts.main');
    })->name('admin');

    Route::resource('admin/customer', 'Customer\\CustomerController', ['as' => 'customer']);

    Route::resource('admin/technology', 'Technology\\TechnologyController', ['as' => 'technology']);

    Route::resource('admin/technology-picture', 'TechnologyPicture\\TechnologyPictureController', ['as' => 'technology-picture']
    );

    Route::resource('admin/picture', 'Picture\\PictureController', ['as' => 'picture']
    );

    Route::resource('admin/equipment', 'Equipment\\EquipmentController', ['as' => 'equipment']);

    Route::resource('admin/equipment-assignment', 'EquipmentAssignment\\EquipmentAssignmentController', ['as' => 'equipment-assignment']
    );

    Route::resource('admin/service', 'Service\\ServiceController', ['as' => 'service']);

    Route::resource('admin/video', 'Video\\VideoController', ['as' => 'video']);

    Route::resource('admin/draft', 'Draft\\DraftController', ['as' => 'draft']);

    Route::resource('admin/reservoir', 'Reservoir\\ReservoirController', ['as' => 'reservoir']);
    
    Route::resource('admin/pipe', 'Pipe\\PipeController', ['as' => 'pipe']);
    
    Route::resource('admin/user', 'User\\UserController', ['as' => 'user']);



