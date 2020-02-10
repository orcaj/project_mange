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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['web','auth']], function(){

    Route::group(['middleware' => ['admin']], function(){
        Route::resource('users', 'UsersController');
        Route::resource('lga', 'LGAManageController');
        Route::resource('zone', 'ZoneManageController');

        Route::get('/MDA-manage', 'MDAManageController@index')->name('MDA_manage');
        Route::post('/mda_create', 'MDAManageController@mdaCreate')->name('mda_create');
        Route::get('/delete_mda/{id}', 'MDAManageController@mdaDelete')->name('delete_mda');
        Route::post('/mda_edit', 'MDAManageController@mdaUpdate')->name('mda_edit');

        Route::get('edit_project/pic_download/{pic_id}', 'CreateprojectController@picDownload')->name('pic_download');
        Route::get('/doc_download/{doc_id}', 'CreateprojectController@docDownload')->name('doc_download');


    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/global_search', 'HomeController@globalSearch')->name('global_search');


    Route::get('mda_info/{mda_id}', 'HomeController@mda_info' )->name('mda_info');

    Route::get('/projects', 'HomeController@projects')->name('projects');

    //ajax 
    Route::post('/fetch_projects','HomeController@fetchProject')->name('fetch_projects');
    Route::get('/edit_project/{id}','HomeController@editProject')->name('edit_project');
    Route::put('/update-project/{id}','HomeController@updateProject')->name('update-project');

    
    Route::post('/get_mdas', 'HomeController@getMdas')->name('get_mdas');

    Route::get('/count-cost', 'CountCostController@index')->name('count_cost');

    Route::get('/count-cost-amount', 'CountAmountController@index')->name('count_cost_amount');

    Route::get('/counts', 'CountsController@index')->name('counts');

    Route::get('/fetch_countexport/{state}', 'CountsController@fetchCountexport')->name('fetch_countexport');


    Route::post('/fetch_countdata', 'CountsController@fetchCountdata')->name('fetch_countdata');

    



    Route::get('/fetch_perexport/{mda_id}', 'TableController@fetchPerexport')->name('fetch_perexport');




    Route::get('/table', 'TableController@index')->name('table');

    Route::post('/fetch_perdata', 'TableController@fetch_perdata')->name('fetch_perdata');

    Route::get('/LGA-zone', 'LGAController@index')->name('lga_zone');
    Route::get('/add-project', 'CreateprojectController@index')->name('add-project');
    Route::post('/pic_upload', 'CreateprojectController@picUpload')->name('pic_upload');
    Route::post('/fetch_reports', 'CreateprojectController@fetchReports')->name('fetch_reports');
    Route::post('/doc_upload', 'CreateprojectController@docUpload')->name('doc_upload');


    Route::get('/lga_count', 'TableController@lga_count')->name('lga_count');

    Route::post('/fetch_lgadata', 'TableController@fetchLgadata')->name('fetch_lgadata');



    Route::get('/zone_count', 'TableController@zone_count')->name('zone_count');

    Route::post('/fetch_zonedata', 'TableController@fetchZonedata')->name('fetch_zonedata');

    //add project
    Route::post('/create-project', 'HomeController@createProject')->name('create-project');

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});    