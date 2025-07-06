<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Session;

class DeletedaccountController extends Controller
{
   
    public function index()
    {
        return view('backend.users.deleted_list');
    }

    public function candidate_list()
    {
        return view('backend.users.deleted_candidate_list');
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

        \DB::enableQueryLog();
        // $_users_ = User::select('users.*');
        $_users_ = \DB::table('users');
        $_users_->select('users.*');
        $_users_->whereNotNull('deleted_at');
        $_users_->where('user_type', 'employer');
        // $_employers_->where('reference', 0);
        // $_employers_->whereRaw('(select count(id) from subscriptions where user_id=users.id) > 0');
        $extra_where = [];
        if(!empty($search['value'])) {
          $search_query = "(";
          foreach ($columns as $k => $field) {
            if($k > 0) $search_query .= " OR ";
            $search_query .= $field." LIKE '%".$search['value']."%'";
          }
          $search_query .= ")";
          // $extra_where[] = $search_query;
          $_users_->whereRaw($search_query);
        }

        $_order = [];
        if(!empty($order)) {
          foreach ($order as $f => $odr) {
            // $_order[$order_columns[$odr['column']]] = $odr['dir'];
            $_users_->orderBy($order_columns[$odr['column']], $odr['dir']);
          }
        }
        $_users_->offset($offset)->limit($limit);
        $final_data = $_users_->get();
        // print_r(\DB::getQueryLog());

        // $totalData = User::whereNotNull('deleted_at')->get()->count();
        $totalData = \DB::table('users')->whereNotNull('deleted_at')->get()->count();

        $response = [];
        foreach ($final_data as $key => $user) {
            $row = array();

            $row['id'] = $user->id;
            $row['name'] = $user->name;
            $row['email'] = $user->email;
            $row['role'] = $user->user_type;
            $row['date'] = date('m-d-Y h:i A', strtotime($user->created_at));
            $row['del_date'] = date('m-d-Y h:i A', strtotime($user->deleted_at));
            
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

    public function dataCandidate(Request $request)
    {
        $input = $request->all();
        $search         = $input['search'];
        $order_columns  = $input['order_columns'];
        $columns        = $input['cols'];
        $order          = $input['order'];
        $limit          = $input['length'];
        $offset         = $input['start'];

        \DB::enableQueryLog();
        // $_users_ = User::select('users.*');
        $_users_ = \DB::table('users');
        $_users_->select('users.*');
        $_users_->whereNotNull('deleted_at');
        $_users_->where('user_type', 'candidate');
        // $_employers_->where('reference', 0);
        // $_employers_->whereRaw('(select count(id) from subscriptions where user_id=users.id) > 0');
        $extra_where = [];
        if(!empty($search['value'])) {
          $search_query = "(";
          foreach ($columns as $k => $field) {
            if($k > 0) $search_query .= " OR ";
            $search_query .= $field." LIKE '%".$search['value']."%'";
          }
          $search_query .= ")";
          // $extra_where[] = $search_query;
          $_users_->whereRaw($search_query);
        }

        $_order = [];
        if(!empty($order)) {
          foreach ($order as $f => $odr) {
            // $_order[$order_columns[$odr['column']]] = $odr['dir'];
            $_users_->orderBy($order_columns[$odr['column']], $odr['dir']);
          }
        }
        $_users_->offset($offset)->limit($limit);
        $final_data = $_users_->get();
        // print_r(\DB::getQueryLog());

        // $totalData = User::whereNotNull('deleted_at')->get()->count();
        $totalData = \DB::table('users')->whereNotNull('deleted_at')->get()->count();

        $response = [];
        foreach ($final_data as $key => $user) {
            $row = array();

            $row['id'] = $user->id;
            $row['name'] = $user->name;
            $row['email'] = $user->email;
            $row['role'] = $user->user_type;
            $row['date'] = date('m-d-Y h:i A', strtotime($user->created_at));
            $row['del_date'] = date('m-d-Y h:i A', strtotime($user->deleted_at));

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
