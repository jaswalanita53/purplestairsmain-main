<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;
class Company extends Model
{
    use HasFactory;

    protected $guarded;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notes(){
        return $this->hasMany(Notes::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function companyUsers(){
        if (Auth::user()->reference > 0) {
            $company_id = Company::where('user_id', Auth::user()->reference)->pluck('id')->first();
        } else {
            $company_id = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
        }

        return $this->hasMany(CompanyUser::class)
                ->where('company_id',$company_id);
    }
    public function companyUsersRequest(){

        return $this->hasOne(CompanyUser::class)->where('user_id', Auth::user()->id);

    }
}
