@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
<!-- Bread crumb -->
<ol class="breadcrumb float-sm-right">
     <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Employee</li>
        </ol>
    </nav>
</ol>
</br>
<!--  end-->
@stop
@section('content')
<div class="card card-outline card-success">
    <div class="card-header">
         <h3 class="card-title">List Employee</h3>
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
                    <th>Employee Name</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @if(count($employeeDetails)>0)
                @foreach($employeeDetails as $employee)
                <tr>
                    <td>{{$i}}</td>
                    <td>
                        @if(!empty(($employee->first_name) && ($employee->last_name)))
                             {{$employee->first_name." ".$employee->last_name}}
                        @endif
                    </td>
                    <td>
                        @if(!empty(($employee->companies_id)))
                             {{$employee->companies_id}}
                        @endif
                    </td>
                    <td>
                        @if(!empty($employee->email))
                             {{$employee->email}}
                        @endif
                    </td>
                    <td> 
                        @if(!empty($employee->phone))
                            {{$employee->phone}}
                        @endif 
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">Action</button>
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                               <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" href="{{route('employee.update',['slug' => $employee->slug])}}">Update</a>
                                <a class="dropdown-item" href="{{route('employee.destroy',['slug' => $employee->slug])}}">Delete</a>
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
</script>
@stop