<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Core\Helpers;

class Routes_boat extends Model
{
    use SoftDeletes;
    use Uuids;

    public $incrementing = false;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = ['route_id','boat_id'];


}
