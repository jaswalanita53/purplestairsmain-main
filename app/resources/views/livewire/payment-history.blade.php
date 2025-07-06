<div>
    <style>
        body {
            font-family: "Poppins";
        }

        .custom-tbl-1s {
            background-color: #f0f0f0;
            border: unset !important;
        }

        .custom-tbl-1sth {
            background-color: #f0f0f0;
            border: unset !important;
            font-family: "Poppins";
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 21px;
        }

        td {
            font-family: "Poppins";
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
        }
        .table td {
        padding: 1.2rem 0.5rem !important;
        font-family: "Poppins" !important;
        font-style: normal !important;
        font-weight: 400 !important;
        font-size: 16px !important;
        line-height: 24px !important;
        /* identical to box height */
    }

    .custom-tbl-1s th {
        background: #f7f4ff !important;
        border: 1px solid #f0f0f0 !important;
        padding: 10px !important;
    }
    .custom-tbl-2 th {
        border-bottom-color: #e9e9e9 !important;
        background: var(--grey12) !important;
        font-family: "Poppins" !important;
        font-style: normal !important;
        font-weight: 400 !important;
        font-size: 14px !important;
        line-height: 21px !important;
        border-bottom: 1px solid #e9e9e9;
        /* identical to box height */

        text-transform: capitalize !important;

        color: #383838 !important;
    }
    .custom-tbl-2 {
        border: unset !important;
    }
    </style>

<!-- bootstrap cdn -->
    <div class="mid-contain subscription">
        <div class="container-fluid">
            <div class="main-body container-fluid">
                <div class="main-body-upper">
                    <h2 class="mt-0 mb-5 second-h-plan">Payment History</h2>
                    <div class="row mt-4 mb-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="custom-tb-head custom-tbl-1s">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Transaction Amount</th>
                                        <th scope="col">Number Of Users</th>
                                        <th scope="col">Subscription Plan</th>
                                        <th scope="col">Card Number</th>
                                    </tr>
                                </thead>
                                <tbody class="tbl-body">
                                    @if($payments)
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ date('m/d/Y', strtotime($payment->created_dt)) }}</td>
                                                <td>${{ number_format(($payment->total - $payment->discount), 2) }} {{$payment->transaction_id > 0 ? '' : '(Processing...)'}}
                                                </td>
                                                <td>{{ $payment->subscription->number_of_users }}</td>
                                                <td>{{ $payment->subscription->plan_id == 1 ? 'Basic' : 'Plus' }}/{{ ucfirst($payment->subscription->plan_period) }}ly</td>
                                                <td>{{$payment->card_number}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @php $pay_counts = $payments->toArray(); @endphp
                                        {{ $pay_counts['last_page'] }}
                                        {{ $pay_counts['data'] }}
                                        @if($pay_counts['last_page'] == 1 && empty($pay_counts['data']))
                                        <tr>
                                            <td colspan="4">No data found.</td>
                                        </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-div">
                            {{ $payments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>