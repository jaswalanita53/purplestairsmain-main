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
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:27px 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Hi administrator,</span></td>
                </tr>
                <?php if(!empty($name)): ?>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">I am <?php echo e($name); ?> </span></td>
                </tr>
                <?php endif; ?>
                <?php if(!empty($email)): ?>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"> <strong>Email: </strong><?php echo e($email); ?>  </span></td>
                </tr>
                <?php endif; ?>
                <?php if(!empty($phone_number)): ?>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"> <strong>Phone: </strong> <?php echo e($phone_number); ?>  </span></td>
                </tr>
                <?php endif; ?>
                <?php if(!empty($subject)): ?>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"> <strong>Subject: </strong> <?php echo e($subject); ?>  </span></td>
                </tr>
                <?php endif; ?>
                <?php if(!empty($contact_message)): ?>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"> <strong>Message: </strong> <?php echo e($contact_message); ?>  </span></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="4" align="center" class="pad_01" bgcolor="#00407c" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-style:italic; color: #888888; line-height:18px; padding:20px 24px 10px; text-align:center;"><img src="https://stage.purplestairs.com/assets/be/images/purplestairs-ftr-png.png" alt="PurpleStairs" width="148"></td>
                </tr>

                 <tr>
                    <td colspan="4" bgcolor="#fbfaff"  height="30" style="border-bottom:30px solid #fbfaff;"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>
<?php /**PATH /var/www/html/app/resources/views/mail/contact.blade.php ENDPATH**/ ?>