<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Core\Trips;
use App\Trip;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\DataTables\TripDataTable;
class TripController extends Controller
{

     public static function index($id,$trip_id=null)
	{
		return view('dashboard.trip.manage', [
                'page_title'=>'View Boats ',
				'operator'=>$id,
				'trip'=>Trip::find($trip_id)]);
	}
     public static function manage(TripDataTable $dataTable,$operator)
	{
	if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->with('operator',$operator)->render('dashboard.trip.table');
	} 
	 public static function starttrip($id)
	{ $process = collect(Trips::start($id));
		
        if($process->get('code') == Returns::$ok_response){
            return back()->withInput(['success'=>true]);
        }
        else{
            $error = is_object($process->get('error'))?$process->get('error'):(object)['msg'=>$process->get('error')];
            return back()->withErrors($error)->withInput();
        }
		
	}
	
	 public static function endtrip($id)
	{ $process = collect(Trips::complete($id));
		
        if($process->get('code') == Returns::$ok_response){
            return back()->withInput(['success'=>true]);
        }
        else{
            $error = is_object($process->get('error'))?$process->get('error'):(object)['msg'=>$process->get('error')];
            return back()->withErrors($error)->withInput();
        }
		
	}
	 public static function canceltrip($id)
	{ $process = collect(Trips::cancel($id));
		
        if($process->get('code') == Returns::$ok_response){
            return back()->withInput(['success'=>true]);
        }
        else{
            $error = is_object($process->get('error'))?$process->get('error'):(object)['msg'=>$process->get('error')];
            return back()->withErrors($error)->withInput();
        }
		
	}
	
	 public static function failtrip($id)
	{ $process = collect(Trips::fail($id));
		
        if($process->get('code') == Returns::$ok_response){
            return back()->withInput(['success'=>true]);
        }
        else{
            $error = is_object($process->get('error'))?$process->get('error'):(object)['msg'=>$process->get('error')];
            return back()->withErrors($error)->withInput();
        }
		
	}
	
     public function createtrip_process(Request $request, $id=null){
		 $request->merge(['user_id'=> \Auth::user()->id]);
        $process = collect(Trips::create($request, $id));
		
        if($process->get('code') == Returns::$ok_response){
            return back()->withInput(['success'=>true]);
        }
        else{
            $error = is_object($process->get('error'))?$process->get('error'):(object)['msg'=>$process->get('error')];
            return back()->withErrors($error)->withInput();
        }
    }
}