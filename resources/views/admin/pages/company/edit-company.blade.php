@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
<!-- <h1>Add Company</h1> -->
<!-- Bread crumb -->
<ol class="breadcrumb float-sm-right">
     <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Company</li>
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
        Your company details have been saved.
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
         <h3 class="card-title">Update Company</h3>
         <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>  
    <form method="post" action="{{route('company.edit')}}" enctype="multipart/form-data" id="updateCompanyForm">
        @csrf
         <div class="container" style="margin-top:3em;  min-height: 50vh;">

         <!-- Company Name -->
            <input class="form-control" type="text"  value="{{$companyDetails[0]->id}}"  id="id" name="id" >
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                       <label>Company Name <span class="text-danger">*</span> :</label>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                           </div>
                          <input class="form-control" type="text"  @if(!empty($companyDetails[0]->company_name)) value="{{$companyDetails[0]->company_name}}" @endif id="companyName" name="companyName" >
                        </div>
                        <div class="error text-danger" id="errorCompanyName" style="position:absolute;"> @if($errors->has('companyName')) {{$errors->first('companyName')}} @endif </div>
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
                            <input class="form-control" type="text" id="companyEmail" name="companyEmail" @if(!empty($companyDetails[0]->email)) value="{{$companyDetails[0]->email}}" @endif  disabled  >
                        </div>
                        <div class="error text-danger" id="errorCompanyLogo">@if($errors->has('companyLogo')) {{$errors->first('companyLogo')}} @endif </div>
                    </div>
                </div> 
            </div>
        <!-- End -->
         <!-- Company Logo -->
         <div class="form-group" style="margin-top:2em;">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                         <label>Logo Upload:</label>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="companyLogo" name="companyLogo">
                               <label class="custom-file-label" for="companyLogo">Choose file</label>
                            </div>
                        </div>
                        <div class="error text-danger" id="errorCompanyLogo">@if($errors->has('companyLogo')) {{$errors->first('companyLogo')}} @endif </div>
                    </div>
                </div> 
            </div>
        <!-- End -->
        <div class="form-group" style="margin-top:2em;">
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                         <button type="submit" class="btn btn-block btn-outline-success btn-lg" name="updateCompany" id="updateCompany">Submit</button>
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
   <script src="{{asset('admin/js/updateCompanyValidation.js')}}"></script>
 @stop
@section('js')
 @stop