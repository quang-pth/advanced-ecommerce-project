<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    {{--Toaster--}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css')  }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
{{-- sweet alert for add to cart portion --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{--Toastr CDN LINK --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
    const type = "{{ Session::get('alert-type', 'info') }}";
    switch(type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

<!-- Add to cart product model -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span></strong></h5>
{{--                Button To CLOSE ADD TO CART model--}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
{{--            modal body--}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="..." style="height: 200px; width: 200px" id="pimage">
                        </div>
                    </div>
{{--                    end col-md-4 --}}
                    <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item">Product Price:
                                <strong class="text-danger"> $<span id="pprice"></span> </strong>
                                <del id="oldprice"></del>
                            </li>
                            <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                            <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                            <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                            <li class="list-group-item">Stock:
                                <span class="badge badge-pill badge-success" id="available" style="background: green; color: white;"></span>
                                <span class="badge badge-pill badge-danger" id="stockout" style="background: red; color: white;"></span>
                            </li>
                        </ul>
                    </div>
{{--                    end col-md-4 --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="color">Choose Color</label>
                            <select class="form-control" id="color" name="color">


                            </select>
                        </div>
{{--                    end form-group --}}
                        <div class="form-group" id="sizeArea">
                            <label for="size">Choose Size</label>
                            <select class="form-control" id="size" name="size">


                            </select>
                        </div>
{{--                    end form-group --}}
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="qty" value="1" min="1">
                        </div>
{{--                    end form-group --}}
                        <input type="hidden" id="product_id">
                        <button type="submit" class="btn btn-primary" onclick="addToCart()">Add To Cart</button>
                    </div>
{{--                    end col-md-4 --}}
                </div>
{{--                end row --}}
            </div>
{{--            end modal body --}}
        </div>
    </div>
</div>
{{--end add to cart--}}

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
//    start product view with Modal
    function productView(productId) {
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/' + productId,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#pname').text(data.product.product_name_en);
                $('#price').text(data.product.selling_price);
                $('#pcode').text(data.product.product_code);
                $('#pcategory').text(data.product.category.category_name_en);
                $('#pbrand').text(data.product.brand.brand_name_en);
                $('#pimage').attr('src', '/' + data.product.product_thumbnail);

                $('#product_id').val(productId); // id to add to cart
                $('#qty').val(1); // default qty

                // Product Price
                if (data.product.discount_price == null) {
                    $('#oldprice').empty();
                    $('#pprice').text(data.product.selling_price);

                } else {
                    $('#pprice').text(data.product.discount_price);
                    $('#oldprice').text('$' + data.product.selling_price);
                } // end product PRICE

                // start STOCK option
                if (data.product.product_qty > 0) {
                    $('#stockout').empty();
                    $('#available').text('Available');

                } else {
                    $('#available').empty();
                    $('#stockout').text('Stock Out');

                }

                // display product COLOR options
                $('select[name="color"]').empty();
                $.each(data.colorEn, function (key, value) {
                    $('select[name="color"]').append('<option value="'+value+'">'+value+'</option>');
                    // hide COLOR area if not exist
                    if(data.colorEn == "") {
                        $('#sizeArea').hide();
                    } else {
                        $('#sizeArea').show();
                    }
                }) // end COLOR

                // display product SIZE options
                $('select[name="size"]').empty();
                $.each(data.sizeEn, function (key, value) {
                    $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>');
                    // hide SIZE area if not exist
                    if(data.sizeEn == "") {
                        $('#sizeArea').hide();
                    } else {
                        $('#sizeArea').show();
                    }
                }) // end SIZE

            }
        })

    }
//    end product view with modal


//    START Add To Cart Product
    function addToCart() {
        const product_name = $('#pname').text();
        const id = $('#product_id').val();
        // fields selected by user
        const color = $('#color option:selected').text();
        const size = $('#size option:selected').text();
        const quantity = $('#qty').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                product_name: product_name,
                color: color,
                size: size,
                quantity: quantity,
            },
            url: "/cart/data/store/" + id,
            success: function (data) {
                miniCart();
                $('#closeModel').click(); // make sure close modal after click add to cart
            //    start message alert add to cart
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
            //    end message
            }
        });
    }
//    END Add To Cart
</script>

<script type="text/javascript">
    function miniCart() {
        $.ajax({
            type: 'GET',
            url: '/product/mini/cart',
            dataType: 'json',
            success: function (response) {
                $('span[id="cartSubTotal"]').text('$' + response.cartTotal);
                $('span[id="cartQty"]').text(response.cartQty);
                let miniCart = "";
                $.each(response.carts, function (key, value) {
                    miniCart += (`
                        <div class="cart-item product-summary">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                                </div>
                                <div class="col-xs-7">
                                    <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                    <div class="price">${value.price} * ${value.qty}</div>
                                </div>
                                <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)" class="fa fa-trash"></i></button> </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>`)
                });

                $('#miniCart').html(miniCart);
            }
        });
    }

    miniCart();

   // mini cart REMOVE
    function miniCartRemove(rowId) {
        $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/' + rowId,
            dataType: 'json',
            success: function (response) {
                miniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });

                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        type: 'success',
                        title: response.success
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        title: response.error
                    })
                }
            }
        });
    }
//    end mini cart REMOVE

</script>

{{--START Add Wishlist Page--}}
<script type="text/javascript">
function addToWishlist(product_id) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/add-to-wishlist/'+product_id,
        success: function (data) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success
                });
            } else {
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error
                })
            }
        }

    })
}

</script>


{{--END Add Wishlist Page--}}

</body>
</html>
