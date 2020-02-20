<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Clinic extends Model
{
    //

    public function patients()
    {
        $start_date = date('Y/m/00');
        $end_date = date('Y/m/31');
        return $this->belongsToMany('App\Patients', "clinic_patient")->whereBetween('clinic_patient.created_at', [$start_date, $end_date]);
    }

    public function doctor()
    {
        return $this->hasOne('App\User', 'id', 'doctor_id');
    }

    public function addPatientToClinic($pid)
    {
        DB::table('clinic_patient')->insert(
            [
                [
                    "updated_at" => Carbon::now()->toDateTimeString(),
                    "created_at" => Carbon::now()->toDateTimeString(),
                    "patients_id" => $pid,
                    "clinic_id" => $this->id,
                ]
            ]
        );
    }
}
