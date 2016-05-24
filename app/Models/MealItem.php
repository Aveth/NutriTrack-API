<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealItem extends Model {
    
    protected $fillable = ['food_id', 'quantity', 'measure_idx'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function meal() {
        return $this->belongsTo('App\Meal')->withTimestamps();
    }
    
    public function fetchFoodName() {
        $this->name = \DB::table('searches')->where('id', $this->food_id)->pluck('name');
    }
    
}