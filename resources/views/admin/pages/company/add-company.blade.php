@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <!-- <h1>Add Company</h1> -->
    <head> 
     <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
@stop
@section('content')
  
<div class="card card-outline card-success">
    <div class="card-header">
         <h3 class="card-title">Add Company</h3>
         <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <form method="post" action="{{route('company.store')}}" enctype="multipart/form-data" id="addCompanyForm">
        @csrf
         <div class="card-body">
             <div class="form-group">
                  <label>Company Name <span class="text-danger">*</span> :</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                     </div>
                     <input class="form-control" type="text" id="companyName" name="companyName">
                  </div>
                  <div class="error text-danger" id="errorCompanyName"> @if($errors->has('companyName')) {{$errors->first('companyName')}} @endif </div>
               </div>
             <div class="form-group">
                 <label>Email:</label>
                 <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text"> <i class="fas fa-envelope"></i></span>
                     </div>
                     <input class="form-control" type="text"  id="companyEmail" name="companyEmail">
                 </div>
                 <div class="error text-danger" id="errorCompanyEmail"> </div>
             </div>
             <div class="form-group">
                 <label>Logo Upload:</label>
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
        </form>
        <!-- Success Toast Msg -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="successToastMsg">
            <div class="toast-header">
                <img src="..." class="rounded mr-2" alt="...">
                <strong class="mr-auto">Bootstrap</strong>
                <small class="text-muted">just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                See? Just like this.
            </div>
        </div>
        <!--  End -->
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-outline-success btn-lg" name="addCompany" id="addCompany">Submit</button>
             <button type="reset" class="btn btn-block btn-outline-danger btn-lg" name="reset" id="reset">Reset</button>
        </div>
    </div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="{{asset('admin/js/addCompanyValidation.js')}}"></script>
 @stop
@section('js')
 @stop