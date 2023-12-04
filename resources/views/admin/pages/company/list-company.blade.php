@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
<!-- Bread crumb -->
<!-- Error Toast Msg -->
@if(!empty($employeeCount)) 
<div id="errorToastMsg" class="toasts-top-right absolute" style="width:22rem; display:block;">
    <div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Employee works!</strong><small></small>
            <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    <div class="toast-body" id="errorMsgDiv"> 
         {{$employeeCount}}, employee works under this company
    </div>
    </div>
</div>
@endif

<!--  End -->
<ol class="breadcrumb float-sm-right">
     <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Company</li>
        </ol>
    </nav>
</ol>
</br>
<!--  end-->
@stop
@section('content')
<div class="card card-outline card-success">
    <div class="card-header">
         <h3 class="card-title">List Company</h3>  
         <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <section class="content" style="margin-top:3rem; margin-left:2rem; margin-right:2rem;">
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Sl. no</th>
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Company Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
            @if(count($companyDetails)>0)
                @foreach($companyDetails as $company)
                <tr>
                    <td>{{$i}}</td>
                    <td>
                        @if(!empty($company->company_name))
                             {{$company->company_name}}
                        @endif
                    </td>
                    <td>
                        @if(!empty($company->email))
                             {{$company->email}}
                        @endif
                    </td>
                    <td> 
                        @if($company->logo != "NULL") 
                            <img src= "{{asset('storage/admin/'.$company->logo)}}" height="50px" width="75px">
                        @else
                            No Logo Present
                        @endif 
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">Action</button>
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                               <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" href="{{route('company.update',['slug' => $company->slug])}}">Update</a>
                                <a class="dropdown-item" href="{{route('company.destroy',['slug' => $company->slug])}}">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
            @endif    
            </tbody>
        </table>
    </section>
</div>
@stop
@section('css')
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
@stop
@section('js')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
    setTimeout(function(){
        errorToastMsg.style.display="none";
    },4000);
</script>
@stop