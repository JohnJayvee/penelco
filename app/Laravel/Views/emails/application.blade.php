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
				<th colspan="2"><p style="float: left;text-align: justify;">Dear {{Str::title($full_name)}}, <p>
					<p style="float: left;text-align: justify;">Good day. You received this message because you have checked the 'Physical Submission' checkbox. Please download and print the attached file and paste it to your physical documents and send it to our office to continue your application.</p>
				</th>
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Reference Number:</th>
				<th style="text-align: right;">{{$ref_num}}</th>
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Application Name:</th>
				<th style="text-align: right;">{{Str::title($application_name)}}</th>
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Department Name:</th>
				<th style="text-align: right;">{{Str::title($department_name)}}</th>
			</tr>
			<tr class="text-blue">
				<th style="text-align: left;padding: 10px;">Date:</th>
				<th style="text-align: right;">{{$created_at}}</th>
			</tr>
			
			<tr>
				<th colspan="2">
					<p><a href="{{$link}}">Please click this link to download your reference number</a></p>
					<p>Thank you for choosing DTI Online Pay!</p>
				</th>
			</tr>
		
	</table>
	

</body>
</html>