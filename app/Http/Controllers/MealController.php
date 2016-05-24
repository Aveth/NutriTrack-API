<?php namespace App\Http\Controllers;

use Response;
use App\Models\User;
use App\Models\Nutrient;
use App\Models\Meal;
use App\Models\MealItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MealController extends Controller {
    
    public function view($token) {
        $user = User::authenticateToken($token);
        if ( $user ) {
            $meals = $user->meals()->orderBy('eaten_at', 'desc')->get();
            foreach ( $meals as $meal ) {
                foreach ( $meal->mealItems as $mealItem ) {
                    $mealItem->fetchFoodName();
                }
            }
            return $this->response($meals);
        }
        return $this->errorResponse([
            $this->getError('err_invalid_token', 'The login token provided is invalid')
        ], 401);
    }
    
    public function add(Request $request, $token) {
        $user = User::authenticateToken($token);
        if ( $user ) {
            $mealItems = $request->input('meal_items');
            if ( empty($mealItems) ) {
                return $this->errorResponse([
                    $this->getError('err_invalid_data', 'There must be at least 1 meal item in a meal')
                ], 400);
            }
            $meal = new Meal(['eaten_at' => $request->input('eaten_at')]);
            $user->meals()->save($meal);
            foreach ( $mealItems as $item ) {
                $mealItem = new MealItem([
                    'food_id' => $item['food_id'],
                    'quantity' => $item['quantity'],
                    'measure_idx' => $item['measure_idx']
                ]);
                $meal->mealItems()->save($mealItem);
            }
            return $this->response();
            
        }
        return $this->errorResponse([
            $this->getError('err_invalid_token', 'The login token provided is invalid')
        ], 401);
    }
    
    public function edit(Request $request, $token) {
        $user = User::authenticateToken($token);
        if ( $user ) {
        
        }
    }

}