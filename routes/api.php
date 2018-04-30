<?php

use Illuminate\Http\Request;
use App\Core\Returns;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//middleware('auth:api')->
Route::group([
    'prefix'=>'user'
], function(){
    Route::post('/auth', 'Api\AuthController@login');
    Route::get('/', 'Api\AuthController@get')->middleware('auth:api')->name('api.auth.user');
    Route::post('/3rd-party/auth', 'Api\AuthController@register_auth');
    Route::post('/refresh', 'Api\AuthController@refresh');
    Route::post('/firebase', 'Api\AuthController@firebase_token')->middleware(['auth:api', 'scope:monitor,evaluate']);
    Route::post('/logout', 'Api\AuthController@logout');
});

Route::group([
    'prefix'=>'users',
    'middleware'=>['auth:api']
], function(){
    Route::get('/find', 'Api\UserController@get_all')->middleware('scope:monitor');
    Route::get('/get/{id}', 'Api\UserController@get')->middleware('scope:monitor');
    Route::post('/home_jetty/{home_jetty}', 'Api\UserController@get_by_home_jetty')->middleware('scope:monitor');
    Route::post('/operator/{operator}', 'Api\UserController@get_by_operator')->middleware('scope:monitor');
});

Route::group([
    'prefix'=>'boat',
    'middleware'=>['auth:api']
], function(){
    Route::get('/find', 'Api\BoatController@get_all')->middleware('scope:monitor');
    Route::get('/get/{id}', 'Api\BoatController@get')->middleware('scope:monitor');
    Route::post('/home_jetty/{home_jetty}', 'Api\BoatController@get_by_home_jetty')->middleware('scope:monitor');
    Route::post('/operator/{operator}', 'Api\BoatController@get_by_operator')->middleware('scope:monitor');
});

Route::group([
    'prefix'=>'util'
], function(){
    Route::get('/get_operator_by_jetty_type', function(Request $request){
        return Returns::ok(\App\Operator::getOperatorByType($request->query('jetty_type')));
    })->name('api.operator.jetty');
   
});
