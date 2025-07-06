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
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:27px 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Hi {{ ucfirst(strtolower($employer)) }},</span></td>
                </tr>
                @php
                    $searches = array_column($new_data, 'search');
                @endphp
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Exciting news! New candidates have signed up on Purple Stairs who match your {{ implode(', ', $searches) }} saved search(es).</span></td>
                </tr>

                @foreach($new_data as $new)
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;">
                        <span style="font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#7e50a7; text-align:left; line-height:22px; font-weight: 700"><a href="{{ url('company/saved-search/' . $new['slug']) }}" style="color: #7e50a7; text-decoration: none;">{{ $new['search'] }}</a></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;">
                        <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" class="devicewidth" width="100%" style="border:solid 1px #dfdfdf;">
                            <tr>
                                <th style="padding:10px; border-right:solid 1px #dfdfdf; border-bottom:solid 1px #dfdfdf; font-size:14px;width: 120px;">Current Position</th>
                                <th style="padding:10px; border-right:solid 1px #dfdfdf; border-bottom:solid 1px #dfdfdf; font-size:14px;">Experience</th>
                                <th style="padding:10px; border-right:solid 1px #dfdfdf; border-bottom:solid 1px #dfdfdf; font-size:14px;">Industries</th>
                                <th style="padding:10px; border-right:solid 1px #dfdfdf; border-bottom:solid 1px #dfdfdf; font-size:14px;">Salary</th>
                                <th width="116" style="padding:10px; border-right:solid 1px #dfdfdf; font-size:14px;">&nbsp;</th>
                            </tr>
                            @foreach($new['new_candidates'] as $candidate)
                            @php
                                $employments = []; $yrs_of_exp = 0; $exp_months = 0;
                                if($candidate->employments->count()) {
                                    $employments = $candidate->employments->toArray();
                                    $st_year = null;
                                    $ed_year = null;

                                    $currently_working = array_values($candidate->employments->where('currently_working', 1)->toArray());
                                    $currently_start_years = (array_column($currently_working, 'start_year'));
                                    $currently_end_years = (array_column($currently_working, 'end_year'));

                                    $manual_records = array_values($candidate->employments->where('currently_working', 0)->toArray());
                                    $manual_start_years = (array_column($manual_records, 'start_year'));
                                    $manual_end_years = (array_column($manual_records, 'end_year'));

                                    $tmp_year = [];
                                    if(count($currently_working)) {
                                        $currently_start_years = array_map(function($element) {
                                                $_yr = substr($element, -4);
                                                return date('Y', strtotime('Jan ' . $_yr));
                                            },
                                            $currently_start_years
                                        );
                                        $c_min_year = min($currently_start_years);
                                        $c_max_year = date('Y');

                                        for($y=$c_min_year; $y<= $c_max_year; $y++) {
                                            $tmp_year[$y] = $y;
                                        }
                                    }

                                    if(count($manual_records)) {
                                        $manual_start_years = array_map(function($element) {
                                                $_yr = substr($element, -4);
                                                return date('Y', strtotime('Jan ' . $_yr));
                                            },
                                            $manual_start_years
                                        );

                                        $manual_end_years = array_map(function($element) {
                                                $_yr = substr($element, -4);
                                                return date('Y', strtotime('Jan ' . $_yr));
                                            },
                                            $manual_end_years
                                        );
                                        $m_min_year = min($manual_start_years);
                                        $m_max_year = max($manual_end_years);

                                        for($y=$m_min_year; $y<= $m_max_year; $y++) {
                                            $tmp_year[$y] = $y;
                                        }
                                    }

                                    if($tmp_year) {
                                        $min_year = min($tmp_year);
                                        $max_year = max($tmp_year);

                                        $yrs_of_exp = $max_year - $min_year;
                                    }
                                }
                            @endphp
                            <tr>
                                <td style="padding:10px; border-right:solid 1px #dfdfdf; border-bottom:solid 1px #dfdfdf; font-size:14px;">{{ $candidate->personal ? $candidate->personal->current_title : '' }}</td>
                                <td style="padding:10px; border-right:solid 1px #dfdfdf; border-bottom:solid 1px #dfdfdf; font-size:14px;">{{$yrs_of_exp}} Yrs Experience</td>
                                <td style="padding:10px; border-right:solid 1px #dfdfdf; border-bottom:solid 1px #dfdfdf; font-size:14px;">
                                    @if (isset($candidate->industries))
                                        {{ $candidate->industries->first() ? $candidate->industries->first()->name : '' }}
                                    @endif
                                </td>
                                <td style="padding:10px; border-right:solid 1px #dfdfdf; border-bottom:solid 1px #dfdfdf; font-size:14px;">Asking Salary: {{ $candidate->personal ? $candidate->personal->salary_range : '' }}</td>
                                <td width="116" bgcolor="#82609f" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:center; line-height:22px; padding:5px 0;">
                                    <a href="{{ url('company/candidate/profile/' . $candidate->id) }}" style="color: white; text-decoration: none; background: #82609f; padding: 5px 0;">View Profile</a>
                                </td>
                            </tr> 
                            @endforeach
                        </table>
                    </td>
                </tr>
                @endforeach

                <tr>
                    <td colspan="4" class="pad_01" style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; text-align:left; line-height:22px; padding:0 24px 20px 24px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000000; text-align:left; line-height:22px;">Purple Stairs<br/>info@purplestairs.com</span></td>
                </tr>    
                <tr>
                    <td colspan="4" align="center" class="pad_01" bgcolor="#00407c" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-style:italic; color: #888888; line-height:18px; padding:20px 24px 10px; text-align:center;"><img src="{{url('/')}}/assets/be/images/purplestairs-ftr-png.png" alt="PurpleStairs" width="148"></td>
                </tr>
                <tr>
                    <td colspan="4" align="center" class="pad_01" bgcolor="#00407c" style="font-family:Arial, Helvetica, sans-serif; font-size: 10px; color: #fff; line-height:18px; padding:0 24px 16px; text-align:center;"><a style="color:#fff; text-decoration:none;" href="{{url('/')}}/faq">FAQ </a> &nbsp; | &nbsp; <a style="color:#fff; text-decoration:none;" href="{{url('/')}}/contact"> CONTACT US </a> &nbsp; | &nbsp; <a style="color:#fff; text-decoration:none;" href="{{url('/')}}/privacy-policy">PRIVACY POLICY</a></td>
                </tr>
                 <tr>
                    <td colspan="4" bgcolor="#fbfaff"  height="30" style="border-bottom:30px solid #fbfaff;"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>