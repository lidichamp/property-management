<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Core\Helpers;

class Passenger extends Model
{
    
    use Uuids;

    public $incrementing = false;

    protected $dates = [ 'created_at', 'updated_at'];

    protected $fillable = ['name','phone','kin','kin_phone','age_range'];
public static function getPassenger()
	{
		
			$types = Passenger::pluck('name','id')->toArray();
            return $types;
	}

}
