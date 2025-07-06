<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $guarded;
    
    public function candidate(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
