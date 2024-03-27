<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectStages;
use DB;
use Carbon\Carbon;
class ProjectStagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('project_stages')->insert([[
            'id'        => 1,
            'name'      => 'Requirements Gathering',
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 2,
            'name'      => 'Requirements Analysis',
            'created_at' => $now,
            'updated_at' => $now,
            
    	]]); 
    }
}
