<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Developer_Skills;
use DB;
use Carbon\Carbon;
class WeeklyReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('weekly_reports')->insert([[
            'id'        => 1,
            'project_id'      => 1,
            'developer_id'      => 1,
            'timeline'      => '2023-04-12 14:30:00',
            'task_completed'      => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 2,
            'project_id'      => 1,
            'developer_id'      => 1,
            'timeline'      => '2023-04-12 14:30:00',
            'task_completed'      => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'created_at' => $now,
            'updated_at' => $now,
            
    	]]);
    }
}
