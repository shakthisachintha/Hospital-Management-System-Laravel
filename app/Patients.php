<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patients extends Model
{
    //
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function history(){
        return $this->hasMany('\App\Patient_History');
    }

    public function getAge(){
        return Carbon::parse($this->attributes['bod'])->age;
    }
}
