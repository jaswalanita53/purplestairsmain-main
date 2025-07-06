<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Yajra\DataTables\DataTables;



use Session;

class InvitedUserController extends Controller
{

    public function index()
    {
        return view('backend.users.invited-users');
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

        $employers = User::all();
        \DB::enableQueryLog();
        $_employers_ = User::select('users.*', \DB::raw('(select last_matches_on from employer_tracking where employer_id=users.id) as last_matches_on'), \DB::raw('(select last_unmask_req from employer_tracking where employer_id=users.id) as last_unmask_req'), \DB::raw('(select company_name from companies where user_id=users.id) as company_name'), \DB::raw('(select count(id) from subscriptions where user_id=users.id) as subcribe_status'));
        $_employers_->whereNull('deleted_at');
        $_employers_->where('user_type', 'employer');
        $_employers_->where('reference','!=', 0);
       /// $_employers_->whereRaw('(select count(id) from subscriptions where user_id=users.id) > 0');
        $extra_where = [];
        if(!empty($search['value'])) {
          $search_query = "(";
          foreach ($columns as $k => $field) {
            if($k > 0) $search_query .= " OR ";
            $search_query .= $field." LIKE '%".$search['value']."%'";
          }
          $search_query .= ")";
          // $extra_where[] = $search_query;
          $_employers_->whereRaw($search_query);
        }

        $_order = [];
        if(!empty($order)) {
          foreach ($order as $f => $odr) {
            // $_order[$order_columns[$odr['column']]] = $odr['dir'];
            $_employers_->orderBy($order_columns[$odr['column']], $odr['dir']);
          }
        }
        $_employers_->offset($offset)->limit($limit);
        $final_data = $_employers_->get();
        // print_r(\DB::getQueryLog());
        //->whereRaw('(select count(id) from subscriptions where user_id=users.id) > 0')

        $totalData = User::where('user_type', 'employer')->where('reference', 0)->whereNull('deleted_at')->get()->count();

        $response = [];
        foreach ($final_data as $key => $user) {
            $row = array();

            $row['id'] = $user->id;
            $row['company'] = $user->company_name;
            $row['name'] = $user->name;
            $row['email'] = $user->email;
            $row['date'] = date('m-d-Y h:i A', strtotime($user->created_at));

            // task - 8678fd0em
            $now = time();
            $date1 = strtotime($user->last_matches_on);
            $datediff1 = $now - $date1;

            $date2 = strtotime($user->last_unmask_req);
            $datediff2 = $now - $date2;
            $invited_by_email="N/A";
            $invited_by_email=User::find($user->reference);
            if(!empty($invited_by_email->email)){
                $invited_by_email=$invited_by_email->email;
            }
            $row['invited_by_email'] = $invited_by_email;
            $row['invited_by'] = $user->reference;
            $row['match_days'] = round($datediff1 / (60 * 60 * 24));
            $row['last_unmask_req'] = ($user->last_unmask_req) ? date('m-d-Y h:i A', strtotime($user->last_unmask_req)) : 'N/A';
            $row['request_days'] = round($datediff2 / (60 * 60 * 24));
            $row['subcribe_status'] = $user->subcribe_status;
            // task - 8678fd0em end

            $row['status'] = $user->status;

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

    public function active($id)
    {
        date_default_timezone_set('UTC');
        $user = User::find($id);
        $old_status = $user->status;
        if ($user) {

            $name = explode(' ', trim($user->name));
            $data = array('name' => $name[0]);
            \Mail::send(['html' => 'mail.employer_approved'], $data, function ($message) use ($user) {
                $message->to($user->email, 'Purple Stairs')->subject('Purple Stairs Account Approval');
                $message->from('info@purplestairs.com', 'Purple Stairs');
            });

            $user->status = 1;
            $user->approved_date = date('Y-m-d H:i:s'); // task - 86a2kkdyc
            $user->save();
            return redirect('admin/invited-users')->with('success','User Activated!');
        } else {
            return redirect('admin/invited-users')->with('errors','User Not Found!');
        }
    }

}
