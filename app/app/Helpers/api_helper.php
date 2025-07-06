<?php
namespace App\Helpers;
/**
 * 
 */
class Api_helper
{

	function api_call($api_endpoint, $data=null, $method = 'GET') {

		$client = new \GuzzleHttp\Client();

        $headers = [
            'Content-Type'=> 'application/json',
            'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
        ];	

        $request_options = array(
        	'headers' => $headers
        );

        if ($method == 'POST' && !empty($body)) {
        	$request_options['body'] = $body;
        }

    	/*$response = $client->request($method, $api_endpoint, $request_options);
        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);*/
	}
}
?>