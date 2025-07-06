<?php
if (!function_exists('fix_url_protocol')) {
    function fix_url_protocol($url)
    {
        if (stripos($url, "http://") === false && stripos($url, "https://") === false) {
           return $url = "http://" . $url;
        }
        else{
            return $url;
        }
    }
}

if (!function_exists('getUserById')) {
    function getUserById($userId) {
        // Retrieve the user by ID from your database or any data source
        // You can use Laravel's Eloquent ORM or any other method you prefer

        // Example using Eloquent:
        $user = \App\Models\User::find($userId);

        // Check if the user exist
        if (!$user) {
            return null; // or handle the error as needed
        }

        // Return the user details
        return $user;
    }
}

if (!function_exists('validateUser')) {
    function validateUser($subscription) {
        $now = date('Y-m-d');
        // 86a2ggtje
        $deleted = \App\Models\Delete::where('user_id',auth()->id())->first();
        if(!empty($deleted->status)){
            session()->flash('error', 'Your account has been deactivated.');
            echo "<script>window.location.href = '" . url('/company/manage-account') . "';</script>";
        }
        // dd($subscription, $deleted, auth()->user()->reference);
        if (!empty($subscription->expiration_date) && date('Y', strtotime($subscription->expiration_date)) > 1970) {
            $expiry_date = date('Y-m-d', strtotime($subscription->expiration_date));
            if ($now >= $expiry_date) {
                session()->flash('error', 'Your subscription plan has expired. To continue, click on a plan below.');
                echo "<script>window.location.href = '" . url('/company/manage-subsciption') . "';</script>";
            }
        } elseif (empty($subscription)) {
            session()->flash('error', 'Your subscription plan has expired. To continue, click on a plan below.');
            echo "<script>window.location.href = '" . url('/company/manage-subsciption') . "';</script>";
        }
    }
}

if (!function_exists('degrees_difference')) {
    function degrees_difference($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
              cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
              cos(deg2rad($theta));

        $dist = acos($dist);
        $dist = rad2deg($dist);

        $distance = $dist * 60  * 1.1515;
        // $distance = $dist / 1.58 ; // 1.609344
        return $distance;
    }
}