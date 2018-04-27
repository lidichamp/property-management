<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;
use App\Core\ProjectAttributes;
use App\Project;
use Illuminate\Support\Facades\DB;
use App\Core\Helpers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		return redirect()->route('boat.home');
    }

    private function slotValuesInsideLabels($values){
        $ret = [];
        foreach (ProjectAttributes::getStatus() as $status){
            $val = 0;
            foreach($values->toArray() as $db_values){
                if($db_values['status'] == $status){
                    $val = $db_values['total'];
                }
            }
            array_push($ret, $val);
        }
        return $ret;
    }
}
