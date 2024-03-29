@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {{--            Add Slider Page--}}
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form action="{{ route('slider.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $sliderToEdit->id }}">
                                    <input type="hidden" name="old_image" value="{{ $sliderToEdit->slider_img }}">
                                    <div class="form-group">
                                        <h5>Slider Title<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            @if($sliderToEdit->title)
                                                <input type="text" name="title" class="form-control" value="{{ $sliderToEdit->title }}">
                                            @else
                                                <input type="text" name="title" class="form-control" value="" placeholder="Optional">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Slider Description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            @if($sliderToEdit->description)
                                                <input type="text" name="description" class="form-control" value="{{ $sliderToEdit->description }}">
                                            @else
                                                <input type="text" name="description" class="form-control" value="" placeholder="Optional">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Slider Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="slider_img" class="form-control">
                                            @error('slider_img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <!-- /.box -->
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection
