<?php 
namespace App\Laravel\Events;

use Illuminate\Queue\SerializesModels;
use Mail,Str,Helper,Carbon;

class SendPartialRequestEmail extends Event {


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
			$mailname = "Partial Payment Request Details";
			$user_email = $value['email'];
			$this->data['full_name'] = $value['full_name'];
			$this->data['ref_num'] = $value['ref_num'];
			$this->data['account_number'] = $value['account_number'];
			$this->data['total_amount'] = $value['total_amount'];
			$this->data['partial_amount'] = $value['partial_amount'];
			$this->data['bill_month'] = $value['bill_month'];
			$this->data['due_date'] = $value['due_date'];
			$this->data['contact_number'] = $value['contact_number'];
			$this->data['remarks'] = $value['remarks'];
			$type = $value['type'];
			
			if ($type == "approved") {
				Mail::send('emails.partial-approved', $this->data, function($message) use ($mailname,$user_email){
					$message->from('eotcph-noreply@ziaplex.biz');
					$message->to($user_email);
					$message->subject("Partial Payment Request Details");
				});
			}
			if ($type == "declined") {
				Mail::send('emails.partial-declined', $this->data, function($message) use ($mailname,$user_email){
					$message->from('eotcph-noreply@ziaplex.biz');
					$message->to($user_email);
					$message->subject("Partial Payment Request Details");
				});
			}
		}


		
		
		
	}
}
