@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
<!-- Bread crumb -->
<ol class="breadcrumb float-sm-right">
     <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Employee</li>
        </ol>
    </nav>
</ol>
<br>
<!--  end-->
<head> 
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
@stop
@section('content')
<!-- Success Toast Msg -->
<div id="successToastMsg" class="toasts-top-right absolute" style="width:22rem; display:none;">
    <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Success</strong><small></small>
            <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <div class="toast-body"> 
        Your employee details have been updated.
    </div>
    </div>
</div>
<!--  End -->
<!-- Error Toast Msg -->
<div id="errorToastMsg" class="toasts-top-right absolute" style="width:22rem; display:none;">
    <div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Failure!</strong><small></small>
            <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <div class="toast-body" id="errorMsgDiv"> 
         
    </div>
    </div>
</div>
<!--  End -->
<div class="card card-outline card-success">
    <div class="card-header">
         <h3 class="card-title">Update Employee</h3>
         <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div> 
    <form method="post" action="{{route('employee.edit')}}" enctype="multipart/form-data" id="addEmployeeForm">
        @csrf
        <div class="container" style="margin-top:2.5em;  min-height: 50vh;">
         <!-- Employee First Name -->
         <input class="form-control" type="hidden" id="id" name="id" value="{{$employeeDetails[0]->id}}">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                       <label>First Name <span class="text-danger">*</span> :</label>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                           </div>
                           <input class="form-control" type="text" id="firstName" name="firstName" @if(!empty($employeeDetails[0]->first_name)) value="{{$employeeDetails[0]->first_name}}" @endif>
                        </div>
                        <div class="error text-danger" id="errorFirstName" style="position:absolute;"> @if($errors->has('firstName')) {{$errors->first('firstName')}} @endif </div>
                    </div>
                </div> 
            </div>
            <!-- End -->
             <!-- Employee Last Name -->
             <div class="form-group" style="margin-top:2em;">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                       <label>Last Name <span class="text-danger">*</span> :</label>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                           </div>
                           <input class="form-control" type="text" id="lastName" name="lastName" @if(!empty($employeeDetails[0]->last_name)) value="{{$employeeDetails[0]->last_name}}" @endif>
                        </div>
                        <div class="error text-danger" id="errorLastName" style="position:absolute;"> @if($errors->has('lastName')) {{$errors->first('lastName')}} @endif </div>
                    </div>
                </div> 
            </div>
            <!-- End -->
            <!-- Email -->
            <div class="form-group" style="margin-top:2em;">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                         <label>Email:</label>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text"> <i class="fas fa-envelope"></i></span>
                         </div>
                            <input class="form-control" type="text"  id="employeeEmail" name="employeeEmail" @if(!empty($employeeDetails[0]->email)) value="{{$employeeDetails[0]->email}}" @endif disabled>
                        </div>
                        <div class="error text-danger" style="position:absolute;"id="errorEmployeeEmail">@if($errors->has('employeeEmail')) {{$errors->first('employeeEmail')}} @endif </div>
                    </div>
                </div> 
            </div>
        <!-- End -->
         <!-- Email -->
            <div class="form-group" style="margin-top:2em;">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                         <label>Phone:</label>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text"> <i class="fas fa-phone"></i></span>
                         </div>
                            <input class="form-control" type="text"  id="employeePhone" name="employeePhone" @if(!empty($employeeDetails[0]->phone)) value="{{$employeeDetails[0]->phone}}" @endif>
                        </div>
                        <div class="error text-danger" style="position:absolute;" id="errorEmployeePhone">@if($errors->has('employeePhone')) {{$errors->first('employeePhone')}} @endif </div>
                    </div>
                </div> 
            </div>
        <!-- End -->  
                 <!-- Email -->
                 <div class="form-group" style="margin-top:2em;">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                         <label>Select Company <span class="text-danger">*</span> :</label> 
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text"> <i class="fas fa-business-time"></i></span>
                             <select class="form-control" name="employeeWorkingCompanyName" id="employeeWorkingCompanyName">
                                <option value="">Select Your Organization</option>
                                @if(count($companyDetails)>0)
                                    @foreach($companyDetails as $company)
                                        <option @if($company->id == $employeeDetails[0]->companies_id) selected @endif value="{{$company->id}}">{{$company->company_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                         </div>
                    </div>
                    <div class="error text-danger" style="position:absolute;" id="errorEmployeeWorkingCompanyName">@if($errors->has('employeeWorkingCompanyName')) {{$errors->first('employeeWorkingCompanyName')}} @endif </div>
                </div>
            </div> 
        </div>
        <!-- End -->  
         <!-- Company Names -->
        <div class="form-group" style="margin-top:2em;">
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                         <button type="submit" class="btn btn-block btn-outline-success btn-lg" name="addEmployee" id="addEmployee">Submit</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="reset" class="btn btn-block btn-outline-danger btn-lg" name="reset" id="reset">Reset</button>
                    </div>
                </div> 
            </div>
        <!-- End -->
        </div>
        </form>
    </div>
        <div class="float-left d-none d-sm-block">
            <strong>Copyright © 2023-2024 <a href="https://learnercompare.nodejsdapldevelopments.com/">CompanyEmployee</a>.</strong> All rights reserved.
        </div>
        <div class="float-left d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>
   </div>
</div>
@stop
@section('css')
   <script src="{{asset('admin/employee/js/updateEmployeeValidation.js')}}"></script>
 @stop
@section('js')
@stop