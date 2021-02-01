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
                    <input type="text" name='name' placeholder="<?php echo $productUpdated['name'] ?>" value="{{$productUpdated['name']}}" />

                    <input type="number" name='price' placeholder="<?php echo $productUpdated['price'] ?>" value="{{$productUpdated['price']}}" />

                    <select name='category'>
                        <?php
                        foreach ($category as $value) { ?>
                            <option value="<?php echo $value['name'] ?>" <?php echo ($value['name'] == $productUpdated['category']) ? 'selected' : ' ' ?>><?php echo $value['name'] ?></option>
                        <?php } ?>
                    </select>
                    <select name='brand'>
                        <?php
                        foreach ($brand as $value) { ?>
                            <option value="<?php echo $value['name'] ?>" <?php echo ($value['name'] == $productUpdated['brand']) ? 'selected' : ' ' ?>><?php echo $value['name'] ?></option>
                        <?php } ?>
                    </select>

                    <select name='sale' class='sale12'>
                        <option value="1" <?php echo ($productUpdated['sale'] == 1) ? 'selected' : ' ' ?>>New</option>
                        <option value="2" <?php echo ($productUpdated['sale'] == 2) ? 'selected' : ' ' ?>>Sale</option>
                    </select>

                    <input class='percenSale' type="hidden" name='amount_sale' placeholder="Sale (%)" />

                    <input type="text" name='company' placeholder="<?php echo $productUpdated['company'] ?>" value="" />

                    <input type="file" name="multipleImage[]" multiple />
             
                    <ul>
                    <?php
                        foreach (json_decode($productUpdated['images'], TRUE) as $value) { ?>
                        <li>                  
                            <input type="checkbox" id="" name="remove[]" value="{{$value}}" />
                            <label for="myCheckbox1"><img src="{{ asset('upload/user/'.Auth::id().'/'.$value)}}" /></label>
                        </li>   
                        <?php } ?>
                            
                    </ul>

                    <textarea rows="3" placeholder="<?php echo $productUpdated['descrip'] ?>" name='descrip'></textarea>

                    <button type="submit" name='create' class="btn btn-default">Update</button>
                    <br>
                </form>
                <!-- @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif -->
            </div>
        </div>
        <!--features_items-->
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("select.sale12").change(function() {
                var selectedSale = $(this).children("option:selected").val();
                if (selectedSale == "2") {
                    $('.percenSale').attr('type', 'number')
                } else {
                    $('.percenSale').attr('type', 'hidden')
                }
            });
            var conceptName = $('select.sale12').find(":selected").val();
            if (conceptName == "2") {
                $('.percenSale').attr('type', 'number')
            } else {
                $('.percenSale').attr('type', 'hidden')
            }
        });
    </script>

</section>
<style>
    ul {
  list-style-type: none;
}

li {
  display: inline-block;
}

input[type="checkbox"][id^="myCheckbox"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}
</style>
@endsection