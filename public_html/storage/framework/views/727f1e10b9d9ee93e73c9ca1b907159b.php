<div class="c-head">
    <div class="top-right row">
        <div class="col-3">
            <button class="menu_toggle-">
                <img src="<?php echo e(asset('assets/be/images/left-arrw.svg')); ?>" alt="" />
            </button>
        </div>
        <div class="col-9 top-header-right">
            <div class="header-rgt hdr-rgt">
                <div class="header-list">
                    <ul class="notification_list">
                        <li class="middle-icon-one">
                            <div class="dropdown avatar-dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="avatar-img">
                                        <?php if(Auth::user()->profile_photo_path): ?>
                                        <img src="<?php echo e(asset(Auth::user()->profile_photo_path)); ?>" alt="" width="" height="" style="border-radius:50%" />
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                        <?php endif; ?>
                                    </span>
                                    <?php echo e(Auth::user()->company ? Auth::user()->company->company_name : ''); ?>

                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3" data-popper-placement="bottom-end">
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('company.dashboard')); ?>">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/be/images/new_dash_icon2.svg')); ?>" alt="" />My Dashboard
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                          <span class="download-btn">
                                            <img src="<?php echo e(asset('assets/fe/images/dp2.svg')); ?>" alt="" />Manage My Account
                                            <em><img src="<?php echo e(asset('assets/fe/images/dp-arrw.svg')); ?>" alt="" /></em>
                                          </span>
                                        </a>
                                        <ul class="sub-drop">
                                          <?php if(Auth::user()->password != ''): ?>
                                          <li><a href="<?php echo e(route('account.resetpassword')); ?>">Reset Password</a></li>
                                          <?php endif; ?>
                                          <li><a href="<?php echo e(route('account.delete')); ?>">Delete My Account</a></li>
                                          <li><a href="<?php echo e(route('account.sleep')); ?>">Put Account To Sleep</a></li>
                                        </ul>
                                      </li>
                                      <li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <span class="download-btn">
                                                <img src="<?php echo e(asset('assets/be/images/dp3.svg')); ?>" alt="" />Log
                                                Out
                                            </span>
                                        </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('click', '.menu_toggle-', function (e) {
        e.preventDefault(); e.stopPropagation();
        // if class means sidebar collapse
        var _cls = $('body').hasClass('sidebar_show');
        $.ajax({
            url: '<?php echo e(route('toggle')); ?>',
            type: 'get',
            data: {'open' : !_cls},
            success: function (data) {
                if($.trim(data)=='') {
                    $('body, html').removeClass('sidebar_show');
                } else {
                    $('body, html').addClass('sidebar_show');
                }
            }
        });
    });
</script><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/inc/headbar.blade.php ENDPATH**/ ?>