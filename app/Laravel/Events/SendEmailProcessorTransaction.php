<?php 
namespace App\Laravel\Events;

use Illuminate\Queue\SerializesModels;
use Mail,Str,Helper,Carbon;

class SendEmailProcessorTransaction extends Event {


	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(array $form_data)
	{
		$this->data = $form_data;
		// $this->email = $form_data['insert'];

	

	}

	public function job(){	
		
		
		foreach($this->data as $index =>$value){
			$mailname = "Application Details";
			$user_email = $value['email'];
			$this->data['full_name'] = $value['full_name'];
			$this->data['application_name'] = $value['application_name'];
			$this->data['department_name'] = $value['department_name'];

			$this->data['ref_num'] = $value['ref_num'];
			$this->data['amount'] = $value['amount'];

			$this->data['transaction_code'] = $value['transaction_code'];
			$this->data['processing_fee'] = $value['processing_fee'];

			$this->data['created_at'] = $value['created_at'];
			
			$this->data['link'] = env("APP_URL");


			Mail::send('emails.processor-transaction', $this->data, function($message) use ($mailname,$user_email){
				$message->from('eotcph-noreply@ziaplex.biz');
				$message->to($user_email);
				$message->subject("Application Details");
			});
		}


		
		
		
	}
}
