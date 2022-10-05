<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Employee;
use App\Models\Latetime;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use Illuminate\Routing\Controller;
use App\Http\Requests\AttendanceEmp;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class AttendanceController extends Controller
{   
    //show attendance 
    public function index()
    {  
        return view('admin.attendance')->with(['attendances' => Attendance::all(),'employee'=>Employee::all()]);
    }

    //show late times
    public function indexLatetime()
    {
        return view('admin.latetime')->with(['latetimes' => Latetime::all()]);
    }
 
    public  function uploadData(Request $request){
      
        Excel::import(new AttendanceImport, $request->file);
   return redirect()->back()->with('success');

    }
    

    // public static function lateTime(Employee $employee)
    // {
    //     $current_t = new DateTime(date('H:i:s'));
    //     $start_t = new DateTime($employee->schedules->first()->time_in);
    //     $difference = $start_t->diff($current_t)->format('%H:%I:%S');

    //     $latetime = new Latetime();
    //     $latetime->emp_id = $employee->id;
    //     $latetime->duration = $difference;
    //     $latetime->latetime_date = date('Y-m-d');
    //     $latetime->save();
    // }

    public static function lateTimeDevice($att_dateTime, Employee $employee)
    {
        $attendance_time = new DateTime($att_dateTime);
        $checkin = new DateTime($employee->schedules->first()->time_in);
        $difference = $checkin->diff($attendance_time)->format('%H:%I:%S');

        $latetime = new Latetime();
        $latetime->emp_id = $employee->id;
        $latetime->duration = $difference;
        $latetime->latetime_date = date('Y-m-d', strtotime($att_dateTime));
        $latetime->save();
    }
  
}
