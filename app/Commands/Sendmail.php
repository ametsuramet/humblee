<?php
namespace App\Commands;
use Amet\Humblee\Bases\BaseConsole;
use Amet\Humblee\Bases\Mail;
class Sendmail extends BaseConsole {
	
	protected $description = "send mail";


	protected function boot()
	{

	}

	protected function handle()
	{
		try {
			$mail = new Mail($this->arguments['subject']);
			$mail->to($this->arguments['email'],$this->arguments['to']);
			$mail->message($this->arguments['message']);
			if (isset($this->arguments['attach'])) {
				$mail->attach($this->arguments['attach']);
			}
			if (isset($this->arguments['type'])) {
				$mail->type($this->arguments['type']);
			}
			$mail->send();
			$this->info("Sendmail to :".$this->arguments['to']."(".$this->arguments['email'].") succeed");
		} catch (\Exception $e) {
			$this->alert($e->getMessage());
		}
		
	}
}
