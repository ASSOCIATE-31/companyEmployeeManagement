<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\AddEmployeeCustomRequest;
use App\Models\Company;
use App\Models\Employee;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companyDetails = Company::all();
        return view('admin.pages.employee.add-employee')->with('companyDetails',$companyDetails);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slug                 = Str::slug($request->firstNameValue.$request->lastNameValue.Str::random(40), '-');
        $addEmployee = Employee::create([
            'companies_id' => $request->employeeWorkingCompanyID,
            'first_name'   => $request->firstNameValue,
            'last_name'    => $request->lastNameValue,
            'email'        => $request->employeeEmailValue,
            'phone'        => $request->employeePhoneValue,
            'status'       => 0,
            'slug'         => $slug,
        ]);
        if($addEmployee)
        {
            return response()->json(['status' => 200]);
        }
        else
        {
            return response()->json(['status' => 500]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function list()
    {
        $employeeDetails = Employee::orderBy('id','DESC')->get();
        return view('admin.pages.employee.list-employee')->with('employeeDetails',$employeeDetails);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(string $slug)
    {
        $companyDetails = Company::all();
        $employeeDetails = Employee::where('slug',$slug)->get();
        return view('admin.pages.employee.edit-employee',compact('employeeDetails','companyDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request)
    {
        $slug                 = Str::slug($request->firstNameValue.$request->lastNameValue.Str::random(40), '-');
        $updateEmployee = Employee::where('id',$request->id)
                              ->update([
                                    'companies_id' => $request->employeeWorkingCompanyID,
                                    'first_name'   => $request->firstNameValue,
                                    'last_name'    => $request->lastNameValue,
                                    'phone'        => $request->employeePhoneValue,
                                    'status'       => 0,
                                    'slug'         => $slug,
                               ]);
        if($updateEmployee)
        {
            return response()->json(['status' => 200]);
        }
        else
        {
            return response()->json(['status' => 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        Employee::where('slug',$slug)->delete();
        $employeeDetails = Employee::all();
        return view('admin.pages.employee.list-employee')->with('employeeDetails',$employeeDetails);
    }
}
