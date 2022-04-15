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

    public function insertEmployee(Request $request) 
    {
        $employee = Employee::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'position' => $request->position,
        ]);

        return json_encode(['employee' => $employee]);
    }
}
