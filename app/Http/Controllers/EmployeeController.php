<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class EmployeeController extends Controller
{
    public function storeData(Request $request)
    {
        $file   =   $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet        = $spreadsheet->getActiveSheet();
        $row_limit    = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range    = range( 2, $row_limit );
        $column_range = range( 'F', $column_limit );
        $startcount = 2;
        $data = array();
        foreach ( $row_range as $row ) {
            $data[] = [
                'employee_code' =>$sheet->getCell( 'A' . $row )->getValue(),
                'name' => $sheet->getCell( 'B' . $row )->getValue(),
                'job_title' => $sheet->getCell( 'C' . $row )->getValue(),
                'department' => $sheet->getCell( 'D' . $row )->getValue(),
                'business_unit' => $sheet->getCell( 'E' . $row )->getValue(),
                'gender' =>$sheet->getCell( 'F' . $row )->getValue(),
                'ethnicity' =>$sheet->getCell( 'G' . $row )->getValue(),
                'age' =>$sheet->getCell( 'H' . $row )->getValue(),
                'hire_date' =>$sheet->getCell( 'I' . $row )->getValue(),
                'annual_salary' =>$sheet->getCell( 'J' . $row )->getValue(),
                'bonus' =>$sheet->getCell( 'K' . $row )->getValue(),
                'country' =>$sheet->getCell( 'L' . $row )->getValue(),
                'city' =>$sheet->getCell( 'M' . $row )->getValue(),
                'exit_date' =>$sheet->getCell( 'N' . $row )->getValue(),
            ];
            $startcount++;
        }

        Employee::insert($data);

    }

    public function getData(Request $request)
    {
        if(empty($request->search))
        {
            return json_encode(Employee::all());
        }
        else
        {
            $filteredData   = Employee::where("employee_code",$request->search)->first();
            if(!empty($filteredData))
            {
                return json_encode($filteredData);
            }
            else
            {
                return json_encode(collect());
            }
        }
    }

}
