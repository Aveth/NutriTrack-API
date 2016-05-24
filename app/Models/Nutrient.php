<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nutrient extends Model {

	protected $fillable = ['id', 'name', 'unit'];
	protected $hidden = ['created_at', 'updated_at', 'is_active'];
	
	public function users() {
		return $this->belongsToMany('App\User', 'user_nutrients')->withTimestamps();
	}
	
	public static function getActive() {
		return static::where('is_active', true)->get();
	}

	public static function findInvalid($ids = []) {
		$invalid = [];
		foreach ( $ids as $id ) {
			if ( !static::where(['id' => $id, 'is_active' => true])->first() ) {
				$invalid[] = $id;
			}
		}
		return $invalid;
	}

}
