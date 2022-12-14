<?php

namespace App\Observers;

use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Setting;

class PayrollObserver
{
    public function creating(Payroll $model)
    {
        if (admin()) {
            $settings = Setting::first();
            $company = admin()->company;
            $model->company_id = admin()->company_id;

            if (!\App::runningInConsole()) {

                if ($company->payroll_notification == 1) {
                    $employee = Employee::select('email', 'full_name')
                        ->where('id', '=', $model->employee_id)->first();

                    $dt = \DateTime::createFromFormat('!m', $model->month);
                    $month = $dt->format('F');
                    $year = $model->year;


     
                }
            }
        }
    }
}
