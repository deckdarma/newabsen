<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Datapemimpin extends BaseModel
{

    // Don't forget to fill this array
    protected $fillable = ['id','company_id', 'idpemimpin', 'namajabatan', 'order'];

   
}
