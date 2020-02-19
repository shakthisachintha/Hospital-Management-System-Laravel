<?php

use Illuminate\Database\Seeder;

class WardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wards')->insert([
            [
                'id' => '1',
                'ward_no' => '03',
                'beds' => '10',
                'free_beds' => '5',
                'doctor_id' => '1',
                'created_at' => '2019-11-27 12:41:40',
                'updated_at' => '2019-11-27 12:41:41',
            ], 
            [
                'id' => '2',
                'ward_no' => '06',
                'beds' => '6',
                'free_beds' => '3',
                'doctor_id' => '2',
                'created_at' => '2019-11-27 12:41:40',
                'updated_at' => '2019-11-27 12:41:41',
            ]
        ]);
    }
}
