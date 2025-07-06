@extends('layouts.backend')

<style>
.filter-col-box:last-child .filter-seperate{
  display:none;
}
.filters-row{
    display:flex;
    flex-wrap: wrap;
}
</style>
@section('content')
    <div class="content-wrapper" style="/*min-height: 1136.28px;*/">
        <section class="content-header">
            <h1> Employer Profile </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> Home </a>
                </li>
                <li>
                    <a href="{{ route('admin.employers') }}">Users</a>
                </li>
                <li class="active">Employer profile</li>
            </ol>
        </section>
        @php $company = $user->company; @endphp
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            @if ($user->profile_photo_path)
                                <img class="profile-user-img img-responsive img-circle"
                                    src="{{ asset($user->profile_photo_path) }}" alt="Profile picture">
                            @else
                                <img class="profile-user-img img-responsive img-circle"
                                    src="{{ asset('assets/fe/images/profile-pic.png') }}" alt="Profile picture">
                            @endif
                            <h3 class="profile-username text-center">
                                @if (!empty($company->company_name))
                                    {{ ucwords($company->company_name) }}
                                @endif
                            </h3>
                            <p class="text-muted text-center">
                                @if (!empty($user->name))
                                    {{ ucwords($user->name) }}
                                @endif
                            </p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Phone No</b>
                                    <span class="pull-right">
                                        @if (!empty($company->company_phone))
                                            {{ $company->company_phone }}
                                        @endif
                                    </span>
                                </li>

                                <li class="list-group-item">
                                    <b>Email</b>
                                    <span class="pull-right">{{ $company->company_email }}</span>
                                </li>

                                {{-- task - 86a2hkjbf --}}
                                <li class="list-group-item">
                                    <b>Alternate Email</b>
                                    <span class="pull-right">
                                        <span class="alt_email_val">{{ $user->alt_email }}</span>

                                        <input type="email" name="alt_email" id="alt_email" value="{{ $user->alt_email }}" class="alt_email_input" style="display: none;">
                                        <a href="javascript:;" class="edit_email"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:;" class="save_email" style="display: none;"><i class="fa fa-floppy-o"></i></a>
                                        <i class="fa fa-refresh fa-spin" style="display: none;"></i>
                                    </span>

                                </li>
                                {{-- task - 86a2hkjbf end --}}

                                @if ($company->website_url)
                                    <li class="list-group-item">
                                        <b>Website</b>
                                        <a class="pull-right"
                                            href="{{ $company->website_url }}">{{ $company->website_url }}</a>
                                    </li>
                                @endif

                                <li class="list-group-item">
                                    <b>Number Of Employee</b>
                                    <span class="pull-right">{{ $company->number_of_employees }}</span>
                                </li>

                                {{-- task - 86a1hvak1 --}}
                                <li class="list-group-item">
                                    <b>Last login at</b>
                                    <span
                                        class="label label-info pull-right">{{ $user->last_login ? date('m-d-Y h:i A', strtotime($user->last_login)) : 'N/A' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Company Info.</h3>
                        </div>
                        <div class="box-body">
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Address </strong>
                            <p class="text-muted">{{ $company->company_address }}</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#about" data-toggle="tab">About Company</a>
                            </li>
                            <li class="">
                                <a href="#billing" data-toggle="tab" id="billingTabLink">Billing</a>
                            </li>
                            <li class="">
                                <a href="#history" data-toggle="tab">History</a>
                            </li>
                            <li class="">
                                <a href="#saved-search" data-toggle="tab">Saved Search</a>
                            </li>
                        </ul>
                        @if (!empty($user->delete_status->created_at))
                            <div class="alert alert-danger alert-dismissible" style="margin-top:8px;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                                @if (!empty($company->company_name))
                                    <span class="text-bold">
                                        {{ ucwords($company->company_name) }}
                                    </span>
                                @else
                                    This user
                                @endif
                                deactivated their account
                                on {{ $user->delete_status->created_at }}
                                . However, they can still access their account until the next billing cycle
                                @if (!empty($recurring['next_run_date']))
                                    on {{ $recurring['next_run_date'] }}.
                                @else
                                    .
                                @endif

                            </div>
                        @endif
                        <div class="tab-content">
                            <div class="active tab-pane" id="about">
                                <div class="post">
                                    <p> {{ $company->company_description }} </p>
                                    <hr>
                                    <h4>Company Benefits</h4>
                                    <p>
                                        @if ($company->paid_holidays)
                                            <span class="label label-info">Paid Holidays</span>
                                        @endif
                                        @if ($company->insurance_benefits)
                                            <span class="label label-danger">Insurance Benefits</span>
                                        @endif
                                        @if ($company->casual_environment)
                                            <span class="label label-success">Casual Environment</span>
                                        @endif
                                        @if ($company->paid_vacation_days)
                                            <span class="label label-primary">Paid Vacation Days</span>
                                        @endif
                                        @if ($company->professional_environment)
                                            <span class="label label-warning">Professional Environment</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class=" tab-pane" id="billing">
                                <div class="post">
                                    @if (!empty($user->subscriptions[0]))
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Plan</h3>
                                            </div>

                                            {{-- 86a2vc3ej --}}
                                             @if(session()->has('successPlanChange'))
                                            <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                            {{ session()->get('successPlanChange') }}
                                            </div>
                                            @endif

                                          @php
                                            $last_per_user_amount = 0;
                                            $last_total_amount = 0;
                                            $last_plan = '';
                                            $current_plan = '';

                                            if (!empty($lastSubscription['id'])) {
                                                if ($lastSubscription['plan_id'] == 1) {
                                                    if ($lastSubscription->plan_period == 'month') {
                                                        $last_plan = "Employer Monthly";
                                                        $last_per_user_amount = 50;
                                                    } else {
                                                        $last_plan = "Employer Yearly";
                                                        $last_per_user_amount = 479;
                                                    }
                                                } else {
                                                    if ($lastSubscription->plan_period == 'month') {
                                                        $last_plan = "Employer Plus Monthly";
                                                        $last_per_user_amount = 100;
                                                    } else {
                                                        $last_plan = "Employer Plus Yearly";
                                                        $last_per_user_amount = 979;
                                                    }
                                                }
                                                $last_total_amount = ($lastSubscription['plan_amount'] + (($lastSubscription['number_of_users'] - 1) * $last_per_user_amount));
                                            }
                                            if(!empty($user->subscriptions[0]->plan_id)){
                                                if ($user->subscriptions[0]->plan_id == 1) {
                                                    if ($user->subscriptions[0]->plan_period == 'month') {
                                                        $current_plan = "Employer Monthly";
                                                    } else {
                                                        $current_plan = "Employer Yearly";
                                                    }
                                                } else {
                                                    if ($user->subscriptions[0]->plan_period == 'month') {
                                                        $current_plan = "Employer Plus Monthly";
                                                    } else {
                                                        $current_plan = "Employer Plus Yearly";
                                                    }
                                                }
                                            }
                                        @endphp

                                            @if(!empty($last_total_amount))
                                            <div class="alert alert-warning- alert-dismissible purple-banner" style="background-color: #7e50a7; border-color: #7e50a7;color:white;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:white">×</button>
                                            This employer has switched plans from the <span class="text-bold">{{$last_plan }}</span> plan to the <span class="text-bold">{{ $current_plan }}</span> plan. The new plan will take effect on @if(!empty($recurring['next_run_date'])) <span class="text-bold"> {{ $recurring['next_run_date'] }}</span> @endif.
                                            </div>
                                            @endif
                                            <div class="card-body p-0">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Plan</th>
                                                            <th>Month/Year</th>
                                                            <th style="">Price</th>
                                                            @if(!empty($last_total_amount))
                                                            <th style="">Current Payment Total </th>
                                                            @endif
                                                            <th style="">Next Charge</th>
                                                            <th style="">Next Charge On</th>
                                                            @if (!empty($user->subscriptions[0]->number_of_users))
                                                                    <th style="">Number of Allocated Users</th>
                                                                @endif
                                                            <th style="">Status</th>
                                                            @if (!empty($user->delete_status))
                                                                <th style="">Access Until</th>
                                                            @endif
                                                            <th style="">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @if ($user->subscriptions[0]->plan_id == 1)
                                                                <td>Employer</td>
                                                                <td><span
                                                                        class="badge bg-danger">{{ ucwords($user->subscriptions[0]->plan_period) }}</span>
                                                                </td>
                                                                <td><span
                                                                        class="badge bg-danger">${{ $user->subscriptions[0]->per_user_amount }}</span>
                                                                </td>
                                                            @endif
                                                            @if ($user->subscriptions[0]->plan_id == 2)
                                                                <td>Employer Plus</td>

                                                                <td><span
                                                                        class="badge bg-danger">{{ ucwords($user->subscriptions[0]->plan_period) }}</span>
                                                                </td>
                                                                <td><span
                                                                        class="badge bg-danger">${{ $user->subscriptions[0]->per_user_amount }}</span>
                                                                </td>
                                                            @endif
                                                            @if ($user->subscriptions[0]->plan_id == 3)
                                                                <td>RECRUITER PACKAGE</td>
                                                                <td><span
                                                                        class="badge bg-danger">{{ ucwords($user->subscriptions[0]->plan_period) }}</span>
                                                                </td>

                                                                <td><span
                                                                        class="badge bg-danger">${{ $user->subscriptions[0]->per_user_amount }}</span>
                                                                </td>
                                                            @endif
                                                            @if(!empty($last_total_amount))
                                                                <td><span
                                                                        class="badge bg-danger">${{ $last_total_amount }}
                                                                        </span>
                                                                </td>
                                                                @endif

                                                            @if (!empty($recurring))
                                                                <td>
                                                                    @if (empty($user->delete_status))
                                                                        @if ($recurring['active'])
                                                                            ${{ $recurring['amount'] }}
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (empty($user->delete_status))
                                                                        @if ($recurring['active'])
                                                                            {{ $recurring['next_run_date'] }}
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                @if (!empty($user->subscriptions[0]->number_of_users))
                                                                    <td style="">{{ $user->subscriptions[0]->number_of_users }}
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    @if (empty($user->delete_status))
                                                                        @if ($recurring['active'])
                                                                            Active
                                                                        @else
                                                                            Inactive
                                                                        @endif
                                                                    @else
                                                                        Account Deactivated
                                                                    @endif
                                                                </td>
                                                                @if (!empty($user->delete_status))
                                                                    <td style="">{{ $recurring['next_run_date'] }}
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    @if (empty($user->delete_status))
                                                                        @if ($recurring['active'])
                                                                            <a class="btn btn-danger btn-sm"
                                                                                href="{{ url('admin/employers/recurring-off') }}/{{ $recurring['id'] }}">Turn
                                                                                Off</a>
                                                                        @else
                                                                        {{-- 86a2vc3ej --}}
                                                                            {{-- N/A --}}
                                                                        @endif
                                                                    @else
                                                                    {{-- 86a2vc3ej --}}
                                                                        {{-- N/A --}}
                                                                    @endif
                                                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#changePnan">Change Plan</a>
                                                                </td>
                                                            @else
                                                                <td>N/A
                                                                </td>
                                                                <td>N/A
                                                                </td>
                                                                <td>
                                                                    @if (empty($user->delete_status))
                                                                        Inactive
                                                                    @else
                                                                        Account Deactivated
                                                                    @endif
                                                                </td>
                                                                <td> N/A
                                                                </td>
                                                            @endif

                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    @endif
                                    <hr>
                                    @if (!empty($user_inviteds))
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Invited Users</h3>
                                            </div>

                                            <div class="card-body p-0">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th style="">Charge</th>
                                                            <th style="">Invited on</th>
                                                            <th style="">Status</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $per_user_amount = 0;
                                                        if(!empty($user->subscriptions[0]['plan_id'])){
                                                            if ($user->subscriptions[0]['plan_id'] == 1) {
                                                                if ($user->subscriptions[0]->plan_period == 'month') {
                                                                    $per_user_amount = 50;
                                                                } else {
                                                                    $per_user_amount = 479;
                                                                }
                                                            } else {
                                                                if ($user->subscriptions[0]->plan_period == 'month') {
                                                                    $per_user_amount = 100;
                                                                } else {
                                                                    $per_user_amount = 979;
                                                                }
                                                            }
                                                            }
                                                        @endphp
                                                        @foreach ($user_inviteds as $user_invited)

                                                        @if (!$user_invited->deleted_at)
                                                            <tr>
                                                                <td><span class="">{{ $user_invited->name }}</span>
                                                                </td>
                                                                <td><span class="">{{ $user_invited->email }}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="">
                                                                        ${{$per_user_amount}}
                                                                    </span>
                                                                </td>
                                                                <td><span
                                                                        class="">{{ $user_invited->created_at }}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="">
                                                                        @if ($user_invited->deleted_at)
                                                                            Deleted
                                                                        @else
                                                                            @if(!empty($user_invited->invited_user_id))
                                                                                Active
                                                                             @else
                                                                                Pending
                                                                            @endif
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    <hr>
                                    @if (!empty($user->transactions))
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Transactions</h3>
                                            </div>
                                            <div class="card-body p-0">
                                                <table id="example2"
                                                    class="table table-bordered table-hover dataTable dtr-inline"
                                                    aria-describedby="example2_info">
                                                    <thead>
                                                        <tr>
                                                            <th>Transaction Id</th>
                                                            <th>Discount</th>
                                                            <th>Coupon Code</th>
                                                            <th>Tax</th>
                                                            <th>Subtotal</th>
                                                            <th>Total</th>
                                                            <th>Created At</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($user->transactions as $transaction)
                                                            {{-- @if ($transaction->status == 'Approved' || $transaction->status == 'captured') --}}
                                                            <tr>
                                                                <td>{{ $transaction->id }}</td>
                                                                <td>${{ $transaction->discount ? $transaction->discount : 0.0 }}
                                                                </td>
                                                                <td>{{ $transaction->coupon_code ? $transaction->coupon_code : 'N/A' }}</td>
                                                                <td>${{ $transaction->tax ? $transaction->tax : 0.0 }}</td>
                                                                <td>${{ $transaction->subtotal ? $transaction->subtotal : 0.0 }}
                                                                </td>
                                                                <td>${{ $transaction->total ? $transaction->total : 0.0 }}
                                                                </td>
                                                                <td>{{ $transaction->created_dt }}</td>
                                                                <td>{{ $transaction->status }}</td>
                                                            </tr>
                                                            {{-- @endif --}}
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    @endif

                                </div>


                            </div>
                            <div class=" tab-pane" id="history">
                                <div class="post">
                                    @if (!empty($user_inviteds))
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Invited User History</h3>
                                            </div>

                                            <div class="card-body p-0">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            {{-- task - 86a2vy3y6 --}}
                                                            <th style="">Invited on</th>
                                                            <th style="">Deleted on</th>
                                                            <th style="">Status</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($user_inviteds as $user_invited)
                                                            <tr>
                                                                <td><span class="">{{ $user_invited->name }}</span>
                                                                </td>
                                                                <td><span class="">{{ $user_invited->email }}</span>
                                                                </td>
                                                                {{-- task - 86a2vy3y6 --}}
                                                                <td><span
                                                                        class="">{{ $user_invited->created_at }}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="">
                                                                        @if ($user_invited->deleted_at)
                                                                            {{ $user_invited->deleted_at }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span class="">
                                                                        @if ($user_invited->deleted_at)
                                                                            Deleted
                                                                        @else
                                                                            Active
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty($user->subscriptions))
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Subscription Changes</h3>
                                            </div>

                                            <div class="card-body p-0">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Plan</th>
                                                            <th>Monthly/Yearly</th>
                                                            <th style="">Plan Amount</th>
                                                            <th style="">Created On</th>
                                                            <th style="">Status</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($subscriptions as $subscription)
                                                            <tr>
                                                                <td><span class="">
                                                                        @if ($subscription->plan_id == 1)
                                                                            Employer
                                                                        @elseif($subscription->plan_id == 2)
                                                                            Employer Plus
                                                                        @else
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td><span
                                                                        class="">{{ ucwords($subscription->plan_period) }}ly</span>
                                                                </td>
                                                                <td><span
                                                                        class="">{{ $subscription->plan_amount ? '$' : '' }}{{ $subscription->plan_amount }}</span>
                                                                </td>

                                                                <td><span
                                                                        class="">{{ $subscription->created_dt }}</span>
                                                                </td>
                                                                <td>
                                                                    <span class="">
                                                                        @if ($subscription->status)
                                                                            Current Plan
                                                                        @else
                                                                            Past Plan
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class=" tab-pane" id="saved-search">
                                <div class="post">
                                    @if (!empty($savedSearches))
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Invited User History</h3>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Search Name</th>
                                                    <th>Filters</th>
                                                    <th style="">Matched Users</th>
                                                    <th style="">Created On</th>
                                                    <th style="">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($savedSearches as $search)
                                                @php
                                                $field=json_decode($search->search_fields);
                                                @endphp
                                                <tr>
                                                    <td><span class="">{{ $search->name }}</span>
                                                    </td>
                                                    <td>
                                                        <span class=""></span>
                                                        <div class="filters-row">
                                                        @php
                                                        $currentPosition="";
                                                        @endphp
                                                        @if(!empty($field->selectCurrentPosition) && $field->selectCurrentPosition!="null")
                                                        @php
                                                        $currentPosition=$field->selectCurrentPosition;
                                                        @endphp
                                                        @endif
                                                        @if(!empty($currentPosition))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Current Position:</span> {{$currentPosition}} <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $yrsOfExp="";
                                                        @endphp
                                                            @if($field->selectMaxYearOfExperience-$field->selectMinYearOfExperience!=40)
                                                        @php
                                                        $yrsOfExp=$field->selectMinYearOfExperience.' - '. $field->selectMaxYearOfExperience;
                                                        @endphp
                                                        @endif
                                                        @if(!empty($yrsOfExp))
                                                        <div class="col- filter-col-box">
                                                            <span class="filter-type text-bold">Yrs Of Exp:</span> {{$yrsOfExp}} <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $salaryRange="";
                                                        @endphp
                                                        @foreach ($all_salaries as $key => $salary)
                                                        @if(in_array($key,$field->selectSalaryRange))
                                                        @php
                                                        $salaryRange.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($salaryRange))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Salary Range:</span> {{substr($salaryRange, 0, -2)}} <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $compensationType="";
                                                        @endphp
                                                        @foreach ($all_compensations as $key => $compensation)
                                                        @if(in_array($compensation,$field->selectCompensation))
                                                        @php
                                                        $compensationType.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($compensationType))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Compensation Type:</span> {{substr($compensationType, 0, -2)}} <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $distance="";
                                                        @endphp
                                                        @if($field->selectMaxDistance-$field->selectMinDistance!=100)
                                                        @php
                                                        $distance=$field->selectMinDistance.' - '. $field->selectMaxDistance;
                                                        @endphp
                                                        @endif
                                                        @if(!empty($distance))
                                                        <div class="col- filter-col-box">
                                                            <span class="filter-type text-bold">Distance:</span> {{$distance}} miles <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $schedules="";
                                                        @endphp
                                                        @foreach ($all_schedules as $key => $schedule)
                                                        @if(in_array($schedule,$field->selectSchedule))
                                                        @php
                                                        $schedules.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($schedules))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Schedule:</span> {{substr($schedules, 0, -2)}} <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $interests="";
                                                        @endphp
                                                        @foreach ($all_interests as $key => $interest)
                                                        @if(in_array($interest,$field->selectedInterests))
                                                        @php
                                                        $interests.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($interests))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Interests:</span> {{substr($interests, 0, -2)}} <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $industries="";
                                                        @endphp
                                                        @foreach ($all_industries as $key => $ind)
                                                        @if(in_array($ind,$field->selectedIndustries))
                                                        @php
                                                        $industries.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($industries))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Industries:</span> {{substr($industries, 0, -2)}} <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $hardSkills="";
                                                        @endphp
                                                        @foreach ($all_hard_skills as $key => $skill)
                                                        @if(in_array($skill,$field->selectedHardSkills))
                                                        @php
                                                        $hardSkills.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($hardSkills))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Hard Skills:</span> {{substr($hardSkills, 0, -2)}}<span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $softSkills="";
                                                        @endphp
                                                        @foreach ($all_soft_skills as $key => $skill)
                                                        @if(in_array($skill,$field->selectedSoftSkills))
                                                        @php
                                                        $softSkills.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($softSkills))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Soft Skills:</span> {{substr($softSkills, 0, -2)}}<span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $workEnvironment="";
                                                        @endphp
                                                        @foreach ($all_work_environments as $key => $environment)
                                                        @if(in_array($environment,$field->selectWorkEnvironment))
                                                        @php
                                                        $workEnvironment.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($workEnvironment))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Work Setting:</span> {{substr($workEnvironment, 0, -2)}} <span class="filter-seperate">|</span>
                                                        </div>
                                                        @endif
                                                        @php
                                                        $languages="";
                                                        @endphp
                                                        @foreach ($all_languages as $key => $language)
                                                        @if(in_array($language,$field->selectedLanguages))
                                                        @php
                                                        $languages.=$key.', ';
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @if(!empty($languages))
                                                        <div class="col-  filter-col-box">
                                                            <span class="filter-type text-bold">Languages:</span> {{substr($languages, 0, -2)}}
                                                        </div>
                                                        @endif
                                                        </div>
                                                        </span>
                                                    </td>
                                                    <td><span
                                                        class="">{{ count(json_decode($search->synced_users, true)) }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="">
                                                        {{ $search->created_at }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="">
                                                        @if ($search->deleted_at)
                                                        Archived
                                                        @else
                                                        Active
                                                        @endif
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

{{-- 86a2vc3ej --}}
<!-- Modal -->
<div class="modal fade" id="changePnan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="{{ Route('admin.employers.downgrade_plan') }}" method="POST">
  @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="form-group">
          <label for="planSelect">Select Plan:</label>
          <select class="form-control" id="planSelect" name="plan_id">
            <option value="1" @if(count($user->subscriptions)) {{ $user->subscriptions[0]->plan_id=='1' ? 'selected' : '' }} @endif>Employer</option>
            <option value="2" @if(count($user->subscriptions)) {{ $user->subscriptions[0]->plan_id=='2' ? 'selected' : '' }} @endif>Employer Plus</option>
          </select>
        </div>
        <div class="form-group">
          <label for="durationSelect">Select Duration:</label>
          <select class="form-control" id="durationSelect" name="plan_period">
            <option value="month" @if(count($user->subscriptions)) {{ $user->subscriptions[0]->plan_period=='month' ? 'selected' : '' }} @endif>Monthly</option>
            <option value="year" @if(count($user->subscriptions)) {{ $user->subscriptions[0]->plan_period=='year' ? 'selected' : '' }} @endif>Yearly</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
    </form>
  </div>
</div>
    </div>
    <script>
        // task - 86a2hkjbf
        $('.edit_email').on('click', function () {
            $('.alt_email_val').hide();
            $('#alt_email, .save_email').show();
            $(this).hide();
        });

        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        $('.save_email').on('click', function () {
            if(regex.test($('#alt_email').val())) {
                $(this).hide();
                $('.fa-spin').show();
                var _alt_email = $('#alt_email').val();
                $.ajax({
                    url: '{{ url('admin/employers/upsert_email/'.$user->id) }}',
                    type: 'POST',
                    dataType: 'html',
                    data: { email: _alt_email, "_token": "{{ csrf_token() }}" },
                    success: function(res) {
                        $('.alt_email_val, .edit_email').show();
                        $('#alt_email').hide();
                        $('.fa-spin').hide();
                        $('.save_email').hide();
                        $('.alt_email_val').text(_alt_email);
                        $('#alt_email').val(_alt_email);
                    }
                });
            } else {
                $('#alt_email').val('');
                alert('Please enter valid email address.');
            }
        });
        // task - 86a2hkjbf end
    </script>
{{-- 86a2vc3ej --}}
     @if(session()->has('successPlanChange'))
        <script>
        $(document).ready(function() {
        $('#billingTabLink').click();
        });
        </script>
     @endif
@endsection
