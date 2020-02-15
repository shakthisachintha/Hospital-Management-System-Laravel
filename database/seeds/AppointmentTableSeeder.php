<?php
use App\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
            ['id' => '1', 'created_at' => '2020-02-01 08:00:00', 'updated_at' => '2020-02-02 16:56:11', 'patient_id' => '2002131', 'doctor_id' => '1', 'number' => '1'],
            ['id' => '2', 'created_at' => '2020-02-02 08:00:00', 'updated_at' => '2020-02-03 16:56:11', 'patient_id' => '2002132', 'doctor_id' => '2', 'number' => '2'],
            ['id' => '3', 'created_at' => '2020-02-03 08:00:00', 'updated_at' => '2020-02-04 16:56:11', 'patient_id' => '2002133', 'doctor_id' => '1', 'number' => '12'],
            ['id' => '4', 'created_at' => '2020-02-05 08:00:00', 'updated_at' => '2020-02-06 16:56:11', 'patient_id' => '2002131', 'doctor_id' => '1', 'number' => '13'],
            ['id' => '5', 'created_at' => '2020-02-05 08:00:00', 'updated_at' => '2020-02-07 16:56:11', 'patient_id' => '2002131', 'doctor_id' => '1', 'number' => '14'],
            ['id' => '6', 'created_at' => '2020-02-07 08:00:00', 'updated_at' => '2020-02-08 16:56:11', 'patient_id' => '2002132', 'doctor_id' => '1', 'number' => '15'],
            ['id' => '7', 'created_at' => '2020-02-09 08:00:00', 'updated_at' => '2020-02-09 16:56:11', 'patient_id' => '2002132', 'doctor_id' => '1', 'number' => '16'],
            ['id' => '8', 'created_at' => '2020-02-02 08:00:00', 'updated_at' => '2020-02-07 16:56:11', 'patient_id' => '2002134', 'doctor_id' => '5', 'number' => '17'],
            ['id' => '9', 'created_at' => '2020-02-08 08:00:00', 'updated_at' => '2020-02-09 16:56:11', 'patient_id' => '2002135', 'doctor_id' => '1', 'number' => '18'],
            ['id' => '10', 'created_at' => '2020-02-07 08:00:00', 'updated_at' => '2020-02-09 16:56:11', 'patient_id' => '2002136', 'doctor_id' => '1', 'number' => '19'],
            ['id' => '11', 'created_at' => '2020-02-04 08:00:00', 'updated_at' => '2020-02-08 16:56:11', 'patient_id' => '2002137', 'doctor_id' => '1','number'=>'21'],
            ['id' => '12', 'created_at' => '2020-02-08 08:00:00', 'updated_at' => '2020-02-09 16:56:11', 'patient_id' => '2002138', 'doctor_id' => '1','number'=>'31'],
            ['id' => '13', 'created_at' => '2020-02-05 08:00:00', 'updated_at' => '2020-02-07 16:56:11', 'patient_id' => '2002139', 'doctor_id' => '3','number'=>'41'],
            ['id' => '14', 'created_at' => '2020-02-07 08:00:00', 'updated_at' => '2020-02-08 16:56:11', 'patient_id' => '2002134', 'doctor_id' => '1','number'=>'51'],

        ]);
    }
}
