<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeesFormRequest;
use App\Models\employees;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = Users::where('role_as', '=', '1')->get();
        $employee = employees::all();
        return view('adminpanel.adminviews.employees.index', compact('employee','user'));
    }

    public function create()
    {
        return view('adminpanel.adminviews.employees.create');
    }

    public function store(EmployeesFormRequest $request)
    {
        $data = $request->validated();
        $user = new Users;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->role_as = '1';
        $user->password = Hash::make($data['password']);
        $user->save();

//      Find the newest
        $newestUserID = null;
        $users = Users::all();
        foreach ($users as $Users)
        {
            if ($newestUserID === null || $Users->id > $newestUserID) {
                $newestUserID = $Users->id;
            }
        }

        $employee = new employees;
        $employee->UserID = $newestUserID;
        $employee->ERole = $data['ERole'];
        $employee->save();

        return redirect(route('employees'))->with('message','Employee Add Successfully');
    }

    public function edit($employee_id)
    {
        $employee = employees::find($employee_id);
        $user = Users::find($employee->UserID);

        return view('adminpanel.adminviews.employees.edit', compact('employee','user'));
    }

    public function update(EmployeesFormRequest $request, $employee_id)
    {
        $employee = employees::find($employee_id);
        $user = Users::find($employee->UserID);
        $data = $request->validated();

//      Update user
        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($data['password'] != null) {
            $user->password = Hash::make($data['password']);
        }
        $user->phone = $data['phone'];
        $user->update();

//      Update Employee level
        $employee->ERole = $data['ERole'];
        $employee->update();

        return redirect(route('employees'))->with('message','Employee Update Successfully');
    }
    public function delete($employee_id)
    {
        $employee = employees::find($employee_id);
        $user = Users::find($employee->UserID);

        if ($employee && $user)
        {
            $employee->delete();
            $user->delete();
            return redirect(route('employees'))->with('message','Employee Delete Successfully');
        }
        else
        {
            return redirect(route('employees'))->with('message','No Employee ID Found');
        }
    }
}
