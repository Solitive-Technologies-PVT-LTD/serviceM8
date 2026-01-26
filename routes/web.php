<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
 use App\Http\Controllers\ServiceM8Controller;
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

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/universal-documentation', function () {
    return view('universal-docs');
})->name('universal-docs');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Handle login logic here
    return redirect()->route('sites.select');
})->name('login.submit');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    // Handle registration logic here
    return redirect()->route('sites.select');
})->name('register.submit');

Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::get('/logout', function () {
    // Handle logout logic here
    return redirect()->route('home');
})->name('logout');

// Protected Routes (Site Selection and Dashboard)
Route::get('/sites', function () {
    return view('sites.select');
})->name('sites.select');

Route::get('/dashboard/{site?}', function ($site = 1) {
    return view('dashboard', compact('site'));
})->name('sites');

// Service Routes
Route::get('/service/{id}', function ($id) {
    return view('service-detail', compact('id'));
})->name('service.detail');

// Invoice Routes
Route::get('/invoices', function () {
    return view('invoices');
})->name('invoices');

// Quote Routes
Route::get('/quote/request', function () {
    return view('request-quote');
})->name('quote.request');

Route::post('/quote/submit', function () {
    // Handle quote submission
    // Email to commercial@tomspestcontrol.com.au
    return redirect()->route('dashboard')->with('success', 'Quote request submitted successfully!');
})->name('quote.submit');

// Site Documentation Routes
Route::get('/site-documentation', function () {
    return view('site-documentation');
})->name('site.documentation');

// Contact Routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ServiceM8 Testing Routes (for development/testing)

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/forgot-password', function () {
    return view('auth.passwords.reset');
})->middleware('guest')->name('password.request');

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    //Language Translation

    

Route::get('/documents/{folderId?}', [DocumentController::class, 'index'])
    ->name('documents.index');

Route::post('/documents/folder', [DocumentController::class, 'storeFolder'])
    ->name('documents.folder.store');

Route::delete('/documents/folder/{id}', [DocumentController::class, 'destroyFolder'])
    ->name('documents.folder.delete');

Route::post('/documents/file', [DocumentController::class, 'storeFile'])
    ->name('documents.file.store');

Route::get('/documents/file/{id}/download', [DocumentController::class, 'download'])
    ->name('documents.file.download');

Route::delete('/documents/file/{id}', [DocumentController::class, 'destroyFile'])
    ->name('documents.file.delete');

     Route::get('/','DashboardController@index')->name('dashboard-index');
    Route::get('index/{locale}', 'HomeController@lang');
    Route::get('/dashboard','DashboardController@index');
    Route::post('/getDashboardData','DashboardController@dashboardAjax')->name('dashboard-data');
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/','SettingsController@index')->name('dashboard');
        Route::get('/setting-list','SettingsController@index');
        Route::get('/setting-ajax-data','SettingsController@ajaxSettingData');
        Route::get('/setting-create','SettingsController@create');
        Route::post('/setting-store','SettingsController@store')->name('setting-save');
        Route::get('/setting-show/{id}','SettingsController@show');
        Route::get('/setting-edit/{id}','SettingsController@edit');
        Route::post('/setting-update/{id}','SettingsController@update');
        Route::post('/setting-delete','SettingsController@destroy');
        Route::post('/get-settings-data','SettingsController@get_settings_data')->name('get-settings-data');
    });
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/','PermissionController@index')->name('permissions');
        Route::get('/permission-list','PermissionController@index');
        Route::get('/permission-ajax-data','PermissionController@ajaxSettingData');
        Route::get('/permission-create','PermissionController@create')->name('permission-create');
        Route::post('/permission-store','PermissionController@store')->name('permission-save');
        Route::get('/permission-show/{id}','PermissionController@show');
        Route::get('/permission-edit/{id}','PermissionController@edit');
        Route::post('/permission-update','PermissionController@update')->name('permission-update');
        Route::post('/permission-delete','PermissionController@destroy');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/','RoleController@index')->name('roles');
        Route::get('/role-list','RoleController@index');
        Route::get('/role-ajax-data','RoleController@ajaxSettingData');
        Route::get('/role-create','RoleController@create')->name('role-create');
        Route::post('/role-store','RoleController@store')->name('role-save');
        Route::get('/role-show/{id}','RoleController@show');
        Route::get('/role-edit/{id}','RoleController@edit');
        Route::post('/role-update','RoleController@update')->name('role-update');
        Route::post('/role-delete','RoleController@destroy');
    });
    Route::get('menus/ajax', ['uses' => 'MenusController@ajaxMenusData', "as" => "menus.ajax_data"]);
    Route::post('menus/update_menu_order', ['uses' => 'MenusController@updateMenuOrder', "as" => "menus.update_menu_order"]);
    Route::resource('menus', 'MenusController');
    Route::post('/destroy-menus','MenusController@destroyMenu');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/','UserController@index')->name('users');
        Route::get('/getData','UserController@getData')->name('getUsersData');
        Route::get('/create','UserController@create')->name('users-create');
        Route::post('/save','UserController@save')->name('users-save');
        Route::get('/edit/{id}','UserController@edit')->name('users-edit');
        Route::post('/update','UserController@update')->name('users-update');
        Route::post('/delete','UserController@delete')->name('users-delete');
        Route::get('/assign/{id}','UserController@assign')->name('users-assign');
        Route::post('/saveAssign','UserController@saveAssign')->name('users-saveAssign');
    });

 
   

Route::prefix('servicem8')->as('servicem8.')->group(function () {

        // Clients
        Route::get('/clients', [ServiceM8Controller::class, 'clients'])
            ->name('clients');

        // Staff
        Route::get('/staff', [ServiceM8Controller::class, 'staff'])
            ->name('staff');

        // Jobs
        Route::get('/jobs', [ServiceM8Controller::class, 'jobs'])
            ->name('jobs');

        Route::get('/attachment/download/{uuid}', [ServiceM8Controller::class, 'downloadAttachment'])
     ->name('attachment.download');
        Route::get('/jobs/{uuid}', [ServiceM8Controller::class, 'showJob'])
            ->name('jobs.show');

        // Job attachments / documentation
        Route::get('/jobs/{uuid}/attachments', [ServiceM8Controller::class, 'attachments'])
            ->name('jobs.attachments');

        // Quotes
        Route::get('/quotes', [ServiceM8Controller::class, 'quotes'])
            ->name('quotes');

        // Invoices
        Route::get('/invoices', [ServiceM8Controller::class, 'invoices'])
            ->name('invoices');
    });
    Route::get('/company/{companyUuid}', [ServiceM8Controller::class, 'clientJobs'])
    ->name('company.clientJobs');
    
});