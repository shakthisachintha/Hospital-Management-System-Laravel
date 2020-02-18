<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            [
                'id' => '1910101',
                'name' => 'Shakthi Sachintha',
                'address' => '15/5A,AG Gunarathne Mw,Balagewaththa,Maitipe,Galle.',
                'sex' => 'Male',
                'bod' => '1997-06-25',
                'occupation' => 'Student',
                'nic' => '971772140V',
                'telephone' => '0774345234',
                'image' => '1911271.png',
                'created_at' => '2019-11-27 12:41:40',
                'updated_at' => '2019-11-27 12:41:41',
            ],
            [
                'id' => '1910102',
                'name' => 'Sakun Chamikara',
                'address' => '23/45,Meepawla,Galle.',
                'sex' => 'Male',
                'bod' => '1997-12-25',
                'occupation' => 'Student',
                'nic' => '971782177V',
                'telephone' => '0767035067',
                'image' => '1911271.png',
                'created_at' => '2019-11-27 12:45:40',
                'updated_at' => '2019-11-27 12:45:41',
            ]
        ]);
    }
}
