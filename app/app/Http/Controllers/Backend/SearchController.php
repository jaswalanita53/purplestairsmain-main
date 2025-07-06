<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Industry;
use App\Models\Interest;
use App\Models\Skill;
use App\Models\Language;

class SearchController extends Controller
{
    public $Industry;
	public $Interest;
	public $Skill;
	public $Language;
    public function __construct(Industry $Industry, Interest $Interest, Skill $Skill, Language $Language)
	{
		$this->Industry = $Industry;
		$this->Interest = $Interest;
		$this->Skill = $Skill;
		$this->Language = $Language;
	}

    public function searchIndustries(Request $request)
	{
		$string = $request->input('query');
		$industriesList = $this->Industry
		->Where('industries.name', 'LIKE', '%'.$string.'%')
		//->orWhere('industries.description', 'LIKE', '%'.$string.'%')	 
		->select('industries.*')
		->get();

		return view('backend.viewIndustries', compact('industriesList','string'));
	}

	public function searchAreaInterest(Request $request)
	{
		$string = $request->input('query');
		$areaInterestList = $this->Interest
		->Where('interests.name', 'LIKE', '%'.$string.'%')
		//->orWhere('interests.description', 'LIKE', '%'.$string.'%')	 
		->select('interests.*')
		->get();

		return view('backend.viewAreaInterest', compact('areaInterestList','string'));
	}

	public function searchHardSkills(Request $request)
	{
		$string = $request->input('query');
		$skillList = $this->Skill
		->Where('skills.name', 'LIKE', '%'.$string.'%')
		//->orWhere('skills.description', 'LIKE', '%'.$string.'%')	 
		->select('skills.*')
		->where('skill_type', 'hard_skills')
		->get();

		return view('backend.viewHardSkills', compact('skillList','string'));
	}

	public function searchSoftSkills(Request $request)
	{
		$string = $request->input('query');
		$skillList = $this->Skill
		->Where('skills.name', 'LIKE', '%'.$string.'%')
		//->orWhere('skills.description', 'LIKE', '%'.$string.'%')	 
		->select('skills.*')
		->where('skill_type', 'soft_skills')
		->get();

		return view('backend.viewSoftSkills', compact('skillList','string'));
	}

	public function searchLanguages(Request $request)
	{
		$string = $request->input('query');
		$languagesList = $this->Language
		->Where('languages.name', 'LIKE', '%'.$string.'%')
		//->orWhere('languages.description', 'LIKE', '%'.$string.'%')	 
		->select('languages.*')
		->get();

		return view('backend.viewLanguages', compact('languagesList','string'));
	}
}
