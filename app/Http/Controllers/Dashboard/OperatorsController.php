<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Operator;
use App\User;
use App\Jetty;
use App\Http\Controllers\Controller;
use App\DataTables\OperatorDataTable;
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

}
