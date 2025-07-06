<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invited_user extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded;

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
