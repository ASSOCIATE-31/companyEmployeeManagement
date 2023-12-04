<?php

namespace App\Http\Controllers\Admin\Company;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddCompanyRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        $slug                 = Str::slug($request->companyNameValue.Str::random(40), '-');
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
                                    'slug'         => $slug,
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
        else
        {
            $store             = Company::create([
                'company_name' => $request->companyNameValue,
                'email'        => $request->companyEmailValue,
                'logo'         => 'NULL',
                'status'       => 0,
                'slug'         => $slug,
            ]);
            if($store)
            {    
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
        $companyDetails = Company::orderBy('id','DESC')->get();
        return view('admin.pages.company.list-company')->with('companyDetails',$companyDetails);
    }
     /**
     * Show the form for editing the specified resource.
     */
    public function update(string $slug)
    {
        $companyDetails = Company::where('slug',$slug)->get();
        return view('admin.pages.company.edit-company')->with('companyDetails',$companyDetails);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function edit(Request $request)
    {
        $slug                 = Str::slug($request->companyNameValue.Str::random(40), '-');
        if($request->hasFile('companyLogoValue'))
        {           
            $file               = $request->file('companyLogoValue');
            $fileName           = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath    = storage_path().'/app/public/admin' ;
            $store              = Company::where('id',$request->companyID)
                                    ->update([
                                     'company_name' => $request->companyNameValue,
                                     'email'        => $request->companyEmailValue,
                                     'logo'         => $fileName,
                                     'status'       => 0,
                                     'slug'         => $slug,
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
        else
        {   
            $store             = Company::where('id',$request->companyID)
                                ->update([
                                'company_name' => $request->companyNameValue,
                                'email'        => $request->companyEmailValue,
                                'status'       => 0,
                                'slug'         => $slug,
                            ]);
            if($store)
            {    
               return response()->json(['status' => 200]);
            }
            else
            {
                return response()->json(['status' => 402]);
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $companyID          =  Company::where('slug',$slug)->pluck('id');
        $id                 = $companyID[0];
        /* -------------------------------------------------------------------------
        | Checks whether company exists in employee table or not. If not delete.
        |---------------------------------------------------------------------------
        */
        $employeeCount = Company::find($id)->employee->count();
        switch($employeeCount)
        {
            case 0 :
                Company::where('id',$id)->delete();
                break;
            case ($employeeCount > 0) :
                $companyDetails = Company::all();
                return view('admin.pages.company.list-company',['employeeCount' => $employeeCount])->with('companyDetails',$companyDetails);
                break;
            default:
                break;
        }
        $companyDetails = Company::all();
        return view('admin.pages.company.list-company')->with('companyDetails',$companyDetails);
    }
}
