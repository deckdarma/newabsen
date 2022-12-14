<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Presentabsensi extends BaseModel
{

    // Don't forget to fill this array
    protected $fillable = ['id','presentAbsensi', 'num_of_leave', 'potongan', 'potongan_shift', 'singkat'];

   
}
