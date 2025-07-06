<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class ValidUSZipCode implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);
        try {
            $response = $client->request('GET', 'US/'.$value);
            $data = json_decode($response->getBody(), true);
            return isset($data['country']) && $data['country'] === 'United States';
        } catch (\Throwable $th) {
            return false;
        }
    }



    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function message()
    {
        return 'The :attribute is not a valid US ZIP code.';
    }
}
