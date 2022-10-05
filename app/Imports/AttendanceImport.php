<?php

namespace App\Imports;

use App\Models\Attendance;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport  implements ToModel, WithHeadingRow
{
     /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
         
            "uid" => 1,           
            "emp_id" => $row['employee_id'],           
            "attendance_time" => date("h:i:s",strtotime($row['time_in'])),
            "attendance_date" => date("y-m-d",strtotime($row['date'])),           
            "time_in" => date("h:i:s",strtotime($row['time_in'])),
            "time_out" => date("h:i:s",strtotime($row['time_out'])),
        ]);
    }
   
}
