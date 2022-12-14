<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Noticeboard
 * @package App\Models
 */
class Noticeboard extends BaseModel
{

    // Don't forget to fill this array
    protected $fillable = ['title', 'description', 'status'];


}
