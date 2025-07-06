<div class="c-form" style="background:#fbfaff;">
<table align="center" bgcolor="#fbfaff" border="0" cellpadding="0" cellspacing="0" class="devicewidth" width="100%">
    <tr>
        <td>
            <table align="center" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" class="devicewidth" width="620">
                <tr>
                    <td colspan="4" bgcolor="#fbfaff"  height="30" style="border-bottom:30px solid #fbfaff;"></td>
                </tr>
                <tr>
                    <td colspan="4" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size: 30px; color: #585858; text-align:center; line-height:18px; padding:20px 24px 20px 24px; border-bottom:solid 1px #f2f2f2;"><img src="https://stage.purplestairs.com/assets/be/images/purplestairs-png.png" alt="Pool Mosaics" width="263"></td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:27px 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Hi <?php echo e($name); ?>,</span></td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Your PurpleStairs auto renewal subscription payment has been successfully done by today</span></td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Subscription detail is as shown below</span></td>
                </tr>
                <tr>
                  <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;">
                    <table cellspacing="10" cellpadding="0" border="0" align="left" style="width:100%;">
                      <tbody>
                        <tr>
                          <th style="border-radius: 0;" align="left">Plan</th>
                          <td><?php echo e($plan); ?> - <?php echo e($period); ?>ly</td>
                        </tr>
                        <tr>
                          <th style="border-radius: 0;" align="left">Amount Paid</th>
                          <td>$<?php echo e(number_format($paid_amount, 2)); ?></td>
                        </tr>
                        <tr>
                          <th style="border-radius: 0;" align="left">Number of user(s)</th>
                          <td><?php echo e($number_of_user); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Thanks,<br/>PurpleStairs Team</span></td>
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
</div><?php /**PATH /var/www/html/app/resources/views/mail/rec_subscription.blade.php ENDPATH**/ ?>