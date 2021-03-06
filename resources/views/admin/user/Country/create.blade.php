@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h4 class="card-title">Default Forms</h4>
                <h5 class="card-subtitle"> All bootstrap element classies </h5>
                <form class="form-horizontal m-t-30" method='post'>
                @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name='countryName'>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input class="btn btn-success" type='submit' value='Add Country'>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endsection