<?php namespace App\Http\Controllers;

use Response;
use App\User;
use App\Nutrient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller {
    
    public function profile($token) {
        $user = User::authenticateToken($token);
        if ( $user ) {
            return $this->response(['email' => $user->email]);
        }
        return $this->errorResponse([
            $this->getError('err_invalid_token', 'The login token provided is invalid')
        ], 401);
    }
    
    public function authenticate(Request $request) {
        $user = User::authenticateLogin($request->input('email'), $request->input('password'));
        if ( $user ) {
            $token = $user->getRememberToken();
            return $this->response(['token' => $token]);
        } 
        return $this->errorResponse([
            $this->getError('err_invalid_credentials', 'The username and password combination is incorrect')
        ], 401);
    }
    
    public function register(Request $request) {
        $user = new User($request->all());
        if ( $user->validate() )  {
            $id = $user->generateRandomId();
            $user->hashPassword();
            $user->save();
            return $this->response(['id' => $id]);
        }
        return $this->errorResponse($user->getErrors(), 400);
    }
    
}