<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Core\Trips;
use App\Trip;
use App\Passenger;
use App\Core\Passengers;
use App\Trip_staff;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\DataTables\RidersDataTable;
class PassengerController extends Controller
{

    public static function index($trip_id,$id=null)
	{
		return view('dashboard.trip.passenger', [
                'page_title'=>'Add Passenger',
				'trip'=>$id,
				'passenger'=>Passenger::find($id)]);
	}
	

    public static function rider_index($id=null)
	{
		return view('dashboard.rider.passenger', [
                'page_title'=>'Add Rider',
				'passenger'=>Passenger::find($id)]);
	}
	public static function save_rider(Request $request,$id=null)
	{
		$process = collect(Passengers::save($request,$id=null));
		
        if($process->get('code') == Returns::$ok_response){
            return back()->withInput(['success'=>true]);
        }
        else{
            $error = is_object($process->get('error'))?$process->get('error'):(object)['msg'=>$process->get('error')];
            return back()->withErrors($error)->withInput();
        }
	}
	public static function save_passenger(Request $request,$trip_id,$id=null)
	{
		$process = collect(Passengers::create($request,$trip_id,$id=null));
		
        if($process->get('code') == Returns::$ok_response){
            return back()->withInput(['success'=>true]);
        }
        else{
            $error = is_object($process->get('error'))?$process->get('error'):(object)['msg'=>$process->get('error')];
            return back()->withErrors($error)->withInput();
        }
	}
	    public static function manage(RidersDataTable $dataTable)
	{
	if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.rider.table');
	} 
	
	
}