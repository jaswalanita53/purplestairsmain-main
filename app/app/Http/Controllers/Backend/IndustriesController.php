<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustriesController extends Controller
{
    public $Industry;
    public function __construct(Industry $Industry)
	{
		$this->Industry = $Industry;
	
	}

    public function industriesList()
	{		
		$industriesList = $this->Industry->latest()->get();       
		return view('backend.viewIndustries', compact('industriesList'));
	}

    public function getIndustries()
	{
		$industries = $this->Industry;       
		return view('backend.addIndustries', compact('industries'));
	}

    public function postIndustries(Request $request)       
	{
		$this->validate($request,[
			'name'   => 'required'			
		],
		[			
			'name.required'   => 'Title field is required'			
		]);
        $checkdata = $this->Industry->where('name','=',$request->name)->first();
        if(isset($checkdata['name']) == $request->name){
            return redirect('industries')->with('update','Record already excist!');
        }else{
            $industries = $this->Industry;        
            $industries->name = $request->name;	
            $industries->status = $request->status;
            $industries->save();
            return redirect('industries')->with('success','Successfully Saved');
        }		
	}

    public function getIndustriesById($id)
	{
		$industries = $this->Industry->find($id);
		return view('backend.addIndustries',compact('industries'));
	}

    public function postIndustriesById($id,Request $request)
	{
		$industries = $this->Industry->find($id);
		$industries->name = $request->name;	
		$industries->status = $request->status;
		$industries->save();
		return redirect('industries')->with('update','Successfully Updated');
	}

    public function delete(Request $request)
	{       
		$res = $this->Industry->find($request['delId'])->delete();
		session()->flash('delete', 'Successfully Deleted');
		echo json_encode(['status' => $res]);
		// return redirect('industries')->with('delete','Successfully Deleted');
	}
}
