<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\CompanyUser;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon; //86a2zt9nn



class UpdateRequestCount extends Component
{
    public $company = '';
    public $auth_user;
    public $login_user;

    protected $listeners = ['updateCounts' => '$refresh'];

    public function mount()
    {
        $this->auth_user = Auth::user();
        $this->login_user = Auth::user()->id;

        if ($this->auth_user->reference > 0) {
            $this->company = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
        } else {
            $this->company = Company::where('user_id', $this->login_user)->pluck('id')->first();
        }
    }
    public function render()
    {
        $candidates = User::with(['industries', 'interests', 'educations', 'employments', 'softSkills', 'hardSkills', 'languages', 'references', 'personal', 'companies'])
            ->withTrashed()->where('user_type', 'candidate');
            $company_id=$this->company;
        $requested_count_quary = clone $candidates;
        $requested_count_quary->where('status', 1); // task - 86a0qvr0b
        $requested_count_quary->whereNull('deleted_at'); // task - 86a0qvr0b
        $requested_count = $requested_count_quary->whereHas('companies', function ($q) use ($company_id) {
            return $q->where('company_id', $company_id)
                ->where('status', 0);
        })->count();

        $new_unmask_quary = clone $candidates;
        $new_unmask_quary->where('status', 1); // task - 86a0qvr0b
        $new_unmask_quary->whereNull('deleted_at'); // task - 86a0qvr0b
        $new_unmask_candidates_ = $new_unmask_quary->whereHas('companies', function ($q) use ($company_id) {
            return $q->where('company_id', $company_id)
                ->where('status', 1)->where(\DB::raw("ABS(TIMESTAMPDIFF(HOUR, NOW(), company_user.updated_at))"), "<", 24);
        })->pluck('id');

        // task - 86a1822yc
        $unmasked_ids = \DB::table('new_unmask_status')->where('company_id', $company_id)->pluck('unmask_uid')->toArray();
        foreach ($new_unmask_candidates_ as $nu_key => $nu_val) {
            if (!in_array($nu_val, $unmasked_ids)) {
                \DB::table('new_unmask_status')->insert([
                    'company_id' => $company_id,
                    'unmask_uid' => $nu_val,
                    'status' => 0
                ]);
            }
        }
        // 86a2zt9nn new unmasked
        $new_unmask_candidates = \DB::table('new_unmask_status')->where('company_id', $company_id)->where('status', 0)->get();
        $new_unmask_candidates = \DB::table('new_unmask_status')->where('company_id', $company_id)->where('status', 0)->count();
        // task - 86a1822yc end

        // $requested_count=CompanyUser::where('company_id', $this->company)->where('status',0)->count();
        $unmasked_count=CompanyUser::join('users', 'users.id', '=', 'company_user.user_id')->where('company_user.company_id', $this->company)->where('company_user.status',1)->whereNULL('users.deleted_at')->count(\DB::raw('DISTINCT user_id')); // task - 86a39a9k6
        
        $this->dispatchBrowserEvent('updatedCount', ['count' => $requested_count]);
        return view('livewire.update-request-count',compact('requested_count','unmasked_count','new_unmask_candidates'));
    }
    public function refreshCount()
{
    $requestedCount=CompanyUser::where('company_id', $this->company)->count();
    $this->dispatchBrowserEvent('updatedCount', ['count' => $requestedCount]);
}
}
