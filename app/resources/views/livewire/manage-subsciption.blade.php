<div>
    <style>
    body {
        font-family: "Poppins";
    }

    #nou-form .form-group .form-control {
        padding: 0 35px 0 35px !important;
    }

    .card-title-bold {
        font-weight: 600;
        font-size: 24px;
        line-height: 55px;
        /* identical to box height, or 229% */

        text-align: center;

        color: #1a1a1a;
    }

    .payment-info {
        font-weight: 600;
        font-size: 24px;
        line-height: 55px;
        color: #1a1a1a;
    }

    .active-plan .yellow-text {
        font-size: 35px;
        color: rgb(255, 174, 26);
        font-weight: 700;
    }

    .seat-box .yellow-text {
        font-size: 25px;
        color: rgb(255, 174, 26);
        font-weight: 700;
    }

    .form-check .form-check-input {
        float: unset !important;
        margin: 4px 5px;
    }

    .form-check-input:checked {
        background-color: #7e50a7;
        border-color: #7e50a7;
    }

    .form-check-input:focus {
        border-color: #7e50a7;
        outline: 0;
        box-shadow: unset !important;
    }

    .active-plan .fa.text-success {
        color: #80c597 !important;
        font-size: 14px;
    }
    .key-point-bold .fa.text-success {
        font-weight: 700;
        font-size: 23px;
    }

    .key-points {
        font-size: 14px;
        line-height: 21px;

        color: #8f8f8f;
        text-align: left;
    }

    .key-point-bold {
        font-weight: 700;
        font-size: 17px;
        line-height: 21px;
    }
    .key-point-bold .fa{
        font-size: 23px;
    }

    .text-muted-light * {
        color: #c9c9c9 !important;
    }

    .subscription-plan .card {
        border-radius: 22px;
    }

    .custom-outline-btn {
        background: #d9d8d6 !important;
        color: #484545 !important;
        border-radius: 25px !important;
        border: none;
        font-size: 14px;
        font-weight: 600;
        /* padding: 10px; */
    }

    .inactive-plan-btn {
        background: rgba(56, 56, 56, 0.08) !important;
        opacity: 0.7 !important;
        border-radius: 35px !important;
        font-size: 14px;
        line-height: 21px;
        /* identical to box height */

        text-align: center !important;
        text-transform: capitalize !important;

        color: #383838 !important;
        border: none !important;
        padding: 10px 38px;

        /* padding: 10px; */
    }

    .inactive-plan-btn.active, .inactive-plan-btn:hover {
        background: #7e50a7 !important;
        color: #fff !important;
        opacity: 1 !important;
    }

    .active-plan .card-header {
        color: #7e50a7;
        background-color: #e1c5fb87;
        border-top-left-radius: 22px;
        border-top-right-radius: 22px;
    }
.custom-btn-danger:hover{
    color: #f9595f !important;
    background-color: #fff !important;
    outline: 1px solid #f9595f !important;
}
    .custom-btn-danger {
        background: #f9595f !important;
        border-radius: 35px !important;
        font-size: 14px;
        line-height: 21px;
        font-family: "Poppins";
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 21px;
        /* identical to box height */

        text-align: center;
        text-transform: capitalize;

        color: #ffffff;
        /* identical to box height */

        text-align: center !important;
        text-transform: capitalize !important;

        color: white !important;
        border: none !important;
        padding: 10px 38px;
        float: left;
        /* padding: 10px; */
    }

    .chair {
        position: relative;
        left: 25px;
        bottom: 50.17%;
    }

    .seat-box {
        border-right: 1px solid gray;
        height: fit-content;
        height: 5.5em;
    }

    .btn-purple {
        float: right;
        font-size: 14px;
        background: unset !important;
        color: #7e50a7 !important;
        border: 1px solid #7e50a7 !important;
    }

    .btn-purple-bg {
        float: right;
        font-size: 14px;
        background: #7e50a7 !important;
        color: white !important;
        border: 1px solid #7e50a7 !important;
        max-width: fit-content;
    }

    .btn-invite {
        font-size: 14px;
        background: #7e50a7 !important;
        color: white !important;
        border: 1px solid #7e50a7 !important;
        padding: 6px 6px;
        width: 100%;
    }

    .btn-purple-bg i {
        font-size: 22px;
        margin-left: 10px;
        vertical-align: middle;
        padding: 2px;
    }

    .btn-purple i {
        font-size: 22px;
        margin-left: 10px;
        vertical-align: middle;
        padding: 2px;
    }

    .card-info {
        box-sizing: border-box;

        border: 1px solid #00000029;
        border-radius: 35px;
        padding: 10px;
    }

    .card-num {
        /* margin-right: 10px; */
        font-family: "Poppins";
        font-style: normal;
        font-weight: 400;
        font-size: 20px;
        line-height: 30px;
        /* identical to box height */
        opacity: 1 !important;

        color: #8f8f8f;
    }

    .card-num i {
        background: #80808040;
        border-radius: 50%;
        padding: 10px 12px;
        font-size: 14px;
        cursor: pointer;
    }

    .delete-icon-info {
        float: right !important;
    }

    .custom-check .form-check-input {
        border-radius: 45%;
    }

    .custom-check .form-check-label {
        color: #7e50a7;
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

    .color-primary {
        color: #7e50a7;
    }

    .active-plan .outer-card {
        border: none;
        box-shadow: 0px 65px 65px rgba(94, 139, 255, 0.15);
        margin-top: -1em;
    }
    .active-plan .custom-outer{

        box-shadow: 0px 65px 65px rgba(94, 139, 255, 0.15);

    }

    .custon-outline {
        border: none;
        border-radius: 22px;
    }

    .btn-disable {
        color: #7e50a7;
        background-color: #e1c5fb87;
    }

    .btn-delete {
        color: #567fa8;
        background-color: #e2e7f2;
        margin-left: 5px;
    }

    .float-right {
        float: right;
    }

    .invite-input {
        height: 45px !important;
        border-radius: 22px !important;
    }
    .seat-col {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    .seat-col img {
        width: 80px !important;
        height: 80px !important;
    }

    span.plus-icom {
        padding: 6px;
        border-radius: 50%;
        background: white;
        margin-left: 23px;
    }
    span.plus-icom img {
        padding: 4px;
        margin-top: -1px;
        /* margin-left: 22px; */
    }
    button.btn.custom-outline-btn.btn-purple-bg {
        padding: 10px 6px 10px 25px;
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
    /*  table - 86a2vy3y6  */
    .table-bordered td {
        border: 1px solid #f0f0f0 !important;
    }
    .table.table-bordered td {
        padding: 1.2rem 0.5rem !important;
    }
    .deleted-row {
        background: #e9e9e9 !important;
        opacity: 0.5;
        pointer-events: none;
    }
    /*  table - 86a2vy3y6 end  */
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
    .ustom-tbl-2 {
        border: unset !important;
    }

    .addUserPP .modal-content {
        background: var(--grey12);
    }
    .addUserBox {
        background: #ffffff !important;
        box-shadow: 0px 35px 35px rgba(114, 153, 255, 0.1) !important;
        border-radius: 15px;
    }
    .add-usr-h {
        font-family: "Poppins" !important;
        font-style: normal !important;
        font-weight: 500 !important;
        font-size: 18px !important;
        line-height: 27px !important;
    }
    .second-h-plan {
        font-family: "Poppins" !important;
        font-style: normal !important;
        font-weight: 600 !important;
        font-size: 24px !important;
        line-height: 36px !important;
        margin-top: 2em;
        /* identical to box height */

        color: #1a1a1a !important;
    }

    .u-button .btn-row {
        display: inline-flex;
    }

    input[class*="email-input-"]:disabled {
        background: none;
        border: 0;
    }

    .btn-reassign {
        color: #fff !important; background: #7e50a7;
    }

    /*  task - 86a27zdpn  */
    .addUserPP .form-control:disabled {
        height: auto;
    }
   @media (min-width: 576px) {
    #adduserModalCenter .modal-dialog {
        max-width: 700px !important;
    }
}
   button.btn.custom-outline-btn.btn-purple {
    flex: none;
}

    /*  task - 86a2cbkkm  */
    .form-switch .form-check-input {
        background-position: left center;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    }
    .form-switch .form-check-input:focus {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    }
    .form-switch .form-check-input:checked {
        background-position: right center;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
        background-color: #fff; border: 1px solid rgba(0, 0, 0, .25);
    }
    {{-- 86a2qa1qv --}}
    .subscription-plan .form-switch .form-check-input {
        background-position: left center;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
    }
    .subscription-plan .form-switch .form-check-input:focus {
         background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
    }
    .subscription-plan .form-switch .form-check-input:checked {
        background-position: right center;
       background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
        background-color: var(--purple); border: 1px solid rgba(0, 0, 0, .25);
    }
    {{-- end 86a2qa1qv --}}
    .deleted_invited_user{
         opacity: 0.5; /* Reduce opacity to make it look disabled */
    pointer-events: none; /* Disable pointer events */
    background-color: #f0eaea;
    }

    {{-- 86a2kvagf --}}
.email-to a{
        color: var(--purple) !important;
}

.email-to a:hover {
    color: #EDB61E !important;
}
{{-- 86a2kvagf --}}

.manage-subs-users input[type="text"], input[type="tel"], input[type="password"], input[type="email"], select {
        height:20px;
    }
    .table td {
            padding: 1.2rem 0.2rem !important;
    }
</style>

 @if($active_plan['plan_period']== "month")
 <style>
    .subscription-plan:not(.active-plan):hover .text-muted-light:not(.active) {
        color: unset !important;
    }

    .subscription-plan:not(.active-plan):hover .text-muted-light .text-muted:not(.active) {
        color: #6c757d !important;
    }

    .subscription-plan:not(.active-plan) .text-muted-light .btn.text-muted:hover {
        color: #fff !important;
    }
    </style>
    @endif
<!-- bootstrap cdn -->

{{-- 86a26mnw9 --}}
  @php
    $perUserAmont=0;
        if ($active_plan['plan_id'] == 1) {
            if ($active_plan['plan_period'] == 'month') {
                $perUserAmont = 50;
            } else {
                $perUserAmont = 479;
            }
        } elseif ($active_plan['plan_id'] == 2) {
            if ($active_plan['plan_period'] == 'month') {
                $perUserAmont = 100;
            } else {
                $perUserAmont = 949;
            }
        }
    @endphp
    {{-- end 86a26mnw9 --}}
    <div class="mid-contain subscription">
        <div class="container-fluid">
            <div class="main-body container-fluid">
                <div class="main-body-upper">
                    <h2 class="mt-0 mb-5 second-h-plan">Manage Subscriptions</h2>
                    {{-- <form> --}}
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            @if (session('message') !== null)
                                <div class="alert alert-purple mb-5" role="alert">
                                  {!! session('message') !!}
                                </div>
                            @elseif(session('success') !== null)
                                <div class="alert alert-purple mb-5" role="alert">
                                  {!! session('success') !!}
                                </div>
                            @elseif(session('error') !== null)
                                <div class="alert alert-danger mb-5" role="alert">
                                  {!! session('error') !!}
                                </div>
                            @endif
                        </div>

                        @php $show_active = ($active_plan['plan_id'] == $switch_to_plan && $active_plan['plan_period'] == $switch_period) ? true : false //task - 86a0y5va2
                         @endphp

                        <div class="col-md-6 {{ ($active_plan['plan_id'] == 1) ? 'active-plan' : '' }} subscription-plan">
                            <div class="card text-center custom-outer">
                                @if($active_plan['plan_id'] == 1 && $show_active)
                                <div class="card-header"><i class="fa fa-check"></i> Active Plan</div>
                                @endif
                                <div class="card-body mx-4 {{ ($active_plan['plan_id'] == 1) ? '' : 'text-muted-light' }}">
                                    <h5 class="card-title card-title-bold">Employer</h5>
                                    @php
                                        if($plan1_period=='month'){
                                         $plan1_amount = $plan1_amount + ($active_plan['number_of_users'] > 1 ? (50 * ($active_plan['number_of_users'] - 1)) : 0);
                                        }
                                        if($plan1_period=='year'){
                                         $plan1_amount = $plan1_amount + ($active_plan['number_of_users'] > 1 ? (479 * ($active_plan['number_of_users'] - 1)) : 0);
                                        }
                                    @endphp
                                    <p class="mb-0"><span  class="yellow-text">${{$plan1_amount}}</span><span class="text-muted"> /{{ ucfirst($plan1_period) }}ly</span></p>
                                    {{-- task - 86a26b2xt --}}
                                    <p class="text-muted">({{$active_plan['number_of_users']}} {{ ($active_plan['number_of_users'] > 1) ? 'users' : 'user' }}) </p>

                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="flexSwitchCheckDefault1">Monthly</label>
                                        {{--  {{ ($active_plan['plan_id'] == 1) ? '' : 'disabled' }} --}}
                                        <input class="form-check-input float-right" type="checkbox" role="switch" id="flexSwitchCheckDefault1" {{ $plan1_period=='month' ? '' : 'checked' }} {{ $active_plan['plan_period']== "year" ? 'disabled' : '' }} ref="price-info-first" wire:change="updateSubscription($event.target.checked, $event.target.getAttribute('ref'))" />
                                        <label class="form-check-label" for="flexSwitchCheckDefault1">Yearly</label>
                                    </div>

                                    <p class="text-muted mt-4 key-points"><i class="fa fa-check"></i> Communicate directly with candidates</p>
                                    <p class="text-muted mt-4 key-points"><i class="fa fa-check"></i> Easy-to-use interface</p>
                                    <p class="text-muted mt-4 key-points"><i class="fa fa-check"></i> Search based on skills and experience</p>
                                    <p class="text-muted mt-4 key-points"><i class="fa fa-check"></i> Utilize multiple filters to find the perfect candidate for your open position</p>
                                    <p class="text-muted mt-4 key-points"><i class="fa fa-check"></i> Organize and manage candidates of interest</p>
                                    <p class="text-muted mt-4 key-points"><i class="fa fa-check"></i> View resumes with references and accomplishments</p>
                                    <!-- <p class="text-muted my-4 mb-5 key-points key-point-bold"><i class="fa fa-check text-success"></i> Access new candidates 24 hours earlier than employer plan </p> -->

                                    @if(($active_plan['plan_id'] == 2 && $active_plan['plan_period']== "month") || empty($active_plan) || $active_plan['plan_id'] == null || $plan1_switch)
                                        <form wire:submit.prevent="switchSubscription(1)">
                                            <button class="btn btn-outline-secondary custom-outline-btn text-muted inactive-plan-btn {{ $btn1_class }}" wire:loading.remove wire:target="switchSubscription(1)">{{$active_plan['plan_id'] == null ? 'Choose Plan' : 'Switch to this plan'}}</button>
                                            <input type="button" value="{{$active_plan['plan_id'] == null ? 'Processing...' : 'Switching plan...'}}" class="btn btn-outline-secondary custom-outline-btn text-muted inactive-plan-btn" wire:loading wire:target="switchSubscription(1)"/>
                                        </form>
                                    @endif
                                    {{-- 86a2kvagf --}}
                                    @if($active_plan['plan_period']== "year" &&  $active_plan['plan_id'] == 1 )
                                    <hr>
                                    <small class="text-danger mt-4 key-points email-to">
                                        Please contact customer support at <a href="mailto:info@purplestairs.com">info@purplestairs.com</a> if you'd like to change your subscription
                                    </small>
                                @endif
                                {{-- 86a2kvagf --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 {{ ($active_plan['plan_id'] == 2) ? 'active-plan' : '' }} subscription-plan text-center mt-md-0 mt-4">
                            <div class="card text-center outer-card custom-outer">
                                @if($active_plan['plan_id'] == 2 && $show_active)
                                <div class="card-header"><i class="fa fa-check"></i> Active Plan</div>
                                @endif
                                <div class="card-body mx-4 {{ ($active_plan['plan_id'] == 2) ? '' : 'text-muted-light' }}">
                                    <div class="card text-center border-0">
                                        <div class="card-body">
                                            <h5 class="card-title card-title-bold">Employer Plus</h5>
                                            @php
                                                if($plan2_period=='month'){
                                                     $plan2_amount = $plan2_amount + ($active_plan['number_of_users'] > 1 ? (100 * ($active_plan['number_of_users'] - 1)) : 0);
                                                }
                                                if($plan2_period=='year'){
                                                    $plan2_amount = $plan2_amount + ($active_plan['number_of_users'] > 1 ? (949 * ($active_plan['number_of_users'] - 1)) : 0);
                                                }
                                            @endphp
                                            <p class="mb-0"><span class="yellow-text">${{$plan2_amount }}</span><span class="text-muted"> /{{ ucfirst($plan2_period) }}ly</span></p>
                                            {{-- task - 86a26b2xt --}}
                                            <p class="text-muted">({{$active_plan['number_of_users']}} {{ ($active_plan['number_of_users'] > 1) ? 'users' : 'user' }}) </p>
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexSwitchCheckDefault2">Monthly</label>
                                                {{-- {{ ($active_plan['plan_id'] == 2) ? '' : 'disabled' }} --}}
                                                <input class="form-check-input float-right" type="checkbox" role="switch" id="flexSwitchCheckDefault2" {{ $plan2_period=='month' ? '' : 'checked' }} {{ $active_plan['plan_period']== "year" ? 'disabled' : '' }} ref="price-info-second" wire:change="updateSubscription($event.target.checked, $event.target.getAttribute('ref'))"/>
                                                <label class="form-check-label" for="flexSwitchCheckDefault2">Yearly</label>
                                            </div>

                                            <p class="text-muted mt-4 key-points"><i class="fa fa-check text-success"></i> Communicate directly with candidates</p>
                                            <p class="text-muted mt-4 key-points"><i class="fa fa-check text-success"></i> Easy-to-use interface</p>
                                            <p class="text-muted mt-4 key-points"><i class="fa fa-check text-success"></i> Search based on skills and experience</p>
                                            <p class="text-muted mt-4 key-points"><i class="fa fa-check text-success"></i> Utilize multiple filters to find the perfect candidate for your open position</p>
                                            <p class="text-muted mt-4 key-points"><i class="fa fa-check text-success"></i> Organize and manage candidates of interest</p>
                                            <p class="text-muted mt-4 key-points"><i class="fa fa-check text-success"></i> View resumes with references and accomplishments</p>
                                            <p class="text-muted my-4 key-points key-point-bold"><i class="fa fa-check text-success"></i> Access new candidates 24 hours earlier than employer plan </p>

                                            @if($active_plan['plan_id'] == 1 || empty($active_plan) || $active_plan['plan_id'] == null || $plan2_switch)
                                                <form wire:submit.prevent="switchSubscription(2)">
                                                    <button class="btn btn-outline-secondary custom-outline-btn text-muted inactive-plan-btn {{ $btn2_class }}" wire:loading.remove wire:target="switchSubscription(2)">{{$active_plan['plan_id'] == null ? 'Choose Plan' : 'Switch to this plan'}}</button>
                                                    <input type="button" value="{{$active_plan['plan_id'] == null ? 'Processing...' : 'Switching plan...'}}" class="btn btn-outline-secondary custom-outline-btn text-muted inactive-plan-btn" wire:loading wire:target="switchSubscription(2)"/>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- 86a2kvagf --}}
                                    @if($active_plan['plan_period']== "year" &&  $active_plan['plan_id'] == 2 )
                                    <hr>
                                        <small class="text-danger mt-4 key-points email-to">
                                            Please contact customer support at <a href="mailto:info@purplestairs.com">info@purplestairs.com</a> if you'd like to change your subscription
                                        </small>
                                    @endif
                                    {{-- 86a2kvagf --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}

                    <div class="row mt-4">
                        <h5 class="payment-info- second-h-plan">Manage Users</h5>
                        <div class="col-md-3 seat-box manageu-seat-box">
                            <div class="row">
                                <div class="col-4 seat-col">
                                    <img src="{{asset('/assets/fe/images/seat.png')}}" alt="" />
                                </div>
                                <div class="col-8 border-right-1">
                                    <p>
                                         <span class="yellow-text">$
                                        @php
                                            if($active_plan['plan_id'] == 1){
                                            echo $plan1_amount;
                                            }
                                            if($active_plan['plan_id'] == 2){
                                                echo $plan2_amount;
                                            }
                                            if($active_plan['plan_id'] == 3){
                                                echo $plan3_amount;
                                            }
                                        @endphp
                                        </span>

                                        <span class="text-muted">/{{ ucfirst($active_plan['plan_period']) }}ly <br /><span class="seat-box-msg">You currently have  {{ $active_plan['number_of_users'] }} @if($active_plan['number_of_users']==1)User @else Users @endif</span></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted m-0">What are the benefits of buying additional users?</h6>
                            <p class="text-muted mb-2">Buying additional users will allow you to collaborate with others within your company. Your accounts will be linked and your saved searches and notes will be shared internally. <span class="add-user-primary">Add users anytime.</span></p>
                        </div>
                        <div class="col-md-3 u-button text-end">
                            @if($active_plan['number_of_users'] > 1)
                                <div class="btn-row"><button type="button" class="btn custom-outline-btn btn-purple" data-toggle="modal" data-target="#adduserModalCenter" data-bs-toggle="modal" data-bs-dismiss="modal">{{-- task - 86a0y5xdh Invite Users--}} Manage Users <i class="fa fa-plus-circle ml-1" aria-hidden="true"></i></button></div><br>
                            @endif

                            @if($active_plan['plan_id'])
                                <div class="btn-row"><button type="button" class="btn custom-outline-btn btn-purple mt-2" data-toggle="modal" data-target="#manageuModal" data-bs-toggle="modal" data-bs-dismiss="modal">{{-- task - 86a0y5xdh Add Users--}} Add Users <i class="fa fa-user-circle ml-1" aria-hidden="true"></i></button></div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4 mb-4">
                        <h5 class="payment-info- second-h-plan">Update Payment Information</h5>
                    </div>

                    <div class="cc_row">
                        @foreach($cards as $cc)
                            @include('inc.card_row')
                        @endforeach
                    </div>

                    <div class="row mt-4 mb-4">
                        <button type="button" class="btn custom-outline-btn btn-purple-bg" data-bs-target="#addCardModal" data-bs-toggle="modal" data-bs-dismiss="modal" wire:click="clearCardModel()">
                            Add A Card <span class="plus-icom"><img src="{{asset('/assets/fe/images/+.svg')}}" alt="" /></span>
                        </button>
                    </div>

                    @if($active_plan['plan_id'])
                    <div class="row mt-4 mb-4">
                        <h5 class="payment-info- second-h-plan">Active Subscription</h5>
                    </div>

                    <div class="row mt-4 mb-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="custom-tb-head custom-tbl-1s">
                                    <tr>
                                        <th scope="col">Subscription Plan</th>
                                        <th scope="col">Subscription Price</th>
                                        <th scope="col">Next Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody class="tbl-body">
                                    <tr>
                                        <td>{{ $active_plan->plan_id==1 ? 'Employer' : 'Employer Plus' }}</td>
                                        <td>${{number_format($active_plan->plan_amount,2)}} / {{ucfirst($active_plan->plan_period)}}</td>
                                        @php
                                         if(!empty($nextDate)){
                                           $next_recurring_date= $nextDate;
                                        }
                                        else{
                                            $next_recurring_date = date('m/d/Y');
                                            // dd($recurring_info->last_execution_time);
                                            if($active_plan->plan_period == "month") {
                                                if($recurring_dt) {
                                                    $next_recurring_date = date('m/d/Y', strtotime($recurring_dt." +1 month"));
                                                } else {
                                                    $next_recurring_date = date('m/d/Y', strtotime($active_plan->created_dt." +1 month"));
                                                }
                                            } else {
                                                if($recurring_dt) {
                                                    $next_recurring_date = date('m/d/Y', strtotime($recurring_dt." +1 year"));
                                                } else {
                                                    $next_recurring_date = date('m/d/Y', strtotime($active_plan->created_dt." +1 year"));
                                                }
                                            }
                                            }
                                        @endphp
                                        <td>{{ $next_recurring_date }}</td>
                                    </tr>
                                </tbody>
                            </table>

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
                                if(!empty($active_plan->plan_id)){
                                    if ($active_plan->plan_id == 1) {
                                        if ($active_plan->plan_period == 'month') {
                                            $current_plan = "Employer Monthly";
                                        } else {
                                            $current_plan = "Employer Yearly";
                                        }
                                    } else {
                                        if ($active_plan->plan_period == 'month') {
                                            $current_plan = "Employer Plus Monthly";
                                        } else {
                                            $current_plan = "Employer Plus Yearly";
                                        }
                                    }
                                }
                            @endphp
                            @if(!empty($last_total_amount))
                                <div class="alert  alert-dismissible text-white" style="background:var(--purple);">
                                @if(($last_plan=='Employer Yearly' || $last_plan=='Employer Plus Yearly') && ($current_plan=='Employer Monthly' || $current_plan=='Employer Plus Monthly'))
                                You already paid for the year in full. Your next charge for the monthly plan won't occur until @if(!empty($next_recurring_date)) <span style="font-weight:bold;"> {{ $next_recurring_date }},</span> @endif when your new billing cycle starts.
                                @else
                                You have changed your subscription plan from the <span style="font-weight:bold;">{{$last_plan }}</span> plan to the <span style="font-weight:bold;">{{ $current_plan }}</span> plan. The new plan will take effect on @if(!empty($next_recurring_date)) <span style="font-weight:bold;"> {{ $next_recurring_date }},</span> @endif at which point your subscription price and next payment date will change to reflect your new plan.
                                @endif
                                </div>
                            @endif
                            @endif

                            {{-- task - 86a2vy3y6 --}}
                            @if(!empty(count($joined_user)) && count($joined_user)>1)
                                <div class="row mt-4 mb-4">
                                    <h5 class="payment-info- second-h-plan">Added Users</h5>
                                </div>
                                <table class="table manage-subs-users">
                                    <thead class="custom-tb-head custom-tbl-2">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Added on</th>
                                            <th scope="col">Charge Amount</th>
                                            {{-- task - 86a2vy3y6 --}}
                                            <th scope="col">Next Payment Date</th>
                                            <th scope="col">Action</th>
                                            @if($active_plan['plan_period'] == "month")
                                            <th scope="col"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <form id="manage_user_form">
                                        <tbody class="tbl-body">
                                            @php  $sn=1; @endphp
                                            @foreach($joined_user as $keyInvite => $ju)
                                                @if(/* task - 86a2vy3y6 empty($ju['deleted_at']) && */$keyInvite!=0)
                                                    <tr id="user_{{ $ju['invited_id'] }}" class="{{ !empty($ju['deleted_at']) ? 'deleted-row' : '' }}">
                                                        <td>{{ $sn }}</td>
                                                        <td>{{ $ju['name'] }}</td>
                                                        <td>
                                                            <input type="text" value="{{ $ju['email'] }}" class="form-control email-input-{{$ju['invited_id']}} px-0" disabled>
                                                            <span class="email-error-{{$ju['invited_id']}}"></span>
                                                        </td>
                                                        <td>{{ date('m/d/Y', strtotime($ju['created_at'])) }}</td>
                                                        <td>${{number_format($perUserAmont,2)}}</td>
                                                        {{-- task - 86a2vy3y6 --}}
                                                        <td>
                                                            @if(empty($ju['deleted_at']))
                                                            {{ date('m/d/Y', strtotime($ju['created_at'] . '+1 month')) }}
                                                            @endif
                                                        </td>
                                                        {{-- task - 86a2vy3y6 end --}}
                                                        <td>
                                                            {{-- task - 86a2vy3y6 --}}
                                                            @if(empty($ju['deleted_at']))
                                                            <a class="deleteAddedUser text-white btn btn-danger" href='javascript:void(0)' data-id="{{$ju['invited_id']}}"><i class="fa fa-trash-o"></i></a>
                                                            @else
                                                            <span class="badge alert-danger text-danger px-2">Deleted</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $sn++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </form>
                                </table>
                            @endif
                        </div>
                    </div>


                    {{-- task - 86a28zyzx moved payment history section as a separate page --}}

                    <!-- Modal -->
                    <div class="modal fade addUserPP" id="adduserModalCenter" tabindex="-1" wire:ignore.self role="dialog" aria-labelledby="adduserModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p class="d-flex justify-content-end">
                                        <a href="javascript:void(0)" class="close text-center color-primary" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </p>

                                    @if($manage_user_message)
                                    <div class="alert alert-purple mb-5" role="alert" id="user-message">
                                        {{ $manage_user_message }}
                                    </div>
                                    @endif
                                    <span class="addUserBox d-block p-4 mx-3">
                                        @php
                                            $remaining_invite = $active_plan['number_of_users']-count($joined_user);
                                        @endphp
                                        <div class="row mb-4">
                                            <h5 class="mt-0 payment-info- second-h-plan">You are currently using {{count($joined_user)}} out of {{$active_plan['number_of_users']}} licenses.</h5>
                                        </div>

                                        {{-- @for($no = 0; $no < $active_plan['number_of_users']; $no++) --}}
                                        {{-- {{dd($joined_user)}} --}}
                                        @for($no = 1; $no < $active_plan['number_of_users']; $no++)
                                            @if(!array_key_exists($no,$temp_usersIds))
                                                <div class="row mt-4 mb-3 align-items-center-">
                                                    <div class="col-md-5 mb-1">
                                                        <div class="form-input">
                                                            <input type="text" placeholder="Name*" class="form-control invite-input" required="" value="" autocomplete="invite_username" autofocus="" wire:model.defer="invite_username.{{$no}}" required {{ $no == 0 ? 'readonly' : '' }} {{ !$active_plan['plan_id'] ? 'disabled' : '' }}/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 mb-1">
                                                        <div class="form-input">
                                                            <input type="email" placeholder="Email Address" class="form-control email invite-input" value=""  autocomplete="invite_useremail" autofocus="" wire:model.defer="invite_useremail.{{$no}}" required {{ $no == 0 ? 'readonly' : '' }} {{ !$active_plan['plan_id'] ? 'disabled' : '' }}/>
                                                            <span class="invite-input-{{$no}} validate_email" style="color: red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-1">
                                                        @if(!$active_plan['plan_id'])
                                                            <button class="btn custom-outline-btn btn-invite" disabled>{{ $no == 0 ? 'Invite' : 'Invited' }}</button>
                                                        @else
                                                            @if(isset($invited_list[$no]))
                                                                <button wire:loading.remove wire:target="InviteUser({{$no}})" class="btn custom-outline-btn btn-invite" {{ $no == 0 ? 'disabled' : '' }}>{{ $no == 0 ? 'Invite' : 'Invited' }}</button>
                                                                <input type="button" value="Sending..." class="btn custom-outline-btn btn-invite" wire:loading wire:target="InviteUser({{$no}})"/>
                                                            @else
                                                                <form wire:submit.prevent="InviteUser({{$no}})" id="invite-form{{$no}}">
                                                                    <button class="btn custom-outline-btn btn-invite" wire:loading.remove wire:target="InviteUser({{$no}})">Invite</button>
                                                                    <input type="button" value="Sending..." class="btn custom-outline-btn btn-invite" wire:loading wire:target="InviteUser({{$no}})"/>
                                                                </form>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="">
                                        <div class="row mt-4 mb-4 mx-3 mt-3">
                                            <h5 class="payment-info- second-h-plan">Manage Users
                                                @if($remaining_invite == 0)
                                                <button type="button" class="btn custom-outline-btn btn-purple mt-2" data-toggle="modal" data-target="#manageuModal" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="$('#adduserModalCenter a.close').click();">Buy Additional Users</button>
                                                @endif
                                            </h5>

                                            {{-- task - 86a2ucam4 --}}
                                            <small>Please contact <span style="color: var(--purple);">info@purplestairs.com</span> if you'd like to delete a user.</small>
                                        </div>

                                        <div class="row mt-4 mb-4">
                                            <div class="table-responsive px-4 mx-3">
                                                <table class="table">
                                                    <thead class="custom-tb-head custom-tbl-2">
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Start Date</th>
                                                            @if($active_plan['plan_period'] == "month")
                                                            <th scope="col"></th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <form id="manage_user_form">
                                                    <tbody class="tbl-body">
                                                        @php $i = 0; @endphp
                                                        @foreach($joined_user as $keyInvite => $ju)
                                                            @php $i++; @endphp
                                                        <tr id="user_{{ $ju['invited_id'] }}">
                                                            <td>{{ $ju['name'] }}
                                                                @if(is_null($ju['status']))
                                                                <span class="alert-warning px-2">Pending</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input type="text" value="{{ $ju['email'] }}" class="form-control email-input-{{$ju['invited_id']}}" disabled>
                                                                <span class="email-error-{{$ju['invited_id']}}"></span>
                                                            </td>
                                                            <td>{{ date('m/d/Y', strtotime($ju['created_at'])) }}</td>
                                                            @if($active_plan['plan_period'] == "month")
                                                            <td>
                                                                @if(count($joined_user) > 1 && $ju['id'] != Auth::user()->id)
                                                                <span class="float-right">
                                                                    @if(!is_null($ju['status']))
                                                                        @if($ju['status'])
                                                                            <button type="button" onclick="confirm('Are you sure to deactive this user account ?') || event.stopImmediatePropagation()"  wire:click="disableCompanyuser({{ $ju['id'] }})" class="btn btn-outline-secondary custon-outline btn-disable">Disable</button>
                                                                        @else
                                                                            <button type="button" wire:click="enableCompanyuser({{ $ju['id'] }})" class="btn btn-outline-secondary custon-outline btn-disable">Enable</button>
                                                                        @endif
                                                                    @else
                                                                    <button type="button" class="btn custon-outline btn-reassign reassign-{{$ju['invited_id']}}" onclick="enableReassignInput('{{$ju['invited_id']}}')">Reassign</button>
                                                                    @endif

                                                                    @php
                                                                        $del_id = ($ju['id']) ? $ju['id'] : $ju['invited_id'];
                                                                        $deltype = ($ju['id']) ? 'userid' : 'invited_id';
                                                                    @endphp
                                                                    <button type="button" onclick="confirm('Are you sure you want to delete this user account?') || event.stopImmediatePropagation()" wire:click="deleteCompanyuser({{ $del_id }},'{{ $deltype }}')" class="btn btn-outline-secondary custon-outline btn-delete">Delete</button>

                                                                </span>
                                                                @endif
                                                            </td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                        @if($i==0)
                                                        <tr>
                                                            <th scope="col" colspan="4">No data found.</th>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                    </form>
                                                </table>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- task - 86a2vybfk --}}
                    <div class="row mt-4">
                        <div class="col-md-13 col-sm-12 col-lg-12">
                            {{-- @if(($active_plan['auto_renew'] || ($active_plan['expiration_date'] < date('Y-m-d'))) && $active_plan['status']) --}}
                            @if($active_plan['status'])
                                <form wire:submit.prevent="cancelSubscription({{$active_plan['id']}})">
                                    {{-- <button class="btn btn-danger custom-btn-danger mt-4 mb-2" wire:loading.remove wire:target="cancelSubscription">{{ (isset($_GET['Yearly'])) ? 'Do Not Renew My Subscription' : 'Deactivate My Account' }}</button> --}}
                                    @if(empty($delete))
                                    <input type="button" value="Deactivate My Account" class="btn btn-danger custom-btn-danger mt-4 mb-2 deactivateAccountBtn" />
                                    @else
                                    <a wire:click="reactivateAccount()" class="blue_btn shadow">Reactivate Account
                                </a>
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('inc.add_card')
    @include('inc.manage_users')
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@push('scripts')
<script>

    document.addEventListener('livewire:load', function () {
        Livewire.on('storeUserData', function (data) {
            // Display the user data somewhere in your view
            console.log('Stored user data: ', data);
             @this.emit('storeUserData', data);
        });
        Livewire.on('storeUserDataNo', function (data) {
            // Display the user data somewhere in your view
            console.log('Stored user data No: ', data);
        });

        Livewire.hook('message.processed', (el, component) => {
            // console.log(el, $(el));
        });
    });

    {{-- document.querySelector('.modal-close-button').addEventListener('click', function () {
        var userMessage = document.getElementById('user-message');
        if (userMessage) {
            userMessage.style.display = 'none';
        }
    }); --}}
    window.addEventListener('close-card', event => {
        $('#addCardModal').modal('hide');
    });

    window.addEventListener('update-card', event => {
        console.log('update-card', $('.cc_row .form-check-input:checked'));
        console.log($('.cc_row').find('#flexCheckDefault-'+event.detail.cc_id));
        $('.cc_row').find('#flexCheckDefault-'+event.detail.cc_id).prop('checked', true);
    });

    window.addEventListener('disable-card-save', event => {
        $('#addCardModal input[type=submit]').prop('disabled', true);
    });

    window.addEventListener('enable-card-save', event => {
        $('#addCardModal input[type=submit]').prop('disabled', false);
    });

    window.addEventListener('close-adduser', event => {
        setTimeout(function(){
            Livewire.emit('clearMessage');
            $('#adduserModalCenter a.close').click();
        }, 3000);
    });

    window.addEventListener('remove-card-errors', event => {
        $('#addCardModal .text-danger').html('');
    });

    // task - 86a12jfv8
    $(document).on('show.bs.modal', '#adduserModalCenter', function(event) {
        $('#manage_user_form')[0].reset();
        $('#manage_user_form input').prop('disabled', true);
        $('.invite-input').val('');
        $('.validate_email').html('');
        $('.text-danger').remove();
    });

    $(document).on('hide.bs.modal', '#adduserModalCenter', function(event) {
        $('#manage_user_form')[0].reset();
        $('#manage_user_form input').prop('disabled', true);
        $('.invite-input').val('');
        $('.validate_email').html('');
        $('.text-danger').remove();
    });
    // task - 86a12jfv8 end

    $(document).on('show.bs.modal', '#addCardModal', function(event) {
        $('#save-card-form')[0].reset();
        $('.text-danger').remove();
    });

    $(document).on('hide.bs.modal', '#addCardModal', function(event) {
        $('#save-card-form')[0].reset();
        $('.text-danger').remove();
    });

    $(document).on('hide.bs.modal', '#manageuModal', function(event) {
        $('#nou-form')[0].reset();
    })

         {{-- 86a27ze33 --}}
    document.addEventListener('livewire:load', function () {
    $(document).on('show.bs.modal', '#manageuModal', function(event) {
        $('[wire\\:model\\.lazy="number_of_users"]').val(1);
        @this.set('number_of_users', Math.round('1'));
        @if($number_of_users>0)
        {{-- 86a26mnw9 --}}
        $('[wire\\:model\\.lazy="price_on_number_of_users"]').val(Math.round('{{ $perUserAmont }}'));
        @this.set('price_on_number_of_users', Math.round('{{ $perUserAmont }}'));
        {{-- end 86a26mnw9 --}}
        @else
        $('[wire\\:model\\.lazy="price_on_number_of_users"]').val(0);
        @endif
    })
      });

    window.addEventListener('close-manageusers', event => {
        $('#managenouModalCenter').modal('hide');
    });

    document.addEventListener("livewire:load", () => {
        $('#credit_card,.numbersInput').keypress(function() {
            if (event.which < 48 || event.which > 57) {
            event.preventDefault(); // Prevent the keypress event
        }
        });
    })

    // task - 86a12jfv8
    window.addEventListener('validate-invite', event => {
        console.log(event.detail);
        if(event.detail.error) {
            $('.invite-input-'+event.detail.no).html(event.detail.error);
        }
    });

    // task - 86a0y6bwz
    function enableReassignInput(id) {
        $('.email-input-'+id).prop('disabled', false).focus();
        $('.reassign-'+id).text('Invite');
        $('.reassign-'+id).attr('onclick', 'updateInvitation('+id+')');
    }

    function updateInvitation(id) {
        $('.reassign-'+id).prop('disabled', true);
        Livewire.emit('updateInvitation', id, $('.email-input-'+id).val());
    }

    window.addEventListener('disable-reassign-input', event => {
        console.log(event.detail);
        if(event.detail.error) { // task - 86a12jfv8
            $('.email-input-'+event.detail.id).val(event.detail.email).prop('disabled', false).focus();
            $('.email-error-'+event.detail.id).html(event.detail.error);
            $('.email-error-'+event.detail.id).addClass('text-danger');

            $('.reassign-'+event.detail.id).text('Invite');
            $('.reassign-'+event.detail.id).attr('onclick', 'updateInvitation('+event.detail.id+')');
        } else {
            $('.reassign-'+event.detail.id).prop('disabled', false);
            $('.email-input-'+event.detail.id).val(event.detail.email).prop('disabled', true);
            $('.reassign-'+event.detail.id).text('Reassign');
            $('.reassign-'+event.detail.id).attr('onclick', 'enableReassignInput('+event.detail.id+')');
        }
    });
    // task - 86a0y6bwz end


    window.addEventListener('delete-user', event => {
        console.log('testing',event.detail.id);
        $('#user_'+event.detail.id).remove();
        var listHtml="";
        var remian=event.detail.remianing;
        for (var i = 1; i < remian; i++) {
            listHtml+='<div class="row mt-4 mb-3 align-items-center"> <div class="col-md-5 mb-1"> <div class="form-input"> <input type="text" placeholder="Name*" class="form-control invite-input" required="" value="" autocomplete="invite_username" autofocus="" wire:model.lazy="invite_username.1"> </div></div><div class="col-md-5 mb-1"> <div class="form-input"> <input type="email" placeholder="Email Address" class="form-control email invite-input" value="" autocomplete="invite_useremail" autofocus="" wire:model.lazy="invite_useremail.1" required=""> <span class="invite-input-1 validate_email" style="color: red;"></span> </div></div><div class="col-md-2 mb-1"> <form wire:submit.prevent="InviteUser('+i+')" id="invite-form"> <button class="btn custom-outline-btn btn-invite" wire:loading.remove="" wire:target="InviteUser('+i+')">Invite</button> <input type="button" value="Sending..." class="btn custom-outline-btn btn-invite" wire:loading="" wire:target="InviteUser('+i+')"> </form> </div></div>'
        }
        {{-- $('.remaining_count').text(remian); --}}
        {{-- $('.addUserBox').html(listHtml); --}}

        var userMessage = document.getElementById('user-message');
        if (userMessage) {
            setTimeout(function() {
                userMessage.style.display = 'none';
            }, 5000);  // 10 seconds
        }
    });
    $(document).on('click', '.subscription-plan', function(event) {
        $('.subscription-plan').find('.card-body').addClass('text-muted-light');
        $(this).find('.card-body').removeClass('text-muted-light');
    });

    $(document).on('show.bs.modal', '#addCardModal', function(event) {
var modal = document.getElementById('manageuModal');
if (modal) {
    modal.classList.remove('show');
    modal.style.display = 'none';
    var modalBackdrop = document.getElementsByClassName('modal-backdrop')[0];
    if (modalBackdrop) {
        modalBackdrop.parentNode.removeChild(modalBackdrop);
    }
}
});
$("body").delegate("#manageuModal .btn-close", "click", function(e) {
    var modal = document.getElementById('manageuModal');
if (modal) {
    modal.classList.remove('show');
    modal.style.display = 'none';
    var modalBackdrop = document.getElementsByClassName('modal-backdrop')[0];
    if (modalBackdrop) {
        modalBackdrop.parentNode.removeChild(modalBackdrop);
    }
}
})
$(document).on('shown.bs.modal', '#manageuModal', function() {
    localStorage.setItem('manageuModalOpen', 'true');
});
$(document).on('hide.bs.modal', '#addCardModal', function(event) {
if (localStorage.getItem('manageuModalOpen')) {
        $('#adduserModalCenter').modal('show');
        localStorage.removeItem('manageuModalOpen'); // Remove localStorage
    }
});

    $("body").delegate(".deactivateAccountBtn", "click", function(e) {
        var htmlContant='<p class="px-2">You will have access to your Purple Stairs account until the end of your current billing cycle, which ends on @if(!empty($nextDate)){{ \Carbon\Carbon::parse($nextDate)->format("m/d/Y")  }} @endif</p><p style="font-size: 17px;font-weight: 700;">Are you sure you want to deactivate your account?</p>';
            Swal.fire({
            // title: "Opting out of this section causes you to appear as an entry-level candidate. To avoid this without revealing your position, add your information and select the hide option.",
           html:htmlContant,
            {{-- text: 'Are you sure you want to log out?', --}}
            icon: 'warning',
            iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
            showCancelButton: true,
            confirmButtonColor: '#7E50A7',
            cancelButtonColor: '#4A2D64',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showCloseButton: true,
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('cancelSubscription');
            } else {
            return false;
            }
            });
    });

</script>

{{-- 86a2u68b3 --}}
@if(Session::get('add-user'))
    <script>
        $(document).ready(function() {
            $('#manageuModal').modal('show');
            @php
                Session::forget('add-user');
            @endphp
        });
    </script>
@endif
{{-- end 86a2u68b3 --}}
@endpush
