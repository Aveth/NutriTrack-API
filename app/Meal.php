<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model {
    
    protected $fillable = ['eaten_at'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function user() {
        return $this->belongsTo('App\User')->withTimestamps();
    }
    
    public function mealItems() {
        return $this->hasMany('App\MealItem');
    }
    
}