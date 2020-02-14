<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    //
    protected $table='wards';

        // minus 1 By Using decrement()

    // public function decrese1($num)
    // {
    //     Ward::where('ward_no','=',$num)->decrement('free_beds',1);
    // }
}
