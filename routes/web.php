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

    Route::get('/logout', 'LdapController@logout')->name('logout');

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
	
	Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{

    //frontend
    
        Route::get('/', function () {
            return redirect('/sale/customer');
        });
        Route::get('/sale', function () {
            return redirect('/sale/customer');
        });

        Route::get('/sale/customer-create', 'FrontendController@createCustomer')->name('sale-customer-create');
        Route::get('/sale/ajax-customer', 'Customer\\CustomerController@dataAjaxCustomer')->name('sale-ajax-customer');

        Route::get('/sale/load-videos', 'FrontendController@video')
                ->name('sale-load-video');
        Route::get('/sale/load-equipment-assignment', 'FrontendController@equipment_assignment')
                ->name('sale-load-equipment-assignment');

        Route::get('/sale/seach-technology', 'FrontendController@dataAjaxTechnologySearch')->name('sale-search-technology');

        Route::get('/sale/generate-pdf','FrontendController@generate_pdf')->name('sale-generate-pdf');
        Route::get('/sale/draft-excel','FrontendController@export')->name('sale-draft-excel');
        Route::get('/sale/mail','FrontendController@test_mail')->name('sale-mail');

        Route::get('/sale/technology', 'FrontendController@technology')->name('sale-technology');
        Route::get('/sale/draft', 'FrontendController@draft')->name('sale-draft');

        Route::get('/sale/history', 'FrontendController@history')->name('sale-history');

        Route::get('/sale/{form}', 'FrontendController@index')->name('sale-create-form');

        Route::post('/sale/customer-create', 'FrontendController@postCreateCustomer')->name('sale-customer-post-create');
        Route::post('/sale/service-create', 'FrontendController@postCreateService')->name('sale-service-post-create');
        Route::post('/sale/technology-create', 'FrontendController@postCreateTechnology')->name('sale-technology-post-create');

        Route::post('/sale/draft-create', 'FrontendController@postCreateDraft')->name('sale-draft-post-create');

    

    
        Route::get('/', function () {
            return redirect('/saleadmin/home');
        });
        Route::get('/saleadmin', function () {
            return redirect('/saleadmin/home');
        });

        Route::get('/saleadmin/customer-create', 'FrontendController@createCustomer')
            ->name('saleadmin-customer-create');
        Route::get('/saleadmin/ajax-customer', 'Customer\\CustomerController@dataAjaxCustomer')
            ->name('saleadmin-ajax-customer');

        Route::get('/saleadmin/load-videos', 'FrontendController@video')
                ->name('saleadmin-load-video');
        Route::get('/saleadmin/load-equipment-assignment', 'FrontendController@equipment_assignment')
                ->name('saleadmin-load-equipment-assignment');

        Route::get('/saleadmin/generate-pdf','FrontendController@generate_pdf')->name('saleadmin-generate-pdf');
        Route::get('/saleadmin/draft-excel','FrontendController@export')->name('saleadmin-draft-excel');
        Route::get('/saleadmin/mail','FrontendController@test_mail')->name('saleadmin-mail');

        Route::get('/saleadmin/technology', 'FrontendController@technology')->name('saleadmin-technology');
        Route::get('/saleadmin/draft', 'FrontendController@draft')->name('saleadmin-draft');

        Route::get('/saleadmin/history', 'FrontendController@history')->name('saleadmin-history');

        Route::get('/saleadmin/{form}', 'FrontendController@index')->name('saleadmin-create-form');

        Route::post('/saleadmin/customer-create', 'FrontendController@postCreateCustomer')
            ->name('saleadmin-customer-post-create');
        Route::post('/saleadmin/service-create', 'FrontendController@postCreateService')
            ->name('saleadmin-service-post-create');
        Route::post('/saleadmin/technology-create', 'FrontendController@postCreateTechnology')
            ->name('saleadmin-technology-post-create');

        Route::post('/saleadmin/draft-create', 'FrontendController@postCreateDraft')
            ->name('saleadmin-draft-post-create');
    

    

});



