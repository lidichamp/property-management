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
    Route::get('/get_regions', function(){
        return Returns::ok(\App\Core\ProjectAttributes::getRegions());
    });
    Route::get('/get_states', function(){
        return Returns::ok(\App\Core\ProjectAttributes::getStates());
    });
    Route::get('/get_states_by_region', function(Request $request){
        return Returns::ok(\App\Core\ProjectAttributes::getStatesByRegion($request->query('region')));
    });
    Route::get('/get_region_by_state', function(Request $request){
        return Returns::ok(\App\Core\ProjectAttributes::getRegionsByState($request->query('state')));
    });
    Route::get('/get_project_status', function(){
        return Returns::ok(\App\Core\ProjectAttributes::getStatus());
    });
    Route::get('/get_project_types', function(){
        return Returns::ok(\App\Core\ProjectAttributes::getTypes());
    });
    Route::get('/get_offices', function(){
        return Returns::ok(\App\Office::select('id', 'name')->get());
    });
    Route::get('/get_regions_map_states', function(){
        return Returns::ok(\App\Core\ProjectAttributes::getRegionsWithState());
    });

});
