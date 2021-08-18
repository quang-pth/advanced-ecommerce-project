@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Change Password</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                    $adminId = Auth::guard('admin')->user()->id;
                    $dataToEdit = DB::table('admins')->find($adminId);
                ?>
                <div class="row">
                    <div class="col">
                        <form action="{{ url('update/change/password/'.$dataToEdit->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    {{--                                    --}}
                                    <div class="row">
                                        {{--                                        end row md 6--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Current Password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="current_password" name="oldpassword" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>New Password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="password" name="password" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Confirm Password <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                                <button class="btn btn-rounded btn-danger mb-5"><a href="{{ url('admin/profile/'.$dataToEdit->id) }}" style="color: white; text-decoration: none">Back</a></button>
                                            </div>
                                        </div>

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
@endsection
