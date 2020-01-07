<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    //

    public function appointment(){
        return $this->belongsTo('\App\Appointment');
    }

    public function getMedicines(){
        return $this->belongsToMany('App\Medicine');
    }

    public function doctor(){
        return $this->belongsTo('App\User');
    }

    public function patient(){
        return $this->belongsTo('App\Patients');
    }

}
