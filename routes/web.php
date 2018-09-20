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
    Route::get('/', function () {
        return redirect('/admin');
    });
    Route::get('/admin/ajax-technology', 'Technology\\TechnologyController@dataAjaxTechnology')->name('ajax-technology');
    Route::get('/admin/get-picture/{type}/{search}', 'Picture\\PictureController@getPicture')->name('picture.get-picture');
    Route::get('/admin/ajax-equipment', 'Equipment\\EquipmentController@dataAjaxEquipment')->name('ajax-equipment');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});

// backend
Route::group(['middleware' => ['admin']], function () {

    Route::get('/', function () {
        return redirect('/admin');
    });

    Route::get('change/{locale}', function ($locale) {
        Session::set('locale', $locale); // กำหนดค่าตัวแปรแบบ locale session ให้มีค่าเท่ากับตัวแปรที่ส่งเข้ามา 
        return Redirect::back(); // สั่งให้โหลดหน้าเดิม
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
});

//frontend
Route::group(['middleware' => ['sale']], function () {
    Route::get('/', function () {
        return redirect('/sale/home');
    });
    Route::get('/sale', function () {
        return redirect('/sale/home');
    });

    Route::get('/sale/customer-create', 'FrontendController@createCustomer')->name('sale-customer-create');
    Route::get('/sale/ajax-customer', 'Customer\\CustomerController@dataAjaxCustomer')->name('sale-ajax-customer');

    Route::get('/sale/load-equipment-assignment', 'FrontendController@equipment_assignment')
            ->name('sale-load-equipment-assignment');

    Route::get('/sale/generate-pdf','FrontendController@generate_pdf')->name('sale-generate-pdf');
    Route::get('/sale/draft-excel','FrontendController@export')->name('sale-draft-excel');
    Route::get('/sale/mail','FrontendController@test_mail')->name('sale-mail');

    Route::get('/sale/draft', 'FrontendController@draft')->name('sale-draft');
    Route::get('/sale/{form}', 'FrontendController@index')->name('sale-create-form');
    Route::get('/sale/service/{array}', 'FrontendController@service')->name('sale-create-service-form');

    Route::post('/sale/customer-create', 'FrontendController@postCreateCustomer')->name('sale-customer-post-create');
    Route::post('/sale/service-create', 'FrontendController@postCreateService')->name('sale-service-post-create');
    Route::post('/sale/technology-create', 'FrontendController@postCreateTechnology')->name('sale-technology-post-create');

    Route::post('/sale/draft-create', 'FrontendController@postCreateDraft')->name('sale-draft-post-create');

});

Route::group(['middleware' => ['saleadmin']], function () {
    Route::get('/', function () {
        return redirect('/saleadmin/home');
    });
    Route::get('/saleadmin', function () {
        return redirect('/saleadmin/home');
    });

    Route::get('/saleadmin/customer-create', 'FrontendController@createCustomer')->name('saleadmin-customer-create');
    Route::get('/saleadmin/ajax-customer', 'Customer\\CustomerController@dataAjaxCustomer')->name('saleadmin-ajax-customer');

    Route::get('/saleadmin/load-equipment-assignment', 'FrontendController@equipment_assignment')
            ->name('saleadmin-load-equipment-assignment');

    Route::get('/saleadmin/{form}', 'FrontendController@index')->name('saleadmin-create-form');
    Route::get('/saleadmin/service/{array}', 'FrontendController@service')->name('saleadmin-create-service-form');

    Route::post('/saleadmin/customer-create', 'FrontendController@postCreateCustomer')
            ->name('saleadmin-customer-post-create');
    Route::post('/saleadmin/service-create', 'FrontendController@postCreateService')
            ->name('saleadmin-service-post-create');
    Route::post('/saleadmin/technology-create', 'FrontendController@postCreateTechnology')
            ->name('saleadmin-technology-post-create');
});

Route::group(['middleware' => ['supervisor']], function () {
    Route::get('/', function () {
        return redirect('/supervisor/home');
    });
    Route::get('/supervisor', function () {
        return redirect('/supervisor/home');
    });

    Route::get('/supervisor/customer-create', 'FrontendController@createCustomer')
            ->name('supervisor-customer-create');
    Route::get('/supervisor/ajax-customer', 'Customer\\CustomerController@dataAjaxCustomer')
            ->name('supervisor-ajax-customer');

    Route::get('/supervisor/load-equipment-assignment', 'FrontendController@equipment_assignment')
            ->name('supervisor-load-equipment-assignment');

    Route::get('/supervisor/{form}', 'FrontendController@index')->name('supervisor-create-form');
    Route::get('/supervisor/service/{array}', 'FrontendController@service')->name('supervisor-create-service-form');

    Route::post('/supervisor/customer-create', 'FrontendController@postCreateCustomer')
            ->name('supervisor-customer-post-create');
    Route::post('/supervisor/service-create', 'FrontendController@postCreateService')
            ->name('supervisor-service-post-create');
    Route::post('/supervisor/technology-create', 'FrontendController@postCreateTechnology')
            ->name('supervisor-technology-post-create');
});
