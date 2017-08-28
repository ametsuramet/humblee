<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\Employee;
use Amet\Humblee\Bases\ArrayCollection as Collection;

class SampleController extends BaseController{

	public function index()
	{
		global $executionStartTime;
		$message = "Hello Suprb-Dev";
		$rq =  http_get('http://localhost:8000/api/v1/transactions',[],[
			'headers' => [
					'token' => session('token'),
					'company-id' => '59a36434f826a053d455fb82'
				],
			]);
		if ($rq->info->http_code == 200) {
			print_r($rq->decoded_response);
			
		}
		// return view('sample',compact('message'));
	}	

	public function auth_user()
	{
		global $executionStartTime; 
		
		$message = "Hello Auth User";
		return view('sample',compact('message'));
	}

}
