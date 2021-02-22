@extends('admin.layouts.master')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Basic Table</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Table Header</h4>
                <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Id Brand</th>
                            <th scope="col">Name Brand</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($brand as $value)
                        <tr>
                            <th scope="row">{{$value->id}}</th>
                            <td>{{$value->name}}</td>
                            <td>
                                <a href="{{ route('brand.edit',  $value->id) }}">Edit</a>
                                <form action="{{ route('brand.destroy', $value->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type='submit' name='delete' value='Delete'>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $brand->links() }}
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <a href="{{route('brand.create')}}" class="btn btn-success">Add Brand</a>
            </div>
            
    </form>
    </div>
    <footer class="footer text-center">
        All Rights Reserved by Nice admin. Designed and Developed by
        <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<style>
    .pagination {
        display: inline-block;
        float: right;
        padding-right: 20px;
        padding-bottom: 10px;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #ddd;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }

    .pagination a:first-child {
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .pagination a:last-child {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }
</style>
@endsection