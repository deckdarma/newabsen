<?php

namespace App\Observers;

use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Payroll;

class EmployeeObserver
{
    public function creating(Employee $employee)
    {
        if (admin()) {
            $company = admin()->company;
            $employee->company_id = admin()->company_id;
            if (!app()->runningInConsole()) {
        
            }
        }
    }
}
