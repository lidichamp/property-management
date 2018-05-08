<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Operator;
use App\User;
use App\Jetty;
use App\Boat;
use App\Http\Controllers\Controller;
use App\DataTables\OperatorDataTable;
use App\DataTables\BoatOperatorDataTable;
use DB;
use Charts;
class OperatorsController extends Controller
{
     public function index(Request $request, $id=null){
  if($request->user()->role == 1){
               $user_id=$request->user()->role;
		$values = User::select('operators.name as operator', DB::raw('count(operator) AS staff'))
		->leftJoin('operators', 'users.operator', 'operators.id')
		->groupBy('users.operator')
		->get();
		$chart = Charts::create('bar', 'highcharts')
        ->title('Operator Staff')
        ->elementLabel('Staff')
        ->labels($values->pluck('operator'))
        ->values($values->pluck('staff'))
        ->responsive(false);
        $found_user = User::find($user_id);
        if($found_user){
            return view('dashboard.operator.home', [
                'page_title'=>'View Operators ',
				'chart'=>$chart,
                'found_user'=>$found_user,
                'id'=>$id
            ]);
        }
  }
        return redirect(route('home'))->withErrors([
            'You do not have enough Privilege to perform this operation'
        ]);
  
    }
	  public function manage(OperatorDataTable $dataTable, $id=null){
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.operator.manage', [
            'page_title'=>'Operator Management',
          //  'offices'=> Helpers::getOfficesKeyValue(),
            'operator'=> $id?Operator::find($id):null
        ]);
    }
	 public function operator_save(Request $request, $id=null){
        $validatedData = $request->validate([
            'name'=>'required|max:150',
            'cac'=>'string|nullable',
            'registration_date'=>'date|nullable',
			'registered_name'=>'string'
        ]);

        if($id){
            $operator = Operator::find($id);
            if($operator){
                $operator->name = $validatedData['name'];
                $operator->cac = $validatedData['cac'];
                $operator->registration_date = $validatedData['registration_date'];
                $operator->registered_name = $validatedData['registered_name'];
                $operator->save();
            }
            else{
                return back()->withErrors(['Resource not found.']);
            }
        }
        else {
            Operator::create($validatedData);
        }

        return redirect(route('operator.manage'))->withInput(['success'=>true]);
    }
	
	  public function manage_boat(BoatOperatorDataTable $dataTable,$operator,$id=null){
		if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->with('operator_id',$operator)->render('dashboard.boat.manage', [
			'operator'=>Operator::find($operator),
            'page_title'=>'Assign a boat to:',
          //  'offices'=> Helpers::getOfficesKeyValue(),
            'boat'=> $id?Boat::find($id):null
        ]);
    }
	public function add_boat(Request $request, $id=null)
		{$validatedData = $request->validate([
            'name'=>'required|max:150',
            'make'=>'string|nullable',
            'manufacturing_date'=>'date|nullable',
			'registration_id'=>'string',
			'capacity'=>'numeric',
			'operator'=>'exists:operators,id',
			'home_jetty'=>'nullable|exists:jetties,id'
        ]);
        if($id){
            $boat = Boat::find($id);
            if($boat){
                $boat->name = $validatedData['name'];
                $boat->make = $validatedData['make'];
				$boat->operator=$validatedData['operator'];
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

        return back()->withInput(['success'=>true]);
    }
	
	
	  public function dashboard($id){
		  $values = Boat::select('jetties.name as jetties', DB::raw('count(home_jetty) AS boats'))
		->leftJoin('jetties','boats.home_jetty','jetties.id')
		->where('boats.operator',$id)
		->groupBy('home_jetty')
		->get();
        $operator=Operator::find($id);
		$chart = Charts::create('bar', 'highcharts')
        ->title($operator->name .' boats grouped by their home jetties')
        ->elementLabel('Boats')
        ->labels($values->pluck('jetties'))
        ->values($values->pluck('boats'))
        ->responsive(false);
        return view('dashboard.operator.dashboard', [
            'page_title'=>$operator->name .' Dashboard',
			'id'=>$id,
			'chart'=>$chart
        ]);
    }

		

}
