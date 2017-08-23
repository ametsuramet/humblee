<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Employee;

class SampleController extends BaseController{

	public function index()
	{
		global $executionStartTime; 
		
		$message = "Hello Suprb-Dev";
		return view('sample',compact('message'));
	}	

	public function auth_user()
	{
		global $executionStartTime; 
		
		$message = "Hello Auth User";
		return view('sample',compact('message'));
	}

}
