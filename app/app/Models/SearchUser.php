<?php

namespace App\Models;
// 86a2kb39t
use Illuminate\Database\Eloquent\Model;

class SearchUser extends Model
{
    protected $table = 'search_user';

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }
    public function searches(){
        return $this->belongsToOne(Search::class);
    }
}
