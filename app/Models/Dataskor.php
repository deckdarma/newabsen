<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Dataskor extends BaseModel
{

    // Don't forget to fill this array
    protected $fillable = ['id','dataSkor', 'num_of_leave',  'singkat',  'potongan',  'potongan_shift'];

   
}
