<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Yajra\DataTables\DataTables;



use Session;

class AbandonedUserController extends Controller
{

    public function index()
    {
        return view('backend.users.abandoned-users');
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
        $_employers_ = User::select();
        $_employers_->whereNull('deleted_at');
        $_employers_->where('status', 0);
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
            if(!empty($odr)){
            $_employers_->orderBy($order_columns[$odr['column']], $odr['dir']);
        }
          }
        }
        $_employers_->offset($offset)->limit($limit);
        $final_data = $_employers_->get();
        // print_r(\DB::getQueryLog());

        $totalData = User::where('status', 0)->whereNull('deleted_at')->get()->count();

        $response = [];
        foreach ($final_data as $key => $user) {
            $row = array();

            $row['id'] = $user->id;
            $row['name'] = substr($user->name, 0, 80);
            $row['email'] = $user->email;
            $row['user_type'] =strtoupper($user->user_type);
            $row['date'] = date('m-d-Y H:i A', strtotime($user->created_at));
            $row['status'] = 'Inactive';
            if($user->user_type=='candidate'){
                $row['status']='Incomplete';
            }


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
