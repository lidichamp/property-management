<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Trip;
use App\Trip_staff;
use App\Trip_passenger;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\User;
use App\Route;
use App\DataTables\RouteDataTable;
class RouteController extends Controller
{

     public static function index($id=null)
	{
		return view('dashboard.route.manage', [
                'page_title'=>'View Routes',
				
				'route'=>Route::find($id)]);
	}
	
	 public function add_update(Request $request, $id=null){
        $validatedData = $request->validate([
            'name'=>'nullable|max:150',
            'from_jetty'=>'required|exists:jetties,id',
			'creator'=>'required|exists:users,id',
            'to_jetty'=>'required|exists:jetties,id',
			'km_estimate'=>'nullable',
			'ref'=>'nullable',
			'note'=>'nullable'
        ]);

        if($id){
            $route = Route::find($id);
            if($route){
                $route->name = $validatedData['name'];
                $route->from_jetty = $validatedData['from_jetty'];
                $route->to_jetty = $validatedData['to_jetty'];
                $route->ref = $validatedData['ref'];
				$route->km_estimate=$validatedData['km_estimate'];
				$route->note=$validatedData['note'];
				$route->creator=$validatedData['creator'];
                $route->save();
            }
            else{
                return back()->withErrors(['Resource not found.']);
            }
        }
        else {
            Route::create($validatedData);
        }

        return redirect(route('route.home'))->withInput(['success'=>true]);
    }
	   public static function manage(RouteDataTable $dataTable)
	{
	if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.route.table', [
            'page_title'=>'All Routes'
        ]);
	} 
	public static assign_operator($id)
	{
		return view('dashboard.route.operator');
	}
	
}