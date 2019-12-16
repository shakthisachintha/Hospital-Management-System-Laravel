<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    //
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function history(){
        return $this->hasMany('\App\Patient_History');
    }
}
