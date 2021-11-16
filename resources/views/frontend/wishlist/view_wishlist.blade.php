@extends('frontend.main_master')
@section('content')
@section('title')
    @if(session()->get('language') == 'vietnamese')
        Danh sách mong muốn
    @else
        Wishlist Page
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
                        Home Page
                    @endif
                </a></li>
            <li class='active'>
                @if(session()->get('language') == 'vietnamese')
                    Danh sách mong muốn
                @else
                    Wishlist Page
                @endif</li>
        </ul>
    </div><!-- /.breadcrumb-inner -->
</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th colspan="4" class="heading-title">
                                    @if(session()->get('language') == 'vietnamese')
                                        Danh sách mong muốn
                                    @else
                                        Wishlist Page
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody id="wishlist">

                            </tbody>
                        </table>
                    </div>
                </div>			</div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div>
    <br>
@include('frontend.body.brands')
@endsection
