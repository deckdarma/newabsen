<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Shitkinerja;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ShitkinerjaExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $salaries = Shitkinerja::companywithdept(admin()->company_id)
            ->select(
                'employees.employeeID',
                'full_name',
                'department.name as deptName',
                'designation.designation as designationName',
                'shitkinerjas.basic as basic',
                'overtime_hours',
                'overtime_pay',
                'total_allowance',
                'total_deduction',
                'net_salary'
            )
            ->where('month', '=', request()->get('month'))->where('year', '=', request()->get('year'))->get();
        return $salaries;
    }
    /**
     * @var Invoice $invoice
     */
    public function map($shitkinerja): array
    {
        $employee = Employee::where('employeeID', $shitkinerja->employeeID)->first();
        return [
            $shitkinerja->employeeID,
            $employee->decryptToCollection()->full_name,
            $shitkinerja->deptName,
            $shitkinerja->designationName,
            $shitkinerja->basic,
            $shitkinerja->overtime_hours,
            $shitkinerja->overtime_pay,
            $shitkinerja->total_allowance,
            $shitkinerja->total_deduction,
            $shitkinerja->net_salary,
        ];
    }

    public function headings(): array
    {
        $monthName = date('F', mktime(0, 0, 0, request()->get('month'), 10)); // March
        return [
            [
                admin()->company->company_name,
            ],
            ['Shitkinerja Report'],
            ['Period:', $monthName . ',' . request()->get('year')],
            ['Printed On:', date('d/m/Y, g:i a')],
            [],
            [],
            [
                'NIP', 'NAMA', 'Department', 'Designation', 'Basic Salary', 'Total hours',
                'Total Hourly Payment', 'Total Allowance', 'Total Deduction', 'Net Salary'
            ]
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'C'  => ['font' => ['size' => 16]],
        ];
    }
}
