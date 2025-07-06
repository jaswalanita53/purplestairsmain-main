<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hard_skills = [
            'Figma',
            'Sketch',
            'Photoshop'
        ];

        $soft_skills = [
            'Organized',
            'Timely',
            'Friendly'
        ];

        foreach($hard_skills as $skill){
            Skill::create([
                'name' => $skill,
                'skill_type' => 'hard_skills',
            ]);
        }

        foreach($soft_skills as $skill){
            Skill::create([
                'name' => $skill,
                'skill_type' => 'soft_skills',
            ]);
        }
    }
}
