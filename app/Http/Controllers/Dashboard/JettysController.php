<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Boat;
use App\User;
use App\Jetty;
use App\Http\Controllers\Controller;
use App\DataTables\JettiesDataTable;
class JettysController extends Controller
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
            return view('dashboard.jetty.home', [
                'page_title'=>'View Jetties ',
                'found_user'=>$found_user,
                'id'=>$id
            ]);
        }
        return redirect(route('home'))->withErrors([
            'You do not have enough Privilege to perform this operation'
        ]);

    }
	  public function manage(JettiesDataTable $dataTable, $id=null){
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.jetty.manage', [
            'page_title'=>'Jetty Management',
          //  'offices'=> Helpers::getOfficesKeyValue(),
            'jetty'=> $id?Jetty::find($id):null
        ]);
    }
	 public function jetty_save(Request $request, $id=null){
        $validatedData = $request->validate([
            'name'=>'required|max:150',
            'address'=>'string|nullable',
            'latitude'=>'string|nullable',
			'longitude'=>'string|nullable'
        ]);

        if($id){
            $jetty = Jetty::find($id);
            if($jetty){
                $jetty->name = $validatedData['name'];
                $jetty->address = $validatedData['address'];
                $jetty->latitude = $validatedData['latitude'];
                $jetty->longitude = $validatedData['longitude'];
                $jetty->save();
            }
            else{
                return back()->withErrors(['Resource not found.']);
            }
        }
        else {
            Jetty::create($validatedData);
        }

        return redirect(route('jetty.manage'))->withInput(['success'=>true]);
    }

}
