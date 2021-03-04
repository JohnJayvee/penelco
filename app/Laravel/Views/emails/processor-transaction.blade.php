<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Application from </title>

	<style>
		th.primary{
			background-color: #D4EDDA; 
		}
		table, th, td {
		  border-collapse: collapse;
		  padding-left: 20px;
		  padding-right: 20px;
		}

		table.center {
			margin-left:auto; 
			margin-right:auto;
			border-bottom: solid 1px #F0F0F0;
			border-right: solid 1px #F0F0F0;
			border-left: solid 1px #F0F0F0;
		}
		.text-white{
			color:#fff;
		}
		.bold{
			font-weight: bolder;
		}
		.text-blue{
			color: #27437D;
		}
		.text-gray{
			color: #848484;
		}
		.bg-white{
			background-color: #fff;
		}
		hr.new2 {
		  border-top: 3px dashed #848484;
		  border-bottom: none;
		  border-left: none;
		  border-right: none;
		}
		#pageElement{display:flex; flex-wrap: nowrap; align-items: center}
	</style>

</head>
<body style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; margin: 0;">

	<table class="center bg-white" width="55%">
		
			<tr>
				<th colspan="2" class="primary" style="padding: 25px;">
					<div id="pageElement">
						<div style="float: left;color: #000;padding-left: 30px;">Thank You for using &nbsp;</div>
					  	<div style="padding-right: 30px;"> <img src="{{asset('web/img/penelco-logo.png')}}" alt="" style="width: 130px;"> </div>
					</div>
				</th>
			</tr>
		
			<tr>
				<th colspan="2" class="text-gray" style="padding: 10px;">Date: {{Helper::date_only(Carbon::now())}} | {{Helper::time_only(Carbon::now())}}</th>
			</tr>
			<tr>
				<th colspan="2"><p style="float: left;text-align: justify;">Hello {{Str::title($full_name)}}, <p>
					<p style="float: left;text-align: justify;">Good day. We are pleased to inform you that your application has been approved by our processor and is now for payment.</p>
				</th>
			</tr>
			
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Application Name:</th>
				<th style="text-align: right;">{{Str::title($application_name)}}</th>
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Department:</th>
				<th style="text-align: right;">{{Str::title($department_name)}}</th>
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Date:</th>
				<th style="text-align: right;">{{Str::title($created_at)}}</th>
			</tr>
			<tr>
				<th colspan="2" style="border: none;padding-top: 20px;"><hr class="new2"></th>
			</tr>
			<tr>
				<th  style="text-align: left;padding: 10px;"><p>First Payment<p></th>
				<th style="text-align: right;">Processing Fee</th>	
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Payment Reference Number:</th>
				<th style="text-align: right;">{{$ref_num}}</th>
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Amount:</th>
				<th style="text-align: right;">{{$processing_fee}}</th>
			</tr>
			<tr>
				<th colspan="2" style="border: none;padding-top: 20px;"><hr class="new2"></th>
			</tr>
			<tr>
				<th style="text-align: left;padding: 10px;"><p>Second Payment<p></th>
				<th style="text-align: right;">Application Fee</th>	
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Payment Reference Number:</th>
				<th style="text-align: right;">{{$transaction_code}}</th>
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Amount:</th>
				<th style="text-align: right;">{{$amount}}</th>
			</tr>
			<tr>
				<th colspan="2" style="border: none;padding-top: 20px;"><hr class="new2"></th>
			</tr>
			<tr>
				<th colspan="2">
					<p style="float: left;text-align: justify;">Please visit the <a href="{{env('APP_URL')}}">{{env("APP_URL")}}</a> and input the payment reference number to the E-Payment section to pay. This payment reference number will expire at 11:59 PM. You can pay via online(Debit/Credit card, e-wallet, etc.) or over-the-counter (7Eleven, Bayad Center, Cebuana Lhuillier, and to other affiliated partners)</p><br>
					<p>Thank you for choosing Penelco!</p>
				</th>
			</tr>
		
	</table>
	

</body>
</html>