<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industries = [
            'Healthcare',
            'Real Estate',
            'Law',
            'Accounting'
        ];

        foreach($industries as $industry){
            Industry::create([
                'name' => $industry
            ]);
        }
    }
}
