<?php
    /*header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");*/

    echo "test";

    mail('eptdeveloper@gmail.com', 'hook call', json_encode($_SERVER));
    /*$fp = fopen( __DIR__."/purple-webhook.txt", "a") or die("Cannot open or create this file");    
    $fwrite = fwrite( $fp, "Successfull-2..");
    fclose($fp);
    
    $KEY = "5jFkdr4oJacp8bPo4ptSKexwujN84xhH";
    $hmac_header = $_SERVER['X-Signature'];
    $inputdata = file_get_contents('php://input');
    $inputs = json_decode($inputdata, true);
    
    function verify_webhook($data, $hmac_header, $key) {
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $key, true));
        $data = array('name'=>"Purple Stais", 'data' => json_encode($_SERVER), 'verify' => ($hmac_header) ? hash_equals($hmac_header, $calculated_hmac) : 'NO');  
        
        if(hash_equals($hmac_header, $calculated_hmac)) {
            $verify = "YES";
            mail('eptdeveloper@gmail.com', 'hook call', json_encode($_SERVER));
            return true;
        }
    }
    
    verify_webhook($inputdata, $hmac_header, $KEY);*/