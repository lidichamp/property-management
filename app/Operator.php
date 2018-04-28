<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use Uuids;

    public $incrementing = false;
    protected $dates = ['created_at', 'updated_at'];


    protected $fillable = ['name','cac','registered_name','registration_date','active'];
	
	public static function getOperatorByType($type){
        $types = Operator::pluck('name','id');;
        if($type=2){
            return $types[$type];
        }
        return [1=>"Laswa"];
    }
}
