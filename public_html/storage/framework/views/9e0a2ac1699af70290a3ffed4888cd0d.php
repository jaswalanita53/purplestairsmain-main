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
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:27px 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Hi <?php echo e($name); ?>,</span></td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"><?php echo e(ucfirst($sender)); ?> has invited you to join PupleStairs. Click the link below to join.</span></td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:center; line-height:50px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:center; line-height:22px;"><a href="<?php echo e(url('/employer/login?ref=' . $ref . '&inv=' . $invitation_id)); ?>" style="color: white; text-decoration: none; background: #82609f; padding: 15px 45px;">Join Now</a></span></td>
                </tr>
<tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Thank you,<br/>Purple Stairs<br/>info@purplestairs.com</span></td>
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
</div><?php /**PATH /var/www/html/app/resources/views/mail/invite.blade.php ENDPATH**/ ?>