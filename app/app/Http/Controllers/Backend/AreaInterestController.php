<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Interest;

class AreaInterestController extends Controller
{
    public $Interest;
    public function __construct(Interest $Interest)
	{
		$this->Interest = $Interest;
	}

    public function areaInterestList()
	{		
		$areaInterestList = $this->Interest->latest()->get();       
		return view('backend.viewAreaInterest', compact('areaInterestList'));
	}

    public function getAreaInterest()
	{
		$areaInterest = $this->Interest;       
		return view('backend.addAreaInterest', compact('areaInterest'));
	}

    public function postAreaInterest(Request $request)       
	{
		$this->validate($request,[
			'name'   => 'required'			
		],
		[			
			'name.required'   => 'Title field is required'			
		]);
        $checkdata = $this->Interest->where('name','=',$request->name)->first();
        if(isset($checkdata['name']) == $request->name){
            return redirect('areaInterest')->with('update','Record already excist!');
        }else{
            $areaInterest = $this->Interest;        
            $areaInterest->name = $request->name;
            $areaInterest->status = $request->status;
            $areaInterest->save();
            return redirect('areaInterest')->with('success','Successfully Saved');
        }		
	}

    public function getAreaInterestById($id)
	{
		$areaInterest = $this->Interest->find($id);
		return view('backend.addAreaInterest',compact('areaInterest'));
	}

    public function postAreaInterestById($id,Request $request)
	{
		$areaInterest = $this->Interest->find($id);
		$areaInterest->name = $request->name;	
		$areaInterest->status = $request->status;
		$areaInterest->save();
		return redirect('areaInterest')->with('update','Successfully Updated');
	}

    public function delete(Request $request)
	{       
		$this->Interest->find($request['delId'])->delete();
		return redirect('areaInterest')->with('delete','Successfully Deleted');
	}
}
