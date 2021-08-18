@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Profile Edit</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ url('admin/profile/store/'.$dataToEdit->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
{{--                                    --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin User Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" required="" value="{{ $dataToEdit->name }}"></div>
                                            </div>
                                        </div>
{{--                                        end row md 6--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Admin User Email <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" required="" value="{{ $dataToEdit->email }}"></div>
                                            </div>
                                        </div>

                                    </div>
{{--                                    end row --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Profile Image<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" id="image" name="profile_photo_path" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img id="showImage" src="{{ !empty($dataToEdit->profile_photo_path) ?
                                                url('upload/admin_images/'.$dataToEdit->profile_photo_path) :
                                                url('upload/no_image.jpg') }}" alt="" style="width: 100px; height: 100px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                        <button class="btn btn-rounded btn-danger mb-5"><a href="{{ url('admin/profile/'.$dataToEdit->id) }}" style="color: white; text-decoration: none">Back</a></button>
                                    </div>
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
</div>

<script type="text/javascript">
{{--    display image when uploaded--}}
    $(document).ready(function() {
        $('#image').change(function(e) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>

@endsection
