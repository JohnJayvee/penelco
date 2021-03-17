<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		<thead>
			<tr align="center">
				<td>Bill Month</td>
				<td>Account Number</td>
				<td>Transaction Code</td>
				<td>Account Name</td>
				<td>Due Date</td>
				<td>Amount</td>
				<td>Status</td>

			</tr>
		</thead>
		<tbody>
			@forelse($bills as $bill)
				<tr align="center">
					<td>{{ Helper::date_only($bill->bill_month)}}</td>
		            <td>{{$bill->account_number}}</td>
		            <td>{{Helper::get_transaction_number($bill->id)}}</td>
		            <td>{{$bill->account_name}} </td>
		            <td>{{ Helper::date_only($bill->due_date)}}</td>
		            <td>{{Helper::money_format($bill->amount ?: 0)}}</td>
		            <td>{{Str::title($bill->payment_status)}}</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
</body>
</html>