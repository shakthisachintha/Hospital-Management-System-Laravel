<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Prescription_Medicine extends Model
{
    protected $table = 'medicine_prescription';

    public static function thisMonthTrends($year,$month,$qty){
        $c=DB::table('medicine_prescription')
        ->join('medicines',"medicines.id","=","medicine_prescription.medicine_id")
        ->selectRaw("name_sinhala,name_english,medicine_id,count(medicine_id) as issues")
        ->whereRaw("year(medicine_prescription.created_at)=$year")
        ->whereRaw("month(medicine_prescription.created_at)=$month")
        ->groupBy('medicine_id')
        ->limit($qty)
        ->get();
        return $c;
    }
}
