<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded;

    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function newMatch()
    {
        return $this->hasMany(NewSearchMatch::class)->where('status', 0);
    }
    public function searchUser()
    {
        return $this->hasMany(SearchUser::class);
    }
}
