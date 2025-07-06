<div class="c-form" style="background:#fbfaff;">
<table align="center" bgcolor="#fbfaff" border="0" cellpadding="0" cellspacing="0" class="devicewidth" width="100%">
    <tr>
        <td>
            <table align="center" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" class="devicewidth" width="620">
                <tr>
                    <td colspan="4" bgcolor="#fbfaff"  height="30" style="border-bottom:30px solid #fbfaff;"></td>
                </tr>
                <tr>
                    <td colspan="4" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size: 30px; color: #585858; text-align:center; line-height:18px; padding:20px 24px 20px 24px; border-bottom:solid 1px #f2f2f2;"><img src="{{url('/')}}/assets/be/images/purplestairs-png.png" alt="Purple Stairs" width="263"></td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:27px 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Hi administrator,</span></td>
                </tr>
                @if(!empty($name))
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">I am {{ ucfirst(strtolower($name)) }} </span></td>
                </tr>
                @endif
                @if(!empty($email))
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"> <strong>Email: </strong>{{$email}}  </span></td>
                </tr>
                @endif
                @if(!empty($phone_number))
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"> <strong>Phone: </strong> {{$phone_number}}  </span></td>
                </tr>
                @endif
                @if(!empty($subject))
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"> <strong>Subject: </strong> {{$subject}}  </span></td>
                </tr>
                @endif
                @if(!empty($contact_message))
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;"> <strong>Message: </strong> {{$contact_message}}  </span></td>
                </tr>
                @endif
                <tr>
                    <td colspan="4" align="center" class="pad_01" bgcolor="#00407c" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-style:italic; color: #888888; line-height:18px; padding:20px 24px 10px; text-align:center;"><img src="{{url('/')}}/assets/be/images/purplestairs-ftr-png.png" alt="PurpleStairs" width="148"></td>
                </tr>

                 <tr>
                    <td colspan="4" bgcolor="#fbfaff"  height="30" style="border-bottom:30px solid #fbfaff;"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>
