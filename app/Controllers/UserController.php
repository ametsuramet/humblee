<?php
namespace App\Controllers;

class UserController extends BaseController{

	public function index()
	{
		$data = (new User)->paginate(10);
		$return = [
			'success' => true,
			'message' => "Data User Retrieved",
			'data' => $data,
		];
		response($return);
	}

}