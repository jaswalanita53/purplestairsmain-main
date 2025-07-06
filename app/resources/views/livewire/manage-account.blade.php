<div>
<style type="text/css">
.log-wrap {
    text-align: center;
    position: relative;
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    padding: 80px 0;
    z-index: 1;
}
.login-outr {
    background: #ffffff;
    -webkit-box-shadow: 0px 65px 65px rgba(94, 139, 255, 0.15);
    box-shadow: 0px 65px 65px rgba(94, 139, 255, 0.15);
    border-radius: 15px;
    max-width: 530px;
    margin: 0 auto;
    padding: 50px 62px 40px;
}
.form-input .form-control.pass_chk {
    padding-right: 60px;
}
.form-input .form-control {
    border: 1px solid rgba(0, 0, 0, 0.106);
    border-radius: 50px;
    height: 55px;
    padding-right: 60px;
}
.form-input {
    margin-bottom: 16px;
}
.noti-txt {
    font-size: 12px;
}
.text-start {
    text-align: left!important;
}
.form-input .sub-btn, .sub-btn {
    font-weight: 600;
    font-size: 18px;
    text-align: center;
    color: #ffffff;
    background: var(--purple);
    border-radius: 35px;
    height: 50px;
    width: 100%;
    border: 1px solid transparent;
}
.form-input .sub-btn:hover, .sub-btn:hover {
    background: white;
    color: var(--purple);
    border-color: var(--purple);
}
.form-input .form-select {
    border-radius: 50px;
    padding: 0.375rem 2.25rem 0.375rem 0.85rem;
    border: 1px solid rgba(0, 0, 0, 0.118);
}
.accordion-button:not(.collapsed) {
    color: var(--purple);
    background-color: #f6ebff;
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
}
.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%237e50a7'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    transform: rotate(-180deg);
}
.de-accordion-button::after {
    background-image: unset !important;
    transform: rotate(-180deg);
}
@media only screen and (max-width: 767px){
.login-outr {
      padding: 50px 14px !important;
}
.log-wrap ,input.sub-btn {
     padding: 0px !important;

}

}
</style>
    <!-- bootstrap cdn -->
    <div class="mid-contain subscription">
        <div class="container-fluid">
            <div class="main-body container-fluid">
                <div class="main-body-upper">
                    <h2 class="mt-0 mb-5 second-h-plan">Manage Account</h2>
                    @if (session('error'))
                    <span class="text-purple" style="color:#7e50a7;">
                        <strong>{{ session('error') }}</strong>
                    </span>
                    @endif
                    @if (session('message'))
                    <span class="text-purple" style="color:#7e50a7;">
                        <strong>{{ session('message') }}</strong>
                    </span>
                    @endif
                    <div class="row mt-4 mb-4">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#resetPass" aria-expanded="false" aria-controls="resetPass">
                                    Reset Password
                                    </button>
                                </h2>
                                <div id="resetPass" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="@if(Route::currentRouteName() != 'company.manageaccount') accordion-body @endif ">
                                        @livewire('reset-password')
                                    </div>
                                </div>
                            </div>
                            @if(empty(auth()->user()->reference))
                            <div class="accordion-item">
                            @if(empty($delete))
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Deactivate My Account
                                    </button>
                                </h2>
                                @else
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button de-accordion-button" type="button" >
                                    Account Deactivated
                                    </button>
                                </h2>
                                @endif
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                    <div class="@if(Route::currentRouteName() != 'company.manageaccount') accordion-body @endif">
                                        @livewire('delete-account')
                                    </div>
                                </div>
                            </div>
                            @endif

                            {{-- <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Put Account To Sleep
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        @livewire('sleep-account')
                                    </div>
                                </div>
                            </div> --}}
                            @if(!empty($delete))
                            <div class="preview-uppr-rgt my-4">
                                <a  wire:click="reactivateAccount()" class="blue_btn shadow">Reactivate Account
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
