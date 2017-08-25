<?php

namespace App\Mongo;
use Amet\Humblee\Bases\BaseMongoModel;

class Employee extends BaseMongoModel {
	protected $collection = "employees";
}