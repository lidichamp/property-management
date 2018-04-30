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

    protected $fillable = ['boat_id','departure_time','from_jetty','to_jetty','departure_type'];


}
