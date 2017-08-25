<?php
namespace App\Controllers;
use App\Models\User;
use App\Mongo\Employee;

class UserController extends BaseController{

	public function index()
	{
		$data = (new User)->limit(100000)->get();
		$return = [
			'success' => true,
			'message' => "Data User Retrieved",
			'data' => $data,
		];
		response($return);
	}

	public function employee()
	{
		$data = (new Employee)->find([],[
				"limit" => 100000
			]);

		$return = [
			'success' => true,
			'message' => "Data User Retrieved",
			'data' => $data,
		];
		response($return);
	}



}