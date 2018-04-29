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
       
        if($type==1){
			static::getOperators();
        }
		elseif($type==2){
			$types = Operator::where('name','laswa')->pluck('name','id')->toArray();
			return $types;
    }
	else{
		return "Invalid";
	}
}
	public static function getOperators()
	{
		
			$types = Operator::pluck('name','id')->toArray();
            return $types;
	}
}
