<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project_Developer_Assignment;
use DB;
use Carbon\Carbon;
class ProjectdeveloperAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('project__developer__assignments')->insert([[
            'id'        => 1,
            'project_id'      => 1,
            'developer_id'      => 1,
            'role_id'      => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 2,
            'project_id'      => 1,
            'developer_id'      => 2,
            'role_id'      => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	]]);
    }
}
