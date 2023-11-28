@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Add Company</h1>
@stop
@section('content')
  
<div class="card card-outline card-success">
    <div class="card-header">
         <h3 class="card-title">Add Company</h3>
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
                  <div class="error text-danger">@if($errors->has('companyName')) {{$errors->first('companyName')}} @endif </div>
               </div>
             <div class="form-group">
                 <label>Email:</label>
                 <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text"> <i class="fas fa-envelope"></i></span>
                     </div>
                     <input class="form-control" type="text"  id="companyEmail" name="companyEmail">
                 </div>
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
                 <div class="error text-danger">@if($errors->has('companyLogo')) {{$errors->first('companyLogo')}} @endif </div>
            </div>
        </form>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-outline-success btn-lg" name="addCompany" id="addCompany">Submit</button>
             <button type="reset" class="btn btn-block btn-outline-danger btn-lg" name="reset" id="reset">Reset</button>
        </div>
    </div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
 @stop