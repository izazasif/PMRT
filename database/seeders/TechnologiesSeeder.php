<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technologies;
use DB;
use Carbon\Carbon;
class TechnologiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('technologies')->insert([[
            'id'        => 1,
            'name'      => 'PHP',
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 2,
            'name'      => 'PYTHON',
            'created_at' => $now,
            'updated_at' => $now,
            
    	]]);
    }
}
