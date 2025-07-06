<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditcard extends Model
{
    use HasFactory;

    protected $table = "user_cc_data";
    
    protected $guarded;

    public $timestamps = false;
    
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
