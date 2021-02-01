@extends('frontend.layouts.masterAccount')
@section('content')
<section>
<section>

<div class="col-sm-9 padding-right">
	<div class="features_items">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Id </th>
                            <th scope="col">Name </th>
                            <th scope="col">Image </th>
                            <th scope="col">Price </th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    foreach($products as $key=>$value){?>
                        <tr>
                            <th scope="row"><?php echo $value['id'] ?></th>
                            <td><?php echo $value['name'] ?></td>
                            
                            <td>
                                    <?php foreach(json_decode($value['images']) as $i){ ?>
                                            <img  width="30px" height="30px" src="{{ asset('upload/user/'.Auth::id().'/'.$i)}}" alt="">
                                    <?php } ?>
                            </td>
                   
                            <td><?php echo $value['price'] ?></td>
                            <td>
                                <a href="{{ url('member/product/update/' . $value['id']) }}">Edit</a>
                                <a href="{{ url('member/products/' . $value['id']) }}">Delete</a>

                            </td>
                        </tr>
                    <?php }?>
                    
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <a href="{{url('member/add/product')}}" class="btn btn-success">Add New</a>
            </div>    
    </form>
    </div>
	</div>
	</div>

</section>
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