<?php
namespace App\Controllers;

class IndexController extends BaseController{

	public function index()
	{
		$limit = (int) request()->query->get('limit',100);
		// print_r($limit);
		$data = db()->select()
               ->from('employees')
               ->limit($limit)->execute()->fetchAll();
		response(json_encode($data));
	}
	public function users()
	{
		$limit = (int) request()->query->get('limit',100);
		// print_r($limit);
		$data = db()->select()
               ->from('departments')
               ->limit($limit)->execute()->fetchAll();
		// response(json_encode($data));
        return view('hello',compact('data'));
	}
}