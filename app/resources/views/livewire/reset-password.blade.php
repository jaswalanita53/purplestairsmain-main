<div>
    <div class="login-sec pt-4 log-h-sec ban-up ban-up3 ht_center_div">
        <div class="login-sec-wrap">
            <div class="@if(Route::currentRouteName() != 'company.manageaccount') container @endif">
                <div class="log-wrap" style="background-image: url(/assets/fe/images/log-back.png)">
                    <div class="login-outr">
                        @if (session()->has('message'))
                        <h2>Your Password Was Updated Successfully</h2>
                        @else

                        <h2>Create New Password</h2>
                                               <p>
                            Your new password must be different from previously used
                            passwords.
                        </p>
                        <form wire:submit.prevent="updatePassword()">
                        @if(Auth::user()->provider_id == '')
                            <div class="form-input">
                             <div class="form_ipp_passwordd">
                                 <input type="password" class="password-field pass_chk form-control" placeholder="Current Password" wire:model.lazy="current_password" >
                                 <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                             </div>
                                 @include('inc.error', [
                                 'field_name' => 'current_password',
                                 ])
                            </div>
                            @endif
                            <div class="form-input">
                             <div class="form_ipp_passwordd">
                                 <input type="password" class="password-field pass_chk form-control" placeholder="New Password" wire:model.lazy="password" >
                                 <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                             </div>
                                 @include('inc.error', [
                                 'field_name' => 'password',
                                 ])
                            </div>
                            <!-- <div class="form-input">
                                <input type="password" placeholder="Current Password" class="form-control pass_chk"
                                    wire:model.lazy="current_password" />
                                    <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                                @include('inc.error', [
                                    'field_name' => 'current_password',
                                ])
                            </div> -->
                            <!-- <div class="form-input">
                                <input type="password" placeholder="New Password" class="form-control pass"
                                    wire:model.lazy="password" />
                                @include('inc.error', [
                                    'field_name' => 'password',
                                ])
                            </div> -->
                            <p class="text-start noti-txt">Must be at lease 8 characters</p>
                            {{-- task - 8678egn9b <div class="form-input">
                             <div class="form_ipp_passwordd">
                                 <input type="password" class="pass_chk form-control" placeholder="Confirm New Password" wire:model.lazy="confirmPassword" >
                                 <a href="javascript:void(0)" class="pass_chk_toggler"></a>
                             </div>
                                 @include('inc.error', [
                                 'field_name' => 'confirmPassword',
                                 ])
                            </div> --}}

                            <!-- <div class="form-input">
                                <input type="password" placeholder="Confirm New Password" class="form-control"
                                    wire:model.lazy="confirmPassword" />
                                @include('inc.error', [
                                    'field_name' => 'confirmPassword',
                                ])
                            </div> -->
                            {{-- <p class="text-start noti-txt">Both password must match.</p> --}}

                            <div class="form-input">

                                <input type="submit" value="Reset Password" class="sub-btn" />
                            </div>
                        </form>
                        @endif
                    </div>
                    @if(Route::currentRouteName() != 'company.manageaccount')
                        <img src="{{ asset('assets/fe/images/log1.png') }}" alt="" class="mobile-v log1">
                        <img src="{{ asset('assets/fe/images/log2.png') }}" alt="" class="mobile-v log2">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
