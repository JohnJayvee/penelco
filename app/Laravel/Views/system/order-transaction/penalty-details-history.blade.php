<div class="card mt-2">
  <div class="card-body text-center">
    <h5 class="text-blue fs-15 m-2 float-left">Penalty Details History</h5>
    <div class="shadow-sm fs-15 table-responsive">
      <table class="table table-striped table-wrap">
        <thead>
          <tr class="text-center">
            <th class="text-title p-3">Bill Month</th>
            <th class="text-title p-3">Due Date</th>
            <th class="text-title p-3">Amount</th>
            <th class="text-title p-3">Date of Payment</th>
            <th class="text-title p-3">Penalty Charge</th>
            <th class="text-title p-3">Total Amount</th>
          </tr>
        </thead>
        <tbody>
          @forelse($partial_payments as $partial_payment)
            <tr class="text-center">
              <td>{{ Helper::date_only($partial_payment->bill_month) }}</td>
              <td>{{ Helper::date_only($partial_payment->due_date) }}</td>
              <td>{{ Helper::money_format($partial_payment->amount) }}</td>
              <td>{{ Helper::date_only(Carbon::now()) }}</td>
              <td>{{ Helper::money_format(100) }} </td>
              <td>{{ Helper::money_format(100 + $partial_payment->amount) }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center"><i>No Order transaction Records
                  Available.</i></td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
