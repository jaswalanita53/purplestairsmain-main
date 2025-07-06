<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Discount;
use App\Models\User;

use Session;

class DiscountController extends Controller
{
   
    public function index()
    {
        $discounts = Discount::all();  
        return view('backend.discount.list', compact('discounts'));
    }

    public function create()
    {
        return view('backend.discount.add');
    }

    public function data(Request $request)
    {
        $input = $request->all();
        $search         = $input['search'];
        $order_columns  = $input['order_columns'];
        $columns        = $input['cols'];
        $order          = $input['order'];
        $limit          = $input['length'];
        $offset         = $input['start'];

        $discounts = Discount::all();
        $_discounts_ = Discount::select();
        $_discounts_->whereNull('deleted_at');
        $extra_where = [];
        if(!empty($search['value'])) {
          $search_query = "(";
          foreach ($columns as $k => $field) {
            if($k > 0) $search_query .= " OR ";
            $search_query .= $field." LIKE '%".$search['value']."%'";
          }
          $search_query .= ")";
          // $extra_where[] = $search_query;
          $_discounts_->whereRaw($search_query);
        }

        $_order = [];
        if(!empty($order)) {
          foreach ($order as $f => $odr) {
            // $_order[$order_columns[$odr['column']]] = $odr['dir'];
            $_discounts_->orderBy($order_columns[$odr['column']], $odr['dir']);
          }
        }
        $_discounts_->offset($offset)->limit($limit);
        $final_data = $_discounts_->get();

        $totalData = Discount::whereNull('deleted_at')->get()->count();

        // dd($input);
        $response = [];
        foreach ($final_data as $key => $code) {
            $row = array();

            // coupon status 
            $status = $code->status;
            if (date('Y-m-d') > date('Y-m-d', strtotime($code->validate_to))) $status = 2;
            elseif (date('Y-m-d', strtotime($code->validate_from)) > date('Y-m-d')) $status = 3;

            $row['id'] = $code->id;
            $row['coupon_name'] = $code->coupon_code;
            $row['discount'] = $code->discount_value.''.($code->type == 'fixed' ? '($)' : '(%)');
            $row['validity'] = date('m-d-Y', strtotime($code->validate_from)) . ' - ' . date('m-d-Y', strtotime($code->validate_to));
            // $row['status'] = $code->status;
            $row['status'] = $status;

            $response[] = $row;
        }
        
        $json_data = array(
            "draw"            => intval($input['draw']),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $response
        );
        echo json_encode($json_data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules_arr = [
            'coupon_code'   => 'required | string | min: 6 | max: 255 | unique:discounts,coupon_code',
            'discount_type' => 'required | string | max: 50',
            'discount_value'=> 'required | numeric',
            'validity'      => 'required',
            'status'        => 'required',
        ];

        if (!isset($input['one_time_used']) && $input['use_limit']) {
            $rules_arr['use_limit'] = 'numeric';
        }
        $this->validate($request, $rules_arr);

        $validity = $input['validity'];
        $date_explode = explode(' - ', $validity);
        $from_date = date('Y-m-d', strtotime($date_explode[0]));
        $to_date = date('Y-m-d', strtotime($date_explode[1]));
        
        $discount = Discount::create([
            'coupon_code'   => $input['coupon_code'],
            'type'          => $input['discount_type'],
            'discount_value'=> $input['discount_value'],
            'validate_from' => $from_date,
            'validate_to'   => $to_date,
            'one_time_only' => isset($input['one_time_used']) ? $input['one_time_used'] : 0,
            'maximum_allow' => isset($input['use_limit']) ? ($input['use_limit']=='' ? -1 : $input['use_limit']) : 0,
            'status'        => $input['status'],
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'discount_duration'    => $input['discount_duration'],
        ]);

        // task - 86a3d37f9
        if ($discount) {
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('INTERCOM_TOKEN'),
                'Intercom-Version' => '2.11'
            ];
            $ctag_data = ["name" => $input['coupon_code']];

            $tagc_url = env('INTERCOM_URL') . "tags";
            $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
            $content = intercom_api($tagc_url, 'POST', $parameters);

            $discount->intercom_tagid = $content['id'];
            $discount->save();
        }
        // task - 86a3d37f9 end

        return redirect('admin/discount')->with('success','Successfully Saved!');
    }

    public function edit($id)
    {
        $discount = Discount::find($id);
        if ($discount) {
            return view('backend.discount.edit', compact('discount'));
        } else {
            return redirect('admin/discount')->with('errors','Discount Not Found!');
        }
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::find($id);
        $input = $request->all();

        $rules_arr = [
            'coupon_code'   => 'required | string | min: 6 | max: 255 | unique:discounts,coupon_code,'.$id,
            'discount_type' => 'required | string | max: 50',
            'discount_value'=> 'required | numeric',
            'validity'      => 'required',
            'status'        => 'required',
        ];

        if (!isset($input['one_time_used']) && $input['use_limit']) {
            $rules_arr['use_limit'] = 'numeric';
        }
        $this->validate($request, $rules_arr);

        $validity = $input['validity'];
        $date_explode = explode(' - ', $validity);
        $from_date = date('Y-m-d', strtotime($date_explode[0]));
        $to_date = date('Y-m-d', strtotime($date_explode[1]));

        $discount->coupon_code    = $input['coupon_code'];
        $discount->type           = $input['discount_type'];
        $discount->discount_value = $input['discount_value'];
        $discount->validate_from  = $from_date;
        $discount->validate_to    = $to_date;
        $discount->one_time_only  = isset($input['one_time_used']) ? $input['one_time_used'] : 0;
        $discount->maximum_allow  = isset($input['use_limit']) ? $input['use_limit'] : 0;
        $discount->status         = $input['status'];
        $discount->updated_at     = date('Y-m-d H:i:s');
        $discount->discount_duration    = $input['discount_duration'];
        $discount->save();

        // task - 86a3d37f9
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('INTERCOM_TOKEN'),
            'Intercom-Version' => '2.11'
        ];
        $tagc_url = env('INTERCOM_URL') . "tags/";
        $ctag_data = ["name" => $input['coupon_code']];

        if ($discount->intercom_tagid == null || $discount->intercom_tagid == '') {
            $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
            $content = intercom_api($tagc_url, 'POST', $parameters);

            $discount->intercom_tagid = $content['id'];
            $discount->save();
        } else {
            $ctag_data = ["id" => $discount->intercom_tagid];
            $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
            $content = intercom_api($tagc_url, 'POST', $parameters); 

            $discount->intercom_tagid = $content['id'];
            $discount->save();
        }
        // task - 86a3d37f9 end

        return redirect('admin/discount')->with('success','Successfully Updated!');
    }

    public function destroy($id)
    {
        $discount = Discount::find($id);

        if ($discount) {
            // task - 86a3d37f9
            $headers = [
                'Authorization' => 'Bearer ' . env('INTERCOM_TOKEN'),
                'Intercom-Version' => '2.11'
            ];

            if ($discount->intercom_tagid != null) {
                $tagc_url = env('INTERCOM_URL') . "tags/" . $discount->intercom_tagid;
                $parameters = ['headers' => $headers];
                $content = intercom_api($tagc_url, 'DELETE', $parameters); 

                $discount->intercom_tagid = null;
            }
            // task - 86a3d37f9 end
            $discount->deleted_at = date('Y-m-d H:i:s');
            $discount->save();

            echo $discount->coupon_code;
        } else {
            echo '';
        }
    }

    // task - 86a3b0p32
    public function details($id)
    {
        $discount = Discount::find($id);
        if ($discount) {
            return view('backend.discount.employers_list', compact('discount'));
        } else {
            return redirect('admin/discount')->with('errors','Discount Not Found!');
        }
    }
    public function employer_list(Request $request, $discount_id)
    {
        $discount = Discount::find($discount_id);

        if ($discount) {
            $input = $request->all();
            $search         = $input['search'];
            $order_columns  = $input['order_columns'];
            $columns        = $input['cols'];
            $order          = $input['order'];
            $limit          = $input['length'];
            $offset         = $input['start'];

            $employers = User::all();
            \DB::enableQueryLog();
            $_employers_ = User::select('users.*', \DB::raw('(select last_matches_on from employer_tracking where employer_id=users.id) as last_matches_on'), \DB::raw('(select last_unmask_req from employer_tracking where employer_id=users.id) as last_unmask_req'), \DB::raw('(select company_name from companies where user_id=users.id) as company_name'), \DB::raw('(select count(id) from subscriptions where user_id=users.id) as subcribe_status'))->join('subscriptions', 'subscriptions.user_id', '=', 'users.id');
            $_employers_->whereNull('deleted_at');
            $_employers_->where('user_type', 'employer');
            $_employers_->where('reference', 0);
            $_employers_->where('coupon_code', 'LIKE', '%'.$discount->coupon_code.'%');

            $extra_where = [];
            if(!empty($search['value'])) {
              $search_query = "(";
              foreach ($columns as $k => $field) {
                if($k > 0) $search_query .= " OR ";
                $search_query .= $field." LIKE '%".$search['value']."%'";
              }
              $search_query .= ")";
              $_employers_->whereRaw($search_query);
            }

            $_order = [];
            if(!empty($order)) {
              foreach ($order as $f => $odr) {
                $_employers_->orderBy($order_columns[$odr['column']], $odr['dir']);
              }
            }
            $_employers_->offset($offset)->limit($limit);
            $final_data = $_employers_->get();

            $totalData = User::join('subscriptions', 'subscriptions.user_id', '=', 'users.id')->where('user_type', 'employer')->where('reference', 0)->whereNull('deleted_at')->where('coupon_code', 'LIKE', '%'.$discount->coupon_code.'%')->get()->count();
            // dd(\DB::getQueryLog());
            $response = [];
            foreach ($final_data as $key => $user) {
                $row = array();

                $row['id'] = $user->id;
                $row['company'] = $user->company_name;
                $row['name'] = $user->name;
                $row['email'] = $user->email;
                $row['date'] = date('m-d-Y h:i A', strtotime($user->created_at));

                $response[] = $row;
            }

            $json_data = array(
                "draw"            => intval($input['draw']),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalData),
                "data"            => $response
            );
            echo json_encode($json_data);
        }
    }
}
