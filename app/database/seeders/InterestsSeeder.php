<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            'Finance',
            'Marketing',
            'Operations',
            'Sales'
        ];

        foreach($interests as $interest){
            Interest::create([
                'name' => $interest
            ]);
        }
    }
}
