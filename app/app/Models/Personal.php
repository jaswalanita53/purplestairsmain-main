<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $guarded;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getLinkedinUrlAttribute($value)
    {
        // Check if the URL starts with "http://" or "https://"
            if(!empty($value)){
        if (strpos($value, 'http://') !== 0 && strpos($value, 'https://') !== 0) {
            // If it doesn't, add "https://" to the beginning
            return 'https://' . $value;
        }
        }

        // If it already has a valid protocol, return it as is

        return $value;
    }
    public function getAdditionalUrlAttribute($value)
    {
        // Check if the URL starts with "http://" or "https://"
            if(!empty($value)){
                if (strpos($value, 'http://') !== 0 && strpos($value, 'https://') !== 0) {
                    // If it doesn't, add "https://" to the beginning
                    return 'https://' . $value;
                }
                }

        // If it already has a valid protocol, return it as is

        return $value;
    }
}
