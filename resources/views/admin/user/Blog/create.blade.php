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
                <form class="form-horizontal m-t-30" method='post' enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name='titleBlog'>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <br>
                        <textarea  name="descriptionBlog" rows="4" cols="100"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <br>
                        <textarea id='editor4' name="ContentBlog" rows="4" cols="100"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input class="btn btn-success" type='submit' value='Add Blog'>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endsection