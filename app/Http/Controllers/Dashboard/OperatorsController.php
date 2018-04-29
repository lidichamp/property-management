<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Operator;
use App\User;
use App\Jetty;
use App\Boat;
use App\Http\Controllers\Controller;
use App\DataTables\OperatorDataTable;
use App\DataTables\BoatDataTable;
class OperatorsController extends Controller
{
     public function index(Request $request, $id=null){
        $user_id = $request->user()->id;
        if($id){
            //super admin checking profile of a sub user
            if($request->user()->role == 1){
                $user_id = $id;
            }
        }

        $found_user = User::find($user_id);
        if($found_user){
            return view('dashboard.operator.home', [
                'page_title'=>'View Operators ',
                'found_user'=>$found_user,
                'id'=>$id
            ]);
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
	
	  public function manage_boat(BoatDataTable $dataTable,$operator_id,$id=null){
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.boat.manage', [
			'operator'=>Operator::find($operator_id),
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

        return redirect(route('operator.manage'))->withInput(['success'=>true]);
    }

		

}
