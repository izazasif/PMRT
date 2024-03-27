<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $now = Carbon::now();
        DB::table('users')->insert([[
            'id'        => 1,
            'type'      => 'developer',
    		'name'     => 'Abdur Razzak',
            'employee_id'     => 'MML-001',
    		'email'    => 'abdur.razzak@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '01722222222',
            
             'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[

            'id'        => 2,
            'type'      => 'leader',
    		'name'     => 'Shakil Ahamed',
            'employee_id'     => 'MML-002',
    		'email'    => 'shakil.ahamed@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '01722222232',
            'points'            => 0,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ],[
            'id'        => 3,
            'type'      => 'developer',
    		'name'     => 'Farhana Urmi',
            'employee_id'     => 'MML-003',
    		'email'    => 'farhana.urmi@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '0172245664',
            'points'            => 10,
            'description'    => 'that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 4,
            'type'      => 'developer',
    		'name'     => 'Huzaifa Ahmed',
            'employee_id'     => 'MML-004',
    		'email'    => 'huzaifa.ahmed@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '0172222221',
            'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[

            'id'        => 5,
            'type'      => 'developer',
    		'name'     => 'Jubayedul Islam Tanvir',
            'employee_id'     => 'MML-005',
    		'email'    => 'jubayedul.islam@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '01722222238',
            'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ],[
            'id'        => 6,
            'type'      => 'developer',
    		'name'     => 'Mahmud Hosen',
            'employee_id'     => 'MML-006',
    		'email'    => 'mahmud.hosen@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '01721222232',
            'points'            => 10,
            'description'    => 'that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 7,
            'type'      => 'developer',
    		'name'     => 'Mamunur Rahman Robin',
            'employee_id'     => 'MML-007',
    		'email'    => 'mamunur.rahman@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '0172222888',
            'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[

            'id'        => 8,
            'type'      => 'developer',
    		'name'     => 'Mohammmad Sadman',
            'employee_id'     => 'MML-008',
    		'email'    => 'mohd.sadman@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '01722244232',
            'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ],[
            'id'        => 9,
            'type'      => 'developer',
    		'name'     => 'Mujaheed Hillol',
            'employee_id'     => 'MML-009',
    		'email'    => 'mujaheed.hillol@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '017221122232',
            'points'            => 10,
            'description'    => 'that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 10,
            'type'      => 'developer',
    		'name'     => 'Pijush Bhowmik',
            'employee_id'     => 'MML-010',
    		'email'    => 'pijush.bhowmik@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '01722227898',
            'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[

            'id'        => 11,
            'type'      => 'developer',
    		'name'     => 'Saiful Islam',
            'employee_id'     => 'MML-011',
    		'email'    => 'saiful.islam@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '01722222732',
            'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ],[
            'id'        => 12,
            'type'      => 'developer',
    		'name'     => 'Shawanna Islam Mim',
            'employee_id'     => 'MML-012',
    		'email'    => 'shawanna.mim@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '0172298232',
            'points'            => 10,
            'description'    => 'that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[
            'id'        => 13,
            'type'      => 'developer',
    		'name'     => 'Sohel Akter',
            'employee_id'     => 'MML-013',
    		'email'    => 'sohel.akter@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '0172255222',
            'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	],[

            'id'        => 14,
            'type'      => 'developer',
    		'name'     => 'Tanvir Ahamed',
            'employee_id'     => 'MML-014',
    		'email'    => 'tanvir.ahamed@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '017222796',
            'points'            => 10,
            'description'    => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ],[
            'id'        => 15,
            'type'      => 'developer',
    		'name'     => 'Izaz asif',
            'employee_id'     => 'MML-015',
    		'email'    => 'izaz.asif@miaki.co',
    		'password' => Hash::make('123'),
            'phone_number'    => '0172222232',
            'points'            => 10,
            'description'    => 'that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English. ',
            'status'    => 1,
            'created_at' => $now,
            'updated_at' => $now,
            
    	]]);
    }
}
