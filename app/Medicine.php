<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public function prescriptions(){
        return $this->belongsToMany('App\Prescription');
    }
}
