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
    'prefix'=>'projects',
    'middleware'=>['auth:api']
], function(){
    Route::post('/find', 'Api\ProjectController@all')->middleware('scope:monitor,evaluate');
    Route::get('/get/{id}', 'Api\ProjectController@one')->middleware('scope:monitor,evaluate');
    Route::post('/{id}/evaluate/{eval_id?}', 'Api\ProjectController@evaluate')->middleware('scope:evaluate');
    Route::post('/{id}/monitor', 'Api\ProjectController@monitor')->middleware('scope:monitor');
    Route::get('/{id}/monitor', 'Api\ProjectController@get_monitor')->middleware('scope:monitor,evaluate');
    Route::get('/{id}/evaluate', 'Api\ProjectController@get_evaluate')->middleware('scope:monitor,evaluate');
    Route::get('/monitor/{monitor_id}', 'Api\ProjectController@get_a_monitor')->middleware('scope:monitor,evaluate');
    Route::get('/{id}/history', 'Api\ProjectController@get_history')->middleware('scope:monitor,evaluate');
});

Route::group([
    'prefix'=>'util'
], function(){
    Route::get('/get_operator_by_jetty_type', function(Request $request){
        return Returns::ok(\App\Operator\getOperatorByType($request->query('jetty_type')));
    })->name('api.operator.jetty');
   
});
