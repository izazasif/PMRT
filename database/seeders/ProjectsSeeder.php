<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Projects;
use DB;
use Carbon\Carbon;
class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('projects')->insert([[
            'id'        => 1,
            'name'      => 'Robi EB Solution',
    		'client_spoke_name'     => 'Test',
            'client_spoke_mobile'     => '01733333333',
    		'client_spoke_email'    => 'test@gmail.com',
    		'miaki_spoke_name' => 'Yousuf khan Sumon',
            'miaki_spoke_mobile'    => '01722222222',
            'miaki_spoke_email'    => 'sumon@miaki.co',
            'customer_name'    => 'Robi',
            'srs_pdf'    => 'test.pdf ',
            'ui_ux_link'    => 'miaki.co',
            'rep_link'    => 'miaki.co',
            'timeline'    => '2023-04-12 14:30:00',
            'remarks'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'project_stage_id'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	]]);
    }
}
