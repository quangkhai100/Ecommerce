@extends('frontend.layouts.masterAccount')
@section('content')
<section>

    <div class="col-sm-9 padding-right">
        <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center">Create Product!</h2>
            <div class="signup-form">
                <!--sign up form-->
                <form method='post' enctype="multipart/form-data">
                    @csrf
                    <input type="text" name='name' placeholder="name" value="{{ Auth::user()->name }}" />

                    <input type="number" name='price' placeholder="Price" />
          
                    <select name='category' >
                    <?php
							foreach ($category as $value) { ?>
								<option value="<?php echo $value['name'] ?>" <?php echo $value['id']  ?>><?php echo $value['name'] ?></option>
							<?php } ?>
                    </select>

                    <select name='brand'>
                    <?php
							foreach ($brand as $value) { ?>
								<option value="<?php echo $value['name'] ?>" <?php echo $value['id']  ?>><?php echo $value['name'] ?></option>
							<?php } ?>
                    </select>

                    <select name='sale' class='sale12'>
                        <option  value="1" selected="selected">New</option>
                        <option  value="2" >Sale</option>
                    </select>

                    <input class='percenSale' type="hidden" name='percenSale' placeholder="Sale (%)"  />

                    <input type="text" name='companyProfile' placeholder="Company profile" value="" />

                    <input type="file" name="multipleImage[]" multiple/>


                    <textarea rows="3" placeholder="Detail" name='descrip'></textarea>

                    <button type="submit" name='create' class="btn btn-default">Create</button>
                    <br>
                </form>
                @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
            </div>
        </div>
        <!--features_items-->
    </div>
    <script type="text/javascript">
	$(document).ready(function() {
        
        $("select.sale12").change(function(){
        var selectedSale = $(this).children("option:selected").val();
        if (selectedSale=="2"){
            $('.percenSale').attr('type','number')
        }
        else{
            $('.percenSale').attr('type','hidden')
    }
    });
   var conceptName = $('select.sale12').find(":selected").val();
    if (conceptName=="2"){
            $('.percenSale').attr('type','number')
        }
        else{
            $('.percenSale').attr('type','hidden')
    }
	});
</script>
</section>
@endsection