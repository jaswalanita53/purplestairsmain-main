<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class ValidUrl implements Rule
{
    public function passes($attribute, $value)
    {
        if(!empty($value)){
        return strpos($value, '.') !== false;
    }
    return true;
    }

    public function message()
    {
        return 'The :attribute is not a valid URL.';
    }
}
