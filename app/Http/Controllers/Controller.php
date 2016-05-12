<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
	
	public function response($data = [], $status = 200) {
		return \Response::json([
			'data' => $data
		], $status)->header('Access-Control-Allow-Origin', '*');
	}
	
	public function errorResponse($errors = [], $status = 500) {
		return \Response::json([
			'errors' => $errors
		], $status)->header('Access-Control-Allow-Origin', '*');
	}
	
	public function getError($code, $message) {
		return [
			'code' => $code,
			'message' => $message
		];
	}

}
