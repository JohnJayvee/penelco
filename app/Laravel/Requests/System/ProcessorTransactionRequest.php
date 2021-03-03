<?php namespace App\Laravel\Requests\System;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class ProcessorTransactionRequest extends RequestManager{

	public function rules(){

		$id = $this->route('id')?:0;
		$file = $this->file('file') ? count($this->file('file')) : 0;
		$rules = [
			'firstname' => "required",
			'lastname' => "required",
			'company_name' => "required",
			'application_id' => "required",
			'account_title_id' => "required",
			'department_id' => "required",
			'processing_fee' => "required",
			/*'regional_id' => "required",*/
			'email' => "required|email",
			'amount' => "required|transaction_amount:application_id,amount",
			'contact_number' => "required|max:10|phone:PH",
			'requirements_id' => "required",
			'hereby_check' =>"required",
    		
		];

		return $rules;
		
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",
			'contact_number.phone' => "Please provide a valid PH mobile number.",
			'numeric' => "Please input a valid amount.",
			'amount.transaction_amount' => ":message",
		];
	}
}