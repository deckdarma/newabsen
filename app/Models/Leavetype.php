<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Leavetype extends BaseModel
{

    // Don't forget to fill this array
    protected $fillable = ['id','leaveType', 'num_of_leave', 'potongan', 'singkat', 'waktumundur', 'potongan_shift'];

   
}
