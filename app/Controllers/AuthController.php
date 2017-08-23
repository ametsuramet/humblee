<?php
namespace App\Controllers;

use Amet\Humblee\Bases\Authentication as Auth;
class AuthController extends BaseController{

	public function login_api()
	{
		try {
			$request = request()->request->all();
			$auth = new Auth;
			$token = $auth->ApiAttempt($request);
			$data = [
				"success" => true,
				"message" => "Loggin succeed",
				"token" => $token
			];
			response($data);
		} catch (\Exception $e) {
			
			$data = [
				"success" => false,
				"message" => $e->getMessage()
			];
			response($data,403);
		}
		
	}

}