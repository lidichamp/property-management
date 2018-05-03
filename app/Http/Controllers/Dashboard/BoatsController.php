<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Boat;
use App\User;
use App\Jetty;
use App\Http\Controllers\Controller;
use App\DataTables\BoatDataTable;
use App\DataTables\BoatOperatorDataTable;
use Charts;
use DB;
use App\Trip;
class BoatsController extends Controller
{
     public function index(Request $request, $id=null){
        $user_id = $request->user()->id;
        if($id){
            //super admin checking profile of a sub user
            if($request->user()->role == 1){
                $user_id = $id;
            }
		}
		$values = Trip::select('boats.name as boat', DB::raw('count(boat_id) AS trips'))
		->leftJoin('boats', 'trips.boat_id', 'boats.id')
		->groupBy('boats.id')
		->get();
        
		$chart = Charts::create('bar', 'highcharts')
        ->title('Boat Trips')
        ->elementLabel('Trips')
        ->labels($values->pluck('boat'))
        ->values($values->pluck('trips'))
        ->responsive(false);
        $found_user = User::find($user_id);
        if($found_user){
            return view('dashboard.boat.home', [
                'page_title'=>'View Boats '
				,'chart'=>$chart,
                'found_user'=>$found_user,
                'id'=>$id
            ]);
        }
        return redirect(route('home'))->withErrors([
            'You do not have enough Privilege to perform this operation'
        ]);

    }
	  public function manage(BoatOperatorDataTable $dataTable, $id=null){
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.boat.manage', [
            'page_title'=>'Boat Management',
          //  'offices'=> Helpers::getOfficesKeyValue(),
            'boat'=> $id?Boat::find($id):null
        ]);
    }
	 public function table(BoatDataTable $dataTable, $id=null){
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.boat.table', [
            'page_title'=>'All Boats Management'
        ]);
    }
	 public function boat_save(Request $request, $id=null){
        $validatedData = $request->validate([
            'name'=>'required|max:150',
            'make'=>'string|nullable',
            'manufacturing_date'=>'date|nullable',
			'registration_id'=>'string',
			'capacity'=>'numeric',
			'home_jetty'=>'nullable|exists:jetties,id'
        ]);

        if($id){
            $boat = Boat::find($id);
            if($boat){
                $boat->name = $validatedData['name'];
                $boat->make = $validatedData['make'];
                $boat->manufacturing_date = $validatedData['manufacturing_date'];
                $boat->registration_id = $validatedData['registration_id'];
				$boat->capacity=$validatedData['capacity'];
				$boat->home_jetty=$validatedData['home_jetty'];
                $boat->save();
            }
            else{
                return back()->withErrors(['Resource not found.']);
            }
        }
        else {
            Boat::create($validatedData);
        }

        return redirect(route('boat.manage'))->withInput(['success'=>true]);
    }

}
