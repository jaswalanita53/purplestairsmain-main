<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Language;

class LanguagesController extends Controller
{
    public $Language;
    public function __construct(Language $Language)
	{
		$this->Language = $Language;
	}

    public function languagesList()
	{		
		$languagesList = $this->Language->latest()->get();       
		return view('backend.viewLanguages', compact('languagesList'));
	}

    public function getLanguages()
	{
		$languages = $this->Language;       
		return view('backend.addLanguages', compact('languages'));
	}

    public function postLanguages(Request $request)       
	{
		$this->validate($request,[
			'name'   => 'required'			
		],
		[			
			'name.required'   => 'Title field is required'			
		]);
        $checkdata = $this->Language->where('name','=',$request->name)->first();
        if(isset($checkdata['name']) == $request->name){
            return redirect('languages')->with('update','Record already excist!');
        }else{
            $languages = $this->Language;        
            $languages->name = $request->name;	
            $languages->status = $request->status;
            $languages->save();
            return redirect('languages')->with('success','Successfully Saved');
        }		
	}

    public function getLanguagesById($id)
	{
		$languages = $this->Language->find($id);
		return view('backend.addLanguages',compact('languages'));
	}

    public function postLanguagesById($id,Request $request)
	{
		$languages = $this->Language->find($id);
		$languages->name = $request->name;	
		$languages->status = $request->status;
		$languages->save();
		return redirect('languages')->with('update','Successfully Updated');
	}

    public function delete(Request $request)
	{       
		$this->Language->find($request['delId'])->delete();
		return redirect('languages')->with('delete','Successfully Deleted');
	}
}
