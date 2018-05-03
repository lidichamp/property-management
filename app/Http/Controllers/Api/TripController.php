<?php

namespace App\Http\Controllers\Api;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\Core\Trips;
use App\Trip;
use Response;
use Validator;

class TripController extends Controller

{    public function add(Request $request)
	{
		  // return Returns::ok($request);
       return Response::json(Returns::ok(Trips::create($request));
    }
    
	public function get_all()
	{
		Trips::all();
	}

	public function get_by_operator(Request $request, $operator){
		Trips::get_by_operator($operator);
	}
	public function get(Request $request, $id)
	{
		Trips::find($id);
	}
}