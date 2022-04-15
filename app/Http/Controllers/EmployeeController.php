<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees');
    }


    public function getEmployees()
    {
        return json_encode(['employees' => Employee::all()]);
    }

    public function getEmployee(Request $request)
    {
        
        $success = false;

        $employee = Employee::find($request->id);

        if($employee) {
            $success = true;
        }

        return json_encode(['success' => $success, 'employee' => $employee]);

    }

    public function insertEmployee(Request $request) 
    {
        $employee = Employee::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'position' => $request->position,
        ]);

        return json_encode(['employee' => $employee]);
    }

    public function updateEmployee(Request $request)
    {

        $success = false;

        Employee::where('id', $request->id)
                        ->update([
                            'first_name' => $request->firstName,
                            'last_name' => $request->lastName,
                            'position' => $request->position,
                        ]);

        $employee = Employee::find($request->id);

        if($employee) {
            $success = true;
        }
        
        return json_encode(['success' => $success, 'employee' => $employee]);
    }

    public function deleteEmployee(Request $request)
    {

        $success = false;
        
        if(Employee::destroy($request->id)) {
            $success = true;
        }

        return json_encode(['success' => $success, 'message' => 'Employee with ID '. $request->id .' was deleted!']);

    }
}
