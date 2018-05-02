<?php
namespace App\Core;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Core\Returns;
use App\Trip;
use App\Trip_staff;
use Response;
use Validator;
/*
 * this class handles function related to trips
 */
class Trips{

    public static function create(Request $request){
        $payload = Helpers::remove_nulls($request->all());
        return static::validates_and_exec($payload);
    }

 
    private static function validates_and_exec($payload){
        $validate_array = [
            'boat_id'=>'required|exists:boats,id',
            'from_jetty'=>'required|exists:boats,id',
			'creator'=>'required|exists:users,id',
            'to_jetty'=>'required|exists:boats,id',
            'depature_type'=>'required|numeric|in:1,2',
            'depature_time'=>'required'
         ];
        $validate = Validator::make($payload, $validate_array);
        if($validate->fails()){
            return Returns::validationError($validate->errors());
        }
        return static::validate_staff($payload);
    }
    
    private static function validate_staff($payload){
        foreach ($payload['staff'] as $index=>$value){
			dd($payload['staff']);
            $validate_trip_staff = Validator::make($value, [
            'staff_id'=>'required|exists:users,id']);
            if($validate_staff->fails()){
                return Returns::validationError($validate_staff->errors()->merge(
                    [
                        'staff'=>($index+1)
                    ]));
            } 
            return static::process_trip($payload);
 
        }
    }
    
    
    public static function process_trip($payload){
        //first insert into the trips table
        $tripModel = new Trip();
        $trip_staff_array = [];
        $trip = Trip::create(collect($payload)->only($tripModel->getFillable())->toArray());
		//dd($payload);
        if($trip){
            foreach ($payload['staff'] as $value[]){
				
                $value['trip_id'] = $trip->id->string;
                
                }
                //try and catch error for a rollback if error error
                try{
					//dd($value);
                    array_push($trip_staff_array, Trip_staff::create($value)->toArray());
                }
                catch(QueryException $ex){
                    $trip->delete();
                    return Returns::systemError($ex->getMessage());
                }
            }
        
        
        
        return Returns::ok([
            'trip'=> $trip,
            'trip_staff'=> $trip_staff_array
        ]);
        
    }
	
	public static function all()
	{
		$trip=Trip::with('trip_staff')->get();
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
		
	}	

		public static function get($id)
	{
		$trip=Trip::with('trip_staff')->find($id);
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
		
	}	
	
	public static function get_by_operator($id)
	{
		Trip::with('trip_staff')->where('operator',$id)->get();
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
	}
	}
    