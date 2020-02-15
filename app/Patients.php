<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Patients extends Model
{
    //
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function history()
    {
        return $this->hasMany('\App\Patient_History');
    }

    public function getAge()
    {
        return Carbon::parse($this->attributes['bod'])->age;
    }

    public function clinics()
    {
        return $this->belongsToMany('App\Clinic', "clinic_patient");
    }

    public static function regsMonth($year, $month, $sex)
    {
        $sex = ucfirst(strtolower($sex));
        $c = DB::table('patients')
            ->where('patients.sex', $sex)
            ->whereRaw("MONTH(created_at)= $month")
            ->whereRaw("YEAR(created_at)= $year")
            ->count();

        return $c;
    }

    public static function totalRegs($year, $month)
    {
        $c = DB::table('patients')
            ->whereRaw("MONTH(created_at)= $month")
            ->whereRaw("YEAR(created_at)= $year")
            ->count();

        return $c;
    }
}
