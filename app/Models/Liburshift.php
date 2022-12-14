<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Liburshift extends BaseModel
{

    // Add your validation rules here
    public static $rules = ['date.0' => 'required_with:occasion.0',];

    // Don't forget to fill this array
    protected $fillable = [];

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();





    }


}
