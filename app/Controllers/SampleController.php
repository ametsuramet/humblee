<?php
namespace App\Controllers;

class SampleController extends BaseController{

	public function index()
	{
		$message = "Hello Suprb-Dev";
		return view('sample',compact('message'));
	}
}
