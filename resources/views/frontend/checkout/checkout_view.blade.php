@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('title')
    @if(session()->get('language') == 'vietnamese')
        Đặt hàng
    @else
        My Checkout
    @endif
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">
                        @if(session()->get('language') == 'vietnamese')
                            Trang chủ
                        @else
                            Home
                        @endif
                    </a></li>
                <li class='active'>
                    @if(session()->get('language') == 'vietnamese')
                        Đặt hàng
                    @else
                        Checkout
                    @endif
                </li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- shipping address -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>
                                            <form class="register-form" role="form">
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"> <b> Shipping Name </b> <span>*</span></label>
                                                    <input type="text"
                                                           name="shipping_name"
                                                           class="form-control unicase-form-control text-input"
                                                           id="exampleInputEmail1"
                                                           placeholder="Full Name"
                                                           value="{{ Auth::user()->name }}" required>
                                                </div>
{{--                                                end form group--}}
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"> <b> Email </b><span>*</span></label>
                                                    <input type="text"
                                                           name="shipping_email"
                                                           class="form-control unicase-form-control text-input"
                                                           id="exampleInputEmail1"
                                                           placeholder="Email"
                                                           value="{{ Auth::user()->email }}" required>
                                                </div>
{{--                                                end form group--}}
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"> <b> Phone </b><span>*</span></label>
                                                    <input type="text"
                                                           name="shipping_phone"
                                                           class="form-control unicase-form-control text-input"
                                                           id="exampleInputEmail1"
                                                           placeholder="Phone"
                                                           value="{{ Auth::user()->phone }}" required>
                                                </div>
                                                {{--                                                end form group--}}
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1"><b> Post Code </b><span>*</span></label>
                                                    <input type="text"
                                                           name="post_code"
                                                           class="form-control unicase-form-control text-input"
                                                           id="exampleInputEmail1"
                                                           placeholder="Post Code" required>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- shipping address -->

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <div class="form-group">
                                                <h5> <b> Division Select </b><span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="division_id" class="form-control" required>
                                                        <option value="" selected="" disabled>Select Category</option>
                                                        @foreach($divisions as $item)
                                                            <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('division_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                {{--                                                end form group --}}
                                                <div class="form-group">
                                                    <h5><b> Select District </b><span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="district_id" class="form-control" required>
                                                            <option value="" selected="" disabled>Select District</option>
                                                        </select>
                                                        @error('district_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                    {{--                                                end form group --}}
                                                <div class="form-group">
                                                    <h5><b> Select State </b> <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="state_id" class="form-control" required>
                                                            <option value="" selected="" disabled> Select State </option>
                                                        </select>
                                                        @error('state_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1"><b> Notes </b> <span>*</span></label>
                                                <textarea class="form-control" name="notes" id="" cols="30" rows="5" placeholder="Notes"></textarea>
                                            </div>
                                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Checkout</button>
                                        </div>
                                        <!-- already-registered-login -->

                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $item)
                                            <li>
                                                <strong>Image: </strong>
                                                <img src="{{ asset($item->options->image) }}" style="height: auto; max-width: 60px;" alt="">
                                            </li>
                                            <li>
                                                <strong>Quantity: </strong> ({{ $item->qty }})
                                                <strong>Color: </strong> {{ $item->options->color }}
                                                <strong>Size: </strong> {{ $item->options->size }}
                                            </li>
                                            <hr>
                                        @endforeach
                                            <li>
                                                @if(Session::has('coupon'))
                                                    <strong>Subtotal: </strong>${{ $cartTotal }}
                                                    <hr>
                                                    <strong>Coupon Name: </strong>{{ session()->get('coupon')['coupon_name'] }} ({{ session()->get('coupon')['coupon_discount'] }} %)
                                                    <hr>
                                                    <strong>Coupon Discount: </strong>${{ session()->get('coupon')['discount_amount'] }}
                                                    <hr>
                                                    <strong>Grand Total: </strong>${{ session()->get('coupon')['total_amount'] }}
                                                @else
                                                    <strong>Subtotal: </strong>${{ $cartTotal }}
                                                    <hr>
                                                    <strong>Grandtotal: </strong>${{ $cartTotal }}
                                                @endif
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function(){
            const division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{  url('/district-get/ajax') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="district_id"]').empty();
                        $('select[name="state_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        $('select[name="district_id"]').on('change', function(){
            const district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: "{{  url('/state-get/ajax') }}/"+district_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="state_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name +'</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>


@endsection
