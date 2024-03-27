<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;
use DB;
use Carbon\Carbon;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('roles')->insert([[
            'id'        => 1,
            'name'      => 'Backend',
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 2,
            'name'      => 'QA Lead',
            'created_at' => $now,
            'updated_at' => $now,
            
    	]]);
    }
}
