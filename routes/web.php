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
    return view('welcome', [
        'page_title'=>'Welcome'
    ]);
})->middleware('guest')->name('home.login');

Auth::routes();

Route::group([
    'prefix'=>'dashboard',
    'middleware'=>['auth']
], function(){
    Route::get('/user/logout', function(){
        Auth::logout();
        return redirect(route('home'));
    })->name('dashboard.logout');
    Route::get('/home', 'HomeController@index')->name('home');
	//Route::get('/home', 'Dashboard\JettysController@index')->name('home');
    Route::group([
        'prefix'=>'profile',
    ], function(){
        Route::get('/view/{id?}', 'Dashboard\ProfileController@index')->name('profile.view');
        Route::get('/edit', 'Dashboard\ProfileController@edit')->name('profile.edit');
        Route::post('/edit/save', 'Dashboard\ProfileController@update')->name('profile.edit.save');
        Route::get('/password/change', 'Dashboard\ProfileController@change_password')->name('profile.password.change');
        Route::post('/password/change/save', 'Dashboard\ProfileController@update_change_password')->name('profile.password.change.save');
    });
	 Route::group([
        'prefix'=>'boat',
    ], function(){
        Route::get('/home', 'Dashboard\BoatsController@index')->name('boat.home');
        Route::get('/manage/{id?}', 'Dashboard\BoatsController@manage')->name('boat.manage');
        Route::post('/add_update/{id?}', 'Dashboard\BoatsController@boat_save')->name('boat.save');
		Route::get('/table','Dashboard\BoatsController@table')->name('boat.table');
    });
	 Route::group([
        'prefix'=>'jetty',
    ], function(){
        Route::get('/home', 'Dashboard\JettysController@index')->name('jetty.home');
        Route::get('/manage/{id?}', 'Dashboard\JettysController@manage')->name('jetty.manage');
        Route::post('/add_update/{id?}', 'Dashboard\JettysController@jetty_save')->name('jetty.save');
    });
	
	 Route::group([
        'prefix'=>'operator',
    ], function(){
        Route::get('/home', 'Dashboard\OperatorsController@index')->name('operator.home');
        Route::get('/manage/{id?}', 'Dashboard\OperatorsController@manage')->name('operator.manage');
        Route::get('/administration/{id}', 'Dashboard\OperatorsController@dashboard')->name('operator.dashboard');
        Route::get('/manage_boat/{operator_id}/{id?}', 'Dashboard\OperatorsController@manage_boat')->name('operator.assign.boat');
        Route::post('/add_update_boat/{id?}', 'Dashboard\OperatorsController@add_boat')->name('operator.add.boat');
        Route::post('/add_update/{id?}', 'Dashboard\OperatorsController@operator_save')->name('operator.save');
    });
    Route::group([
        'prefix'=>'users',
    ], function(){
        Route::get('/home', 'Dashboard\AdminController@index')->name('admin.home');
        Route::get('/manage/{id?}', 'Dashboard\AdminController@manage')->name('admin.manage');
        Route::post('/invite_update/{id?}', 'Dashboard\AdminController@invite_update')->name('admin.invite.update');
        Route::get('/manage/suspend-unsuspend/{id}', 'Dashboard\AdminController@suspend_unsuspend')->name('admin.suspend.unsuspend');
    });

 

});

