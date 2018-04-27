<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jetty extends Model
{
    use SoftDeletes;
    use Uuids;
	//use Ratings;
	public static $PRIVATE = 1;
    public static $PUBLIC = 2;
    public $incrementing = false;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = ['name', 'address', 'latitude', 'longitude','operator','jetty_type'];
	protected $geofields = array('location');
    public static function getName($id){
        $jetty = Jetty::find($id);
        if($jetty){
            return $jetty->name;
        }
        return 'NOT ASSIGNED';
    }
	public function setLocationAttribute($value) {
        $this->attributes['location'] = DB::raw("POINT($value)");
    }
	public static function getJetty(){
        $jetties = Jetty::pluck('name','id');
		return $jetties;
    }
    public function getLocationAttribute($value){

        $loc =  substr($value, 6);
        $loc = preg_replace('/[ ,]+/', ',', $loc, 1);

        return substr($loc,0,-1);
    }
	public static function getTypes(){
        return [
            1=>'PRIVATE',
            2=>'PUBLIC'
        ];
    }

    public static function getTypeName($type){
        $types = static::getTypes();
        if(array_key_exists($type, $types)){
            return $types[$type];
        }
        return 'INVALID';
    }
	
}
