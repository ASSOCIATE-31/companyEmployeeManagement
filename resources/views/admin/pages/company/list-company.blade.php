@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
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
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Company Logo</th>
                </tr>
            </thead>
            <tbody>
            @if(count($companyDetails)>0)
                @foreach($companyDetails as $company)
                <tr>
                    <td>{{$company->company_name}}</td>
                    <td>{{$company->email}}</td>
                    <td><img src="{{storage_path('/app/public/admin/'.$company->logo)}}"></td>
                </tr>
                @endforeach
            @endif    
            </tbody>
        </table>
    </section>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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