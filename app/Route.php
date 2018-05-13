<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Core\Helpers;

class Route extends Model
{
    use SoftDeletes;
    use Uuids;

    public $incrementing = false;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = ['from_jetty','to_jetty','ref','km_estimate','note'];

public static function getRoutes()
	{
		
			$types = Operator::pluck('name','id')->toArray();
            return $types;
	}
}
