<div class="c-form" style="background:#fbfaff;">
<table align="center" bgcolor="#fbfaff" border="0" cellpadding="0" cellspacing="0" class="devicewidth" width="100%">
    <tr>
        <td>
            <table align="center" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" class="devicewidth" width="620">
                <tr>
                    <td colspan="4" bgcolor="#fbfaff"  height="30" style="border-bottom:30px solid #fbfaff;"></td>
                </tr>
                <tr>
                    <td colspan="4" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size: 30px; color: #585858; text-align:center; line-height:18px; padding:20px 24px 20px 24px; border-bottom:solid 1px #f2f2f2;"><img src="https://stage.purplestairs.com/assets/be/images/purplestairs-png.png" alt="Purple Stairs" width="263"></td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:27px 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Hi <?php echo e($employer); ?>,</span></td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">New candidates found match with your saved searches. Listed Below :</span></td>
                </tr>

                <?php $__currentLoopData = $new_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;">
                        <span style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#7e50a7; text-align:left; line-height:22px; font-weight: 700"><a href="<?php echo e(url('company/saved-search/' . $new['slug'])); ?>" style="color: #7e50a7; text-decoration: none;"><?php echo e($new['search']); ?></a></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;">
                        <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" class="devicewidth" width="100%">
                            <?php $__currentLoopData = $new['new_candidates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $employments = []; $yrs_of_exp = 0; $exp_months = 0;
                                if($candidate->employments->count()) {
                                    $employments = $candidate->employments->toArray();
                                    $start_years = array_column($employments, 'start_year');
                                    $end_years = array_column($employments, 'end_year');
                                    $st_year = null;
                                    $ed_year = null;

                                    if(count($start_years)) {
                                        $tmp_years = [];
                                        foreach($start_years as $idx => $syear) {
                                            if($syear !== '') {
                                                $date1 = date('Y-m-01', strtotime($employments[$idx]['start_year']));
                                                $date2 = date('Y-m-d');
                                                if ($employments[$idx]['end_year'] == '' && $employments[$idx]['currently_working']) {
                                                    $date2 = date('Y-m-01');
                                                } elseif ($employments[$idx]['end_year'] == '' && $employments[$idx]['currently_working'] == 0) {
                                                    $date2 = $date1;
                                                } elseif ($employments[$idx]['end_year'] !== '') {
                                                    $date2 = date('Y-m-01', strtotime($employments[$idx]['end_year']));
                                                }

                                                if ($date1 && $date2) {
                                                    $diff = abs(strtotime($date2) - strtotime($date1));
                                                    $years = floor($diff / (365 * 60 * 60 * 24));
                                                    $exp_months += $years;
                                                }
                                            }
                                        }
                                        $yrs_of_exp = $exp_months;
                                    } 
                                }
                            ?>
                            <tr>
                                <td><?php echo e($candidate->personal ? $candidate->personal->current_title : ''); ?></td>
                                <td style="padding:0 10px;"><?php echo e($yrs_of_exp); ?> Yrs Experience</td>
                                <td>
                                    <?php if(isset($candidate->industries)): ?>
                                        <?php echo e($candidate->industries->first() ? $candidate->industries->first()->name : ''); ?>

                                    <?php endif; ?>
                                </td>
                                <td style="padding:0 10px;">Asking Salary: <?php echo e($candidate->personal ? $candidate->personal->salary_range : ''); ?></td>
                                <td width="116" bgcolor="#82609f" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:center; line-height:22px; padding:5px 0;">
                                    <a href="<?php echo e(url('company/candidate/profile/' . $candidate->id)); ?>" style="color: white; text-decoration: none; background: #82609f; padding: 5px 0;">View Profile</a>
                                </td>
                            </tr> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Purple Stairs<br/>info@purplestairs.com</span></td>
                </tr>    
                <tr>
                    <td colspan="4" align="center" class="pad_01" bgcolor="#00407c" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-style:italic; color: #888888; line-height:18px; padding:20px 24px 10px; text-align:center;"><img src="https://stage.purplestairs.com/assets/be/images/purplestairs-ftr-png.png" alt="PurpleStairs" width="148"></td>
                </tr>
                <tr>
                    <td colspan="4" align="center" class="pad_01" bgcolor="#00407c" style="font-family:Arial, Helvetica, sans-serif; font-size: 10px; color: #fff; line-height:18px; padding:0 24px 16px; text-align:center;"><a style="color:#fff; text-decoration:none;" href="https://stage.purplestairs.com/faq">FAQ </a> &nbsp; | &nbsp; <a style="color:#fff; text-decoration:none;" href="https://stage.purplestairs.com/contact"> CONTACT US </a> &nbsp; | &nbsp; <a style="color:#fff; text-decoration:none;" href="https://stage.purplestairs.com/privacy-policy">PRIVACY POLICY</a></td>
                </tr>
                 <tr>
                    <td colspan="4" bgcolor="#fbfaff"  height="30" style="border-bottom:30px solid #fbfaff;"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div><?php /**PATH /var/www/html/app/resources/views/mail/notify_employer.blade.php ENDPATH**/ ?>