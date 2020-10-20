<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            [
                'id' => 1,
                'name' => 'admin', 'type'=> 'admin', 'mobile'=>'01764121252', 
                'email'=>'admin@admin.com', 
                'password'=>'$2y$10$eVyd/8O/N8NX3KUgJAJYLO0.UpSmvu1QFfoFfk/wk1AbZtZ7F9vK6',
                'image'=> '', 'status'=> 1
            ],
            [
                'id' => 2,
                'name' => 'wakil', 'type'=> 'admin', 'mobile'=>'01764121252', 
                'email'=>'wakil@admin.com', 
                'password'=>'$2y$10$eVyd/8O/N8NX3KUgJAJYLO0.UpSmvu1QFfoFfk/wk1AbZtZ7F9vK6',
                'image'=> '', 'status'=> 1
            ],
            [
                'id' => 3,
                'name' => 'awal', 'type'=> 'subadmin', 'mobile'=>'01364121252', 
                'email'=>'awal@admin.com', 
                'password'=>'$2y$10$eVyd/8O/N8NX3KUgJAJYLO0.UpSmvu1QFfoFfk/wk1AbZtZ7F9vK6',
                'image'=> '', 'status'=> 1
            ]
        ];

        DB::table('admins')->insert($adminRecords);

       /*  foreach ($adminRecords as $key => $record){
            \App\Models\Admin::create($record);
        }  */
    }
}
