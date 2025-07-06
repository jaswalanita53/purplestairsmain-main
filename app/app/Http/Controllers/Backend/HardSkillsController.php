<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Skill;

class HardSkillsController extends Controller
{
    public $Skill;
    public function __construct(Skill $Skill)
	{
		$this->Skill = $Skill;
	}

    public function hardSkillsList()
	{		
		$skillList = $this->Skill->where('skill_type', 'hard_skills')->latest()->get();       
		return view('backend.viewHardSkills', compact('skillList'));
	}

    public function getHardSkills()
	{
		$hardSkills = $this->Skill->where('skill_type', 'hard_skills');       
		return view('backend.addHardSkills', compact('hardSkills'));
	}

    public function postHardSkills(Request $request)       
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
            $hardSkills = $this->Skill;        
            $hardSkills->name = $request->name;	
            $hardSkills->skill_type = "hard_skills";
            $hardSkills->save();
            return redirect('hardSkills')->with('success','Successfully Saved');
        }		
	}

    public function getHardSkillsById($id)
	{
		$hardSkills = $this->Skill->find($id);
		return view('backend.addHardSkills',compact('hardSkills'));
	}

    public function postHardSkillsById($id,Request $request)
	{
		$hardSkills = $this->Skill->find($id);
		$hardSkills->name = $request->name;	
		$hardSkills->skill_type = "hard_skills";
		$hardSkills->save();
		return redirect('hardSkills')->with('update','Successfully Updated');
	}

    public function delete(Request $request)
	{       
		$this->Skill->find($request['delId'])->delete();
		return redirect('hardSkills')->with('delete','Successfully Deleted');
	}
}
