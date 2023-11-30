<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
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
        return view('admin.pages.company.add-company');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('companyLogoValue'))
        {
            $file               = $request->file('companyLogoValue');
            $fileName           = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath    = storage_path().'/app/public/admin' ;
            $store              = Company::create([
                                    'company_name' => $request->companyNameValue,
                                    'email'        => $request->companyEmailValue,
                                    'logo'         => $fileName,
                                    'status'       => 0,
                                ]);
           if($store)
           {    
                $imageStore         = $file->move($destinationPath,$fileName);
                return response()->json(['status' => 200]);
           }
           else
           {
            return response()->json(['status' => 402]);
           }
           
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function list()
    {
        $companyDetails = Company::all();
        return view('admin.pages.company.list-company')->with('companyDetails',$companyDetails);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
