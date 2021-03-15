<?php 
namespace App\Laravel\Listeners;

use App\Laravel\Events\SendPartialRequestEmail;

class SendPartialRequestListener{

	public function handle(SendPartialRequestEmail $email){
		$email->job();

	}
}