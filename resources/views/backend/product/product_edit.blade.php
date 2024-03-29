@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Product</h4>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('product-update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-12">
                                    {{--                                    start 1st row--}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Brand Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control" required>
                                                        <option value="" selected="" disabled>Select Brand</option>
                                                        @foreach($brands as $brand)
                                                            <option value="{{ $brand->id }}" {{$product->brand_id == $brand->id ? 'selected' : ''}}>{{ $brand->brand_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Category Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" required>
                                                        <option value="" selected="" disabled>Select Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{ $category->category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" class="form-control" required>
                                                        @foreach($subCategories as $sub)
                                                            <option value="{{ $sub->id }}" {{$product->subcategory_id == $sub->id ? 'selected' : ''}}>{{ $sub->subcategory_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    end 1st row--}}
                                    {{--                                    start 2nd row--}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>SubSubCategory<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" class="form-control" required>
                                                        @foreach($subSubCategories as $subsub)
                                                            <option value="{{ $subsub->id }}" {{$product->subsubcategory_id == $subsub->id ? 'selected' : ''}}>{{ $subsub->subsubcategory_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subsubcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control" value="{{ $product->product_name_en }}" required>
                                                </div>
                                                @error('product_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name Vietnamese<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_vn" class="form-control" value="{{ $product->product_name_vn }}" required>
                                                </div>
                                                @error('product_name_vn')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    end 2nd row--}}
                                    {{--                                    start 3rd row--}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Code<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}" required>
                                                </div>
                                                @error('product_code')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Quantity<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control" value="{{ $product->product_qty }}" required>
                                                </div>
                                                @error('product_qty')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tag English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_en" class="form-control"  value="{{ $product->product_tags_en }}" data-role="tagsinput" required>
                                                </div>
                                                @error('product_tags_en')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    end 3rd row--}}
                                    {{--                                    start 4th row--}}
                                    <div class="row">
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tag Vietnamese<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_vn" class="form-control" value="{{ $product->product_tags_vn }}"  data-role="tagsinput" required>
                                                </div>
                                                @error('product_tags_vn')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" class="form-control"  value="{{ $product->product_size_en }}" data-role="tagsinput">
                                                </div>
                                                @error('product_size_en')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size Vietnamese<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_vn" class="form-control"  value="{{ $product->product_size_vn }}" data-role="tagsinput">
                                                </div>
                                                @error('product_size_vn')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    end 4th row--}}
                                    {{--                                    start 5th row--}}
                                    <div class="row">
                                        {{--                                        end col md 6--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Color English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" class="form-control"  value="{{ $product->product_color_en }}" data-role="tagsinput" required>
                                                </div>
                                                @error('product_color_en')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Color Vietnamese<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_vn" class="form-control"  value="{{ $product->product_color_vn }}" data-role="tagsinput" required>
                                                </div>
                                                @error('product_color_vn')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    end 5th row--}}
                                    <div class="row">
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Selling Price<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control" value="{{ $product->selling_price }}" required>
                                                </div>
                                                @error('selling_price')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
                                                </div>
                                                @error('discount_price')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    end 6th row--}}
                                    {{--                                    start 7th row--}}
                                    <div class="row">
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    {{--                         {!!  !!} to delete <p> tag--}}
                                                    <textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text">{!! $product->short_descp_en !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        end col 4--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description Vietnamese<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_vn" id="textarea" class="form-control" required placeholder="Textarea text">{!! $product->short_descp_vn !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    end 7th row--}}
                                    {{--                                    start 8th row--}}
                                    <div class="row">
                                        {{--                                        end col md 4--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description English<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <textarea id="editor1" name="long_descp_en" rows="10" cols="80" required>
                                                        {!! $product->long_descp_en !!}
                                                </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        end col 4--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description Vietnamese<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <textarea id="editor2" name="long_descp_vn" rows="10" cols="80" required>
                                                        {!! $product->long_descp_vn !!}
                                                </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    end 8th row--}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $product->hot_deals ? 'checked' : '' }}>
                                                <label for="checkbox_2">Hot Deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $product->featured ? 'checked' : '' }}>
                                                <label for="checkbox_3">Featured</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $product->special_offer ? 'checked' : '' }}>
                                                <label for="checkbox_4">Special Offer</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $product->special_deals ? 'checked' : '' }}>
                                                <label for="checkbox_5">Special Deals</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

{{--    Start Multiple Image Update Area --}}
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                </div>
                <form action="{{ route('update-product-image') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                        @foreach($multiImgs as $img)
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 400px; width: 400px">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('product.multiimg.delete', $img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
                                    </h5>
                                    <p class="card-text">
                                        <div class="form-group">
                                        <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
{{--                                        attach id img to replace --}}
                                        <input class="form-control" type="file" name="multi_img[{{$img->id}}]">
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
{{--                        end col-md-3 --}}
                    </div>
{{--                    end row-sm--}}
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                    </div>
                    <br><br>
                </form>
            </div>
        </div>

    </div>
{{--    end row--}}
{{--    Start Add New Image--}}
</section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Add Product Image <strong>Update</strong></h4>
                    </div>
                    <form action="{{ route('add.product.images', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="form-group">
                                            <label class="form-control-label">Add Image <span class="tx-danger">*</span></label>
                                            {{--                                        attach id img to replace --}}
                                            <div class="controls">
                                                <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg" required>
                                            </div>
                                            <img src="" id="imageToAdd" alt="">
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{--                        end col-md-3 --}}
                        </div>
                        {{--                    end row-sm--}}
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Images">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>

        </div>
        {{--    end row--}}
    </section>
{{--    End Add New Image--}}

{{--    Start Thumbnail Image Update Area --}}
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">Product Thumbnail Image <strong>Update</strong></h4>
                </div>
                <form action="{{ route('update-product-thumbnail') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id  }}">
                    <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">
                    <div class="row row-sm">
                            <div class="col-md-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset($product->product_thumbnail) }}" class="card-img-top" style="height: 400px; width: 400px">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="form-group">
                                            <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                            {{--                                        attach id img to replace --}}
                                            <input class="form-control" type="file" name="product_thumbnail" onChange="mainThumbnailUrl(this)">
                                            <img src="" id="mainThumb" alt="">
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        {{--                        end col-md-3 --}}
                    </div>
                    {{--                    end row-sm--}}
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Thumbnail">
                    </div>
                    <br><br>
                </form>
            </div>
        </div>

    </div>
    {{--    end row--}}
</section>
{{--    end Thumbnail image section--}}




</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            const category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="subsubcategory_id"]').html('');
                        const d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="subcategory_id"]').on('change', function(){
            const subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('category/sub-subcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        const d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en +'</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

<script type="text/javascript">
    function mainThumbnailUrl(inputImg) {
        if(inputImg.files && inputImg.files[0]) {
            const reader = new FileReader();
            reader.onload = function(ele) {
                $('#mainThumb').attr('src', ele.target.result).width(80).height(80);
            };
            reader.readAsDataURL(inputImg.files[0]);
        }
    }
</script>

<script>
    $(document).ready(function(){
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                const data = $(this)[0].files; //this file data
                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                        const fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                            return function(e) {
                                const img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                                    .height(80); //create image element
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>

@endsection
