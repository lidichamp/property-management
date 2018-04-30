<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Core\Helpers;

class Boat extends Model
{
    use SoftDeletes;
    use Uuids;

    public $incrementing = false;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = ['name','make','manufacturing_date','registration_id','capacity','home_jetty','operator'];

	public static function getBoat(){
        $boats =Boat::pluck('name','id');
		return $boats;
    }

}
