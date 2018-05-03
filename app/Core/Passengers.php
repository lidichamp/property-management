<?php
namespace App\Core;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Core\Returns;
use App\Passenger;
use Response;
use Validator;
/*
 * this class handles function related to passengers
 */
class Passengers{

    public static function create(Request $request,$trip_id,$id){
        $payload = Helpers::remove_nulls($request->all());
        return static::validates_and_exec($payload,$trip_id,$id);
		
    }

 
    private static function validates_and_exec($payload,$trip_id,$id){
		
        $validate_array = [
            'name'=>'required',
            'phone'=>'required|unique:passengers,id',
			'kin_name'=>'required',
            'kin_phone'=>'required',
            'age_range'=>'nullable'
         ];
        $validate = Validator::make($payload, $validate_array);
        if($validate->fails()){
            return Returns::validationError($validate->errors());
        }
		
        return static::process_passenger($payload,$trip_id,$id);
    }
     }
    
    
    public static function process_passenger($payload,$trip_id,$id){
        //first insert into the passengers table
        $passengerModel = new Passenger();
      
        $passenger = Passenger::create(collect($payload)->only($passengerModel->getFillable())->toArray());
		
        if($passenger){
			$trip_passenger= new Trip_passenger();
			$trip_passenger->trip_id=$trip_id;
			$trip_passenger->passenger_id=$passenger->id->string;
			$trip_passenger->save();
			  return Returns::ok([
            'passenger'=> $passenger->id->string
        ]);
             
            }
        
         return Returns::notfoundError(['err'=>'Passenger not added.']);
        
      
        
    }
	
	public static function all()
	{
		$passenger=Passenger::get();
		if($passenger){
            return Returns::ok($passenger);
        }
        return Returns::notfoundError(['err'=>'Passenger not found. Check the id']);
		
	}	

		public static function get($id)
	{
		$passenger=Passenger::find($id);
		if($passenger){
            return Returns::ok($passenger);
        }
        return Returns::notfoundError(['err'=>'Passenger not found. Check the id']);
		
	}	
	
	
	}
    