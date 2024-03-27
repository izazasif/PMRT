<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Developer_Skills;
use DB;
use Carbon\Carbon;

class DeveloperSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('developer__skills')->insert([[
            'id'        => 1,
            'developer_id'      => 1,
            'technology_id'      => 1,
            'expertise_level'      => 'Beginner',
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 2,
            'developer_id'      => 2,
            'technology_id'      => 1,
            'expertise_level'      => 'Mid',
            'created_at' => $now,
            'updated_at' => $now,
            
    	]]);
    }
}
