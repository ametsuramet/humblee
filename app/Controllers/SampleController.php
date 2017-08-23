<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Employee;

class SampleController extends BaseController{

	public function index()
	{
		global $executionStartTime; 
		
		$message = "Hello Suprb-Dev";
		return view('sample',compact('message','exc_time'));
	}

	

	public function profile($id)
	{
		$data = (new User)->find($id);
		$return = [
			'success' => true,
			'message' => "Data User Retrieved",
			'data' => $data,
		];
		response($return);
	}

	public function employee()
	{
		global $executionStartTime; 
		global $executionEndTime; 

		
		$data = (new Employee)->limit(10000)->get();
 		
		//The result will be in seconds and milliseconds.
		$seconds = microtime(true) - $executionStartTime;

		
		// $return = [
		// 	'success' => true,
		// 	'message' => "This script took $seconds to execute.",
		// 	'data' => $data,
		// ];
		// response($return);

		// //Print it out
		$runtime = "This script took $seconds to execute.";
		return view('employee',compact('data','runtime'));
	}
}
