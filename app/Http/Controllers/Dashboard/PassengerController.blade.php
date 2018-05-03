<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Core\Trips;
use App\Trip;
use App\Passenger;
use App\Trip_staff;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\DataTables\TripDataTable;
class TripController extends Controller
{

    public static function index($trip_id,$id=null)
	{
		return view('dashboard.trip.passenger', [
                'page_title'=>'Add Passenger',
				'trip'=>$id,
				'passenger'=>Passenger::find($id)]);
	}
	

	
	public static function save_passenger($trip_id,$id=null)
	{
		$process = collect(Trips::save_passenger($trip_id,$id=null));
		
        if($process->get('code') == Returns::$ok_response){
            return back()->withInput(['success'=>true]);
        }
        else{
            $error = is_object($process->get('error'))?$process->get('error'):(object)['msg'=>$process->get('error')];
            return back()->withErrors($error)->withInput();
        }
	}
	
	
}