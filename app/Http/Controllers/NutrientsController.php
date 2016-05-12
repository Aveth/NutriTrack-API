<?php namespace App\Http\Controllers;

use Response;
use App\User;
use App\Nutrient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NutrientsController extends Controller {
    
    public function view($token) {
        $user = User::authenticateToken($token);
        if ( $user ) {
            return $this->response($user->nutrients);
        }
        return $this->errorResponse([
            $this->getError('err_invalid_token', 'The login token provided is invalid')
        ], 401);
    }
    
    public function edit(Request $request, $token) {
        $nutrients = $request->input('nutrients') ? explode(',', $request->input('nutrients')) : [];
        $invalid = Nutrient::findInvalid($nutrients);
        if ( !empty($invalid) ) {
            return $this->errorResponse([
                $this->getError('err_invalid_data', 'The following nutrient ids are invalid: '.implode(', ', $invalid))
            ], 400);
        }
        $user = User::authenticateToken($token);
        if ( $user ) {
            $user->nutrients()->sync($nutrients);
           return $this->response();
        }
        return $this->errorResponse([
            $this->getError('err_invalid_token', 'The login token provided is invalid')
        ], 401);
    }
    
}