<?php
namespace App\Commands;
use Amet\Humblee\Bases\BaseConsole;

class Sendmail extends BaseConsole {
	
	protected $description = "send mail ";

	
	protected function boot()
	{

	}

	protected function handle()
	{
		// print_r($this->arguments);
	}
}
