<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;

class CompanyStep4 extends Component
{
    public $plan1_amount;
    public $plan1_period;

    public $plan2_amount;
    public $plan2_period;

    public function mount()
    {
        $this->plan1_amount = 299;
        $this->plan1_period = 'month';

        $this->plan2_amount = 749;
        $this->plan2_period = 'month';
        $user = Auth::user();
        $user->current_step = 3;
        if($user->step_reached<3){
            $user->step_reached=3;
        }
        $user->save();

    }

    public function render()
    {
        return view('livewire.company-step4');
    }

    public function updatePlan($is_checked, $element) {
        if(!$is_checked) {
            if($element == "price-info-first") {
                $this->plan1_amount = 299;
                $this->plan1_period = 'month';
            } else {
                $this->plan2_amount = 749;
                $this->plan2_period = 'month';
            }
        } else {
            if($element == "price-info-first") {
                $this->plan1_amount = 2999;
                $this->plan1_period = 'year';
            } else {
                $this->plan2_amount = 8500;
                $this->plan2_period = 'year';
            }
        }

        return response()->json();
    }

    public function choosePlan($plan)
    {
        $plan_data = array();
        if ($plan == 1) {
            $plan_data = array(
                'amount' => $this->plan1_amount,
                'plan'  => 1,
                'period' => $this->plan1_period,
            );
        } else {
            $plan_data = array(
                'amount' => $this->plan2_amount,
                'plan'  => 2,
                'period' => $this->plan2_period,
            );
        }
        $user = Auth::user();
        $user->plan = json_encode($plan_data);
        $user->save();

        \Session::put('plan', $plan_data);
        // $this->emit('choose_plan', $plan_data);
        return redirect(route('companystep5'),'refresh');
    }
}
