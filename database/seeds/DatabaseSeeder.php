<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AttendancesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
        $this->call(PatientTableSeeder::class);
        $this->call(WardTableSeeder::class);
        $this->call(ClinicsTableSeeder::class);
        $this->call(NoticeboardsTableSeeder::class);
    }
}
