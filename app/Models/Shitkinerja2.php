<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Shitkinerja2 extends BaseModel
{
  // Don't forget to fill this array
    protected $fillable = [];
    protected $guarded = ['id'];
    protected $table = 'payrolls';
    protected static function boot()
    {
        parent::boot();


        static::addGlobalScope('companydata', function (Builder $builder) {
            if (admin()) {
   
            }

        });


    }


  
    public function employee()
    {

        return $this->belongsTo(Employee::class);
    }


    public function scopeCompanywithdept($query, $id)
    {
        return $query->join('employees', 'shitkinerjas.employee_id', '=', 'employees.id')
            ->join('designation', 'designation.id', '=', 'employees.designation')
            ->join('department', 'designation.department_id', '=', 'department.id')
            ->where('department.company_id', '=', $id);
    }

    public function scopeManager($query, $id)
    {
        if (admin()->manager == 1) {
            return $query->join('designation', 'designation.id', '=', 'employees.designation')
                ->join('department', 'designation.department_id', '=', 'department.id')
                ->join('department_manager', 'department_manager.department_id', '=', 'department.id')
                ->where('department_manager.manager_id', '=', $id);
        }
        return $query->join('designation', 'designation.id', '=', 'employees.designation')
            ->join('department', 'designation.department_id', '=', 'department.id');

    }
}
