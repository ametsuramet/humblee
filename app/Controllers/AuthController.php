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

	public function login()
	{
		$flash = flash('message');
		$message = $flash ? $flash['message'] : null;
		$email = $flash ? $flash['old']['email'] : null;
		
		view('login',compact('message','email'));
	}

	public function postLogin()
	{
		try {
			$request = request()->request->all();
			$auth = new Auth;
			$auth->Attempt($request);
		} catch (\Exception $e) {
			backWithInput($e->getMessage(),$request);
		}
	}

	public function logout()
	{
		// echo "string";die();
		kill_session();
	}

}