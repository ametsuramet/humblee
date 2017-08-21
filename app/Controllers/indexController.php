<?php
namespace App\Controllers;

class IndexController extends BaseController{

	public function index()
	{
		$limit = (int) request()->query->get('limit',100);
		$data = db()->select()
               ->from('employees')
               ->limit($limit)->execute()->fetchAll();
		response($data);
	}

}