<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Skill;

class SoftSkillsController extends Controller
{
    public $Skill;
    public function __construct(Skill $Skill, Request $request)
	{
		$this->Skill = $Skill;		
	}

    public function softSkillsList()
	{		
		$skillList = $this->Skill->where('skill_type', 'soft_skills')->latest()->get();       
		return view('backend.viewSoftSkills', compact('skillList'));
	}

    public function getSoftSkills()
	{
		$softSkills = $this->Skill->where('skill_type', 'soft_skills');       
		return view('backend.addSoftSkills', compact('softSkills'));
	}

    public function postSoftSkills(Request $request)       
	{
		$this->validate($request,[
			'name'   => 'required'			
		],
		[			
			'name.required'   => 'Title field is required'			
		]);
        $checkdata = $this->Skill->where('name','=',$request->name)->first();
        if(isset($checkdata['name']) == $request->name){
            return redirect('hardSkills')->with('update','Record already excist!');
        }else{
            $softSkills = $this->Skill;        
            $softSkills->name = $request->name;	
            $softSkills->skill_type = "soft_skills";
            $softSkills->save();
            return redirect('softSkills')->with('success','Successfully Saved');
        }		
	}

    public function getSoftSkillsById($id)
	{
		$softSkills = $this->Skill->find($id);
		return view('backend.addSoftSkills',compact('softSkills'));
	}

    public function postSoftSkillsById($id,Request $request)
	{
		$softSkills = $this->Skill->find($id);
		$softSkills->name = $request->name;	
		$softSkills->skill_type = "soft_skills";
		$softSkills->save();
		return redirect('softSkills')->with('update','Successfully Updated');
	}

    public function delete(Request $request)
	{       
		$this->Skill->find($request['delId'])->delete();
		return redirect('softSkills')->with('delete','Successfully Deleted');
	}
}
