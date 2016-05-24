<?php namespace App\Models;

use App\ValidatingModel;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends ValidatingModel implements Authenticatable { 

	protected static $rules = [
		'email' => 'required|email|unique:users',
		'password' => 'required|min:5'
	];
	protected $fillable = ['email', 'password', 'remember_token'];
	protected $hidden = ['password', 'created_at', 'updated_at'];
	
	public function nutrients() {
		return $this->belongsToMany('App\Nutrient', 'user_nutrients')->withTimestamps();
	}
	
	public function meals() {
		return $this->hasMany('App\Meal');
	}
	
	public function getRememberToken() {
		if ( !$this->remember_token ) {
			$this->remember_token = md5(uniqid().rand().microtime());
			$this->setRememberToken($this->remember_token);
		}
		return $this->remember_token;
	}
	
	public function setRememberToken($value) {
		$this->remember_token = $value;
		\DB::table('users')->where('id', $this->id)->update(['remember_token' => $value]);
	}
	
	public function getRememberTokenName() {
		return 'remember_token';
	}
	
	public function getAuthIdentifier() {
		return $this->id;
	}
	
	public function getAuthPassword() {
		return $this->password;
	}
	
	public function hashPassword() {
		$this->password = \Hash::make($this->password);
		return $this->password;
	}
	
	public function generateRandomId() {
		while ( true ) {
			$id = uniqid();
			if ( !User::find($id) ) {
				$user->id = $id;
				return $id;
			}
		}
	}
	
	public static function authenticateLogin($email, $password) {
		$passed = \Auth::validate([
           'email' => $email,
           'password' => $password
        ]);
		return $passed ? User::where(['email' => $email])->first() : false;
	}
	
	public static function authenticateToken($token) {
		$user = static::where('remember_token', $token)->first();
		return isset($user) ? $user : false;
	}

}
