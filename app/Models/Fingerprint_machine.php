<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Fingerprint_machine
 * @package App\Models
 */
class Fingerprint_machine extends BaseModel
{

    // Don't forget to fill this array
    protected $fillable = ['ip','company_id', 'comkey', 'dinas', 'status', 'shift', 'idshift'];


}
