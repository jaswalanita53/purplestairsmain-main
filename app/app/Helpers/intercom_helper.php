<?php
if (!function_exists('create_tag')) {
    function intercom_api($url, $method='POST', $parameter = [])
    {
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('INTERCOM_TOKEN'),
            'Intercom-Version' => '2.11'
        ];

        $response = $client->request($method, $url, $parameter);
        // $tagstatusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true); 
        return $content;
    }
}

if (!function_exists('create_candidate_contact')) {
    function create_candidate_contact($candid, $return_bool = false) {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('INTERCOM_TOKEN'),
            'Intercom-Version' => '2.11'
        ];

        $contact_message = "";
        $candidate_tag = \DB::table('roles')->where('role', 'candidate')->first();
        
        $tag_url = env('INTERCOM_URL') . "tags";
        if ($candidate_tag->intercom_tagid == null || $candidate_tag->intercom_tagid == '') {
            $tag_data = json_encode(["name" => 'Candidate']);
            $parameters = ['body' => $tag_data,'headers' => $headers];
            $tagcontent = intercom_api($tag_url, 'POST', $parameters);

            if ($tagcontent['id']) {
                \DB::table('roles')->where('role', 'candidate')->update(['intercom_tagid' => $tagcontent['id']]);
            }
        }
        
        $emp_err_cnt = 0;
        set_time_limit(0);
        
        $request_url = env('INTERCOM_URL') . "contacts";
        $method = "POST";
        if ($candid->intercom_id) {
            $method = "PUT";
            $request_url = env('INTERCOM_URL') . "contacts/" . $candid->intercom_id;
        }

        $phone = null;
        if($candid->personal) {
            if($candid->personal->phone) {
                $phone = str_replace([' ','(',')','-'], "", $candid->personal->phone);
                $phone = '+1'.$phone;
            }
        }

        $payload = array(
            "role" => $candid->user_type,
            "email" => $candid->email,
            "phone" => $phone,
            "name" => $candid->name,
            "avatar" => $candid->profile_photo_path,
            "signed_up_at" => $candid->created_at,
            "last_seen_at" => $candid->last_login,
            "unsubscribed_from_emails" => true
        );
            
        try {
            $parameters = ['body' => json_encode($payload),'headers' => $headers];
            $content = intercom_api($request_url, $method, $parameters);

            if ($content['id']) {
                $candid->intercom_id = $content['id'];
                $candid->save();

                // ADD ROLE TAG TO USER-INTERCOM
                $ctag_data = ["id" => $candidate_tag->intercom_tagid];

                $tagc_url = env('INTERCOM_URL') . "contacts/" . $candid->intercom_id . "/tags";
                $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                $content = intercom_api($tagc_url, 'POST', $parameters);
                // ADD ROLE TAG TO USER-INTERCOM END
            }
        } catch(\GuzzleHttp\Exception\ClientException $e) {
            $message_string = json_decode($e->getResponse()->getBody(), true);
            $errors = $message_string['errors'];
            $err_arr = array_column($errors, "message");
            $contact_message .= "<b>".$candid->name ."</b> : ". implode(' | ', $err_arr);
            $emp_err_cnt++;
            // if($candid->id != '57') { dd($message_string, $candid->id, $payload); }

            if (in_array('phone is invalid', $err_arr)) {
                $payload['phone'] = null;

                $parameters = ['body' => json_encode($payload),'headers' => $headers];
                $content = intercom_api($request_url, $method, $parameters);

                if ($content['id']) {
                    $emp_err_cnt--;

                    $candid->intercom_id = $content['id'];
                    $candid->save();

                    // ADD ROLE TAG TO USER-INTERCOM
                    $ctag_data = ["id" => $candidate_tag->intercom_tagid];

                    $tagc_url = env('INTERCOM_URL') . "contacts/" . $candid->intercom_id . "/tags";
                    $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                    $content = intercom_api($tagc_url, 'POST', $parameters);
                }
            }
        }
        
        if($return_bool) { return true; }
        else {
            if($emp_err_cnt) { 
                // dd($contact_message);
                echo json_encode(['message' => $contact_message]);
            } else {
                echo json_encode(['message' => "Intercom migration successfully completed."]);
            }
        }
    }
}

if (!function_exists('create_employer_contact')) {
    function create_employer_contact($emp, $return_bool = false) {
        $_emp = App\Models\User::select(\DB::raw('(select group_concat(coupon_code) from subscriptions where user_id = users.id) as coupon_codes'))->where('id', $emp->id)->get();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('INTERCOM_TOKEN'),
            'Intercom-Version' => '2.11'
        ];

        $contact_message = "";
        $employers_tag = \DB::table('roles')->where('role', 'employer')->first();
        
        $tag_url = env('INTERCOM_URL') . "tags";
        if ($employers_tag->intercom_tagid == null || $employers_tag->intercom_tagid == '') {
            $tag_data = json_encode(["name" => 'Employer']);
            $parameters = ['body' => $tag_data,'headers' => $headers];
            $tagcontent = intercom_api($tag_url, 'POST', $parameters);

            if ($tagcontent['id']) {
                \DB::table('roles')->where('role', 'employer')->update(['intercom_tagid' => $tagcontent['id']]);
            }
        }
        
        $emp_err_cnt = 0;
        set_time_limit(0);
        // if employer subscribed with any coupon codes
        $coupons = isset($_emp->coupon_codes) ? $_emp->coupon_codes : '';
        $tags = [];
        if ($coupons) {
            $tags = explode(',', $coupons);
            $tags = array_filter($tags);

            $method = "POST";

            foreach ($tags as $tk => $tag) {
                $discount = App\Models\Discount::where('coupon_code', 'like', '%' . $tag . '%')->first();
                if ($discount->intercom_tagid == null || $discount->intercom_tagid == '') {
                    $tag_data = json_encode(["name" => $tag]);
                    $parameters = ['body' => $tag_data,'headers' => $headers];
                    $tagcontent = intercom_api($tag_url, 'POST', $parameters);

                    if ($tagcontent['id']) {
                        $discount->intercom_tagid = $tagcontent['id'];
                        $discount->save();
                    }
                }
            }
        }

        $request_url = env('INTERCOM_URL') . "contacts";
        $method = "POST";
        if ($emp->intercom_id) {
            $method = "PUT";
            $request_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id;
        }

        $phone = null;
        if (isset($emp->company)) {
            if($emp->company->company_phone) {
                $phone = str_replace([' ','(',')','-'], "", $emp->company->company_phone);
                $phone = '+1'.$phone;
            }
        }

        $payload = array(
            "role" => $emp->user_type,
            "email" => $emp->email,
            "phone" => $phone,
            "name" => $emp->name,
            "avatar" => $emp->profile_photo_path,
            "signed_up_at" => $emp->created_at,
            "last_seen_at" => $emp->last_login,
            "unsubscribed_from_emails" => true
        );
            
        try {
            $parameters = ['body' => json_encode($payload),'headers' => $headers];
            $content = intercom_api($request_url, $method, $parameters);
            /*\Mail::raw(json_encode($content), function ($message) {
              $message->to('eptdeveloper@gmail.com')
                ->subject('Intercom');
            });*/
            if ($content['id']) {
                $emp->intercom_id = $content['id'];
                $emp->save();

                // ADD ROLE TAG TO USER-INTERCOM
                $ctag_data = ["id" => $employers_tag->intercom_tagid];

                $tagc_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id . "/tags";
                $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                $content = intercom_api($tagc_url, 'POST', $parameters);
                // ADD ROLE TAG TO USER-INTERCOM END

                // ADD DISCOUNT TAG TO USER-INTERCOM
                foreach ($tags as $tk => $tag) {
                    $discount = App\Models\Discount::where('coupon_code', 'like', '%' . $tag . '%')->first();
                    if ($discount->intercom_tagid == null || $discount->intercom_tagid == '') {
                        $ctag_data = ["id" => $discount->intercom_tagid];
                        $tagc_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id . "/tags";
                        $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                        $content = intercom_api($tagc_url, 'POST', $parameters);
                    }
                }
                // ADD DISCOUNT TAG TO USER-INTERCOM END
            }
        } catch(\GuzzleHttp\Exception\ClientException $e) {
            $message_string = json_decode($e->getResponse()->getBody(), true);
            $errors = $message_string['errors'];
            $err_arr = array_column($errors, "message");
            $contact_message .= "<b>".$emp->name ."</b> : ". implode(' | ', $err_arr);
            $emp_err_cnt++;
            // if($emp->id != '57') { dd($message_string, $emp->id, $payload); }
            \Mail::raw($contact_message, function ($message) {
              $message->to('eptdeveloper@gmail.com')
                ->subject('Intercom');
            });
            if (in_array('phone is invalid', $err_arr)) {
                $payload['phone'] = null;

                $parameters = ['body' => json_encode($payload),'headers' => $headers];
                $content = intercom_api($request_url, $method, $parameters);

                if ($content['id']) {
                    $emp_err_cnt--;

                    $emp->intercom_id = $content['id'];
                    $emp->save();

                    // ADD ROLE TAG TO USER-INTERCOM
                    $ctag_data = ["id" => $employers_tag->intercom_tagid];

                    $tagc_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id . "/tags";
                    $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                    $content = intercom_api($tagc_url, 'POST', $parameters);
                    // ADD ROLE TAG TO USER-INTERCOM END

                    // ADD DISCOUNT TAG TO USER-INTERCOM
                    foreach ($tags as $tk => $tag) {
                        $discount = App\Models\Discount::where('coupon_code', 'like', '%' . $tag . '%')->first();
                        if ($discount->intercom_tagid == null || $discount->intercom_tagid == '') {
                            $ctag_data = ["id" => $discount->intercom_tagid];
                            $tagc_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id . "/tags";
                            $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                            $content = intercom_api($tagc_url, 'POST', $parameters);
                        }
                    }
                    // ADD DISCOUNT TAG TO USER-INTERCOM END
                }
            }
        }
        
        if($return_bool) {
            return true;
        } else {
            if($emp_err_cnt) { 
                echo json_encode(['message' => $contact_message]);
            } else {
                echo json_encode(['message' => "Intercom migration successfully completed."]);
            }
        }
    }
}