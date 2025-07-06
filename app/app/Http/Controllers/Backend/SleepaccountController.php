<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Session;

class SleepaccountController extends Controller
{
   
    public function index()
    {
        return view('backend.users.sleep_list');
    }

    public function candidate_list()
    {
        return view('backend.users.sleep_candidate_list');
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
        // $_employers_ = User::select();
        $_employers_ = \DB::table('users');
        // $_employers_->whereNotNull('deleted_at');
        $_employers_->where('user_type', 'employer');
        $_employers_->whereRaw('(select count(id) from deletes where user_id=users.id and type="sleep") > 0');
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

        $totalData = \DB::table('users')->whereRaw('(select count(id) from deletes where user_id=users.id and type="sleep") > 0')->get()->count(); // whereNotNull('deleted_at')->

        $response = [];
        foreach ($final_data as $key => $user) {
            $row = array();

            $row['id'] = $user->id;
            $row['name'] = $user->name;
            $row['email'] = $user->email;
            $row['user_type'] = ucfirst($user->user_type);
            $row['date'] = date('m-d-Y H:i A', strtotime($user->created_at));
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
    public function dataCandidate(Request $request)
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
        // $_employers_ = User::select();
        $_employers_ = \DB::table('users');
        $_employers_->where('user_type', 'candidate');
        // $_employers_->whereNotNull('deleted_at');
        $_employers_->whereRaw('(select count(id) from deletes where user_id=users.id and type="sleep") > 0');
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

        $totalData = \DB::table('users')->whereRaw('(select count(id) from deletes where user_id=users.id and type="sleep") > 0')->get()->count(); // whereNotNull('deleted_at')->

        $response = [];
        foreach ($final_data as $key => $user) {
            $row = array();

            $row['id'] = $user->id;
            $row['name'] = $user->name;
            $row['email'] = $user->email;
            $row['user_type'] = ucfirst($user->user_type);
            $row['date'] = date('m-d-Y H:i A', strtotime($user->created_at));
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

    public function activate($id)
    {
        $user = \DB::table('users')->where('id', $id)->first();
        $deletes = \DB::table('deletes')->where('user_id', $id)->where('type', 'sleep')->first();
        if($user->user_type=='employer'){
        $deletes = \DB::table('deletes')->where('user_id', $id)->where('type', 'delete')->first();
        }

        if ($user && $deletes) {
            \DB::table('users')
              ->where('id', $id)
              ->update(['deleted_at' => null]);
            \DB::table('deletes')->where('user_id', $id)->where('type', 'sleep')->delete();
            if($user->user_type=='employer'){
                return redirect('admin/employers')->with('success','User Activated!');
                }
            return redirect('admin/sleep_account')->with('success','User Activated!');

        }
        return redirect('admin/sleep_account')->with('delete','User Not Found!');
    }
}
