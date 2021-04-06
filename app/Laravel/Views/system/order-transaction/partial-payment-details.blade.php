<div class="card mt-2">
  <div class="card-body text-center">
    <h5 class="text-blue fs-15 m-2 float-left">Partial Payment Details</h5>
    <div class="shadow-sm fs-15 table-responsive">
      <table class="table table-striped table-wrap">
        <thead>
          <tr class="text-center">
            <th class="text-title p-3">Request Date</th>
            <th class="text-title p-3">Bill Month</th>
            <th class="text-title p-3">Total Amount</th>
            <th class="text-title p-3">Partial Amount</th>
            <th class="text-title p-3">Status</th>
            <th class="text-title p-3">Remarks</th>
          </tr>
        </thead>
        <tbody>
          @forelse($partial_payments as $partial_payment)
            <tr class="text-center">
              <td>{{ Helper::date_only($partial_payment->request_date) }}
              </td>
              <td>{{ Helper::date_only($partial_payment->bill_month) }}
              </td>
              <td>{{ Helper::money_format($partial_payment->amount) }}
              </td>
              <td>{{ Helper::money_format($partial_payment->partial_amount) }}
                <br> <span
                  class="badge badge-{{ Helper::status_badge(Helper::get_partial_status($partial_payment->id)) }} p-2">{{ Helper::get_partial_status($partial_payment->id) }}</span>
              </td>
              <td>
                <div><small><span
                      class="badge badge-pill badge-{{ Helper::status_badge($partial_payment->partial_status) }} p-2">{{ Str::upper($partial_payment->partial_status) }}</span></small>
                </div>
                <br>
                <p>{{ Helper::date_format($partial_payment->process_date) }}
                </p>
              </td>
              <td>{{ $partial_payment->remarks ?: '----' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center"><i>No Order
                  transaction Records Available.</i></td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
