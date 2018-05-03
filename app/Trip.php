<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Core\Helpers;

class Trip extends Model
{
    
    use Uuids;

    public $incrementing = false;

    protected $dates = [ 'created_at', 'updated_at'];

    protected $fillable = ['boat_id','creator','depature_time','from_jetty','to_jetty','depature_type'];

    public function trip_staff(){
        return $this->hasMany('\App\Trip_staff', 'trip_id', 'id');
    }
	public function trip_passenger(){
        return $this->hasMany('\App\Trip_passenger', 'trip_id', 'id');
    }
}
