<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'provider_id',
        'provider',
        'email_verified_at',
        'user_type',
        'status',
        'reference',
        'verify_token',
        'tfa_token',
        'tfa_created_dt',
        'alt_email', // task - 86a2hkjbf
        'approved_date', // task - 86a2kkdyc
        'reminder_status',
        'days3_reminder_status',
        'days6_reminder_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isCandidate(){
        return $this->user_type == "candidate";
    }

    public function isEmployer(){
        return $this->user_type == "employer";
    }

    public function isPublished(){
        return $this->status;
    }

    public function industries(){
        return $this->belongsToMany(Industry::class)
        ->withPivot('primary_status')
        ->orderBy('primary_status', 'desc');
    }

    public function interests(){
        return $this->belongsToMany(Interest::class);
    }

    public function educations(){
       return $this->hasMany(Education::class)->whereNotNull('organization_name');
    }

    public function employments(){
        return $this->hasMany(Employment::class)->where(function ($query) {
                        // $query->orWhereNotNull('company_name');
                        // https://app.clickup.com/t/86a1r5zhg?comment=90130024055120&threadedComment=90130024384821
                        // $query->orWhereNotNull('position');
                        // $query->orWhereNotNull('responsibilities');
                        // $query->orWhereNotNull('start_year');
                        // $query->orWhereNotNull('end_year');
                        // $query->orWhereNotNull('accomplishments');
                });
     }

    public function languages(){
        return $this->belongsToMany(Language::class);
     }

    public function references(){
        return $this->hasMany(Reference::class)->where(function ($query) {
                        $query->orWhereNotNull('name');
                        $query->orWhereNotNull('relationship');
                        $query->orWhereNotNull('phone');
                        $query->orWhereNotNull('email');
                });
    }

    public function skills(){
        return $this->belongsToMany(Skill::class);
    }
    public function environments(){
        return $this->belongsToMany(WorkEnvironment::class);
    }
    public function schedules(){
        return $this->belongsToMany(Schedules::class);
    }

    public function compensations(){
        return $this->belongsToMany(Compensation::class);
    }

    public function salaries(){
        return $this->belongsToMany(Salary::class);
    }

    public function ideal_job_attributes(){
        return $this->belongsToMany(IdealJobAttributes::class);
    }


    public function softSkills(){
        return $this->belongsToMany(Skill::class)->where('skill_type','soft_skills');
    }

    public function hardSkills(){
        return $this->belongsToMany(Skill::class)->where('skill_type','hard_skills');
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function personal(){
        return $this->hasOne(Personal::class);
    }

    public function notes(){
        return $this->hasMany(Notes::class);
    }

    public function companies(){
        return $this->belongsToMany(Company::class)->withPivot('position_hiring','message','status','created_at')
                    ->WhereNull('deleted_at');
    }
    public function companiesFoUnmasked(){
        return $this->belongsToMany(Company::class)->withPivot('position_hiring','message','created_at');

    }

    public function companyStatus(){
        if (Auth::user()->reference > 0) {
            $company_id = Company::where('user_id', Auth::user()->reference)->pluck('id')->first();
        } else {
            $company_id = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
        }
        // $company_id = Auth::user()->reference ? Auth::user()->reference : Auth::user()->company->id;
        return $this->belongsToMany(Company::class)
                    ->withPivot('position_hiring','message','status')
                    ->where('company_id',$company_id);
    }

    public function unmasked(){

        return $this->hasMany(CompanyUser::class,'user_id');

    }

    public function companyUsers(){
        if (Auth::user()->reference > 0) {
            $company_id = Company::where('user_id', Auth::user()->reference)->pluck('id')->first();
        } else {
            $company_id = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
        }

        return $this->hasOne(CompanyUser::class)
                ->where('company_id',$company_id)
                ->where('status',1)
                ->WhereNull('deleted_at');
    }

    public function archive_companies(){
        return $this->belongsToMany(Company::class)->withPivot('position_hiring','message','status','created_at')
                    ->WhereNotNull('deleted_at');
    }

    public function pending_unmask_request(){
        return $this->belongsToMany(Company::class)->withPivot('position_hiring','message','status')
                    ->WhereNull('deleted_at')
                    ->where('status',0);
    }

    public function searches(){
        return $this->belongsToMany(Search::class);
    }

    public function delete_status(){
        return $this->hasOne(Delete::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->where('status',1);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function sendEmailVerificationNotification()
    {
        $shuffle_string = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $verify_token = substr(str_shuffle($shuffle_string), 1, 16);

        // Update the user's verify_token in the database
        $this->update(['verify_token' => $verify_token]);

        // Send a custom email using the Mail facade
        $data = ['name' => $this->name, 'token' => $verify_token];
        \Mail::send(['html' => 'mail.verify_email'], $data, function ($message) {
            $message->to($this->email, 'Purple Stairs')->subject('Purple Stairs Verification Email');
            $message->from('info@purplestairs.com', 'Purple Stairs');
        });

        // Notify the user using the custom notification
        // $this->notify(new CustomVerifyEmail($this));
    }

}
