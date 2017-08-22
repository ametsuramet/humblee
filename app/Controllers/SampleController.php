<?php
namespace App\Controllers;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class SampleController extends BaseController{

	public function index()
	{
		$message = "Hello Suprb-Dev";
		return view('sample',compact('message'));
	}

	public function users()
	{
		$data = (new User)->paginate(4);
		$return = [
			'success' => true,
			'message' => "Data User Retrieved",
			'data' => $data,
		];
		response($return);
	}
}
