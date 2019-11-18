@extends('template.main')

@section('title', $title)

@section('content_title',"Attendance Report")
@section('content_description',"Generate Your Report Here...")
@section('breadcrumbs')

<ol class="breadcrumb">
<li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
<?php $user = Auth::user();
$name = $user->name;
$user_type =$user->user_type;
$image_path =$user->img_path;
$outlet = 'Rural Ayruvedic Hospital Kesbawa'?>

<section class="content">

    <div class="box box-danger">

        <div class="box-header with-border">

            <h3 class="box-title">Enter Details :-</h3>

        </div>
        <!-- /.box-header -->

        <form method="post" action="{{ route('gen_att_reports') }}" >
            {{csrf_field()}}
        <div class="box-body" style="">
            <div class="row">

                <div class="col-md-12">
                        <div class="col-md-6">

                    <div class="form-group">
                    <label>Select Attendeance Type</label>
                    <select class="form-control" style="width: 100%;" name="type" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected="selected" data-select2-id="3">My Attendance</option>
                        <option>All</option>
                        <option>Doctors</option>
                        <option>General Staff</option>
                    </select>
                    </div>
                    <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">

                    <div class="form-group">
                        <label>Starting Date:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="start" placeholder="Enter date">
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Ending Date:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="end" placeholder="Enter date">
                        </div>
                        <!-- /.input group -->
                    </div>

                </div>

                <div class="form-group">
                    <input type="submit" value="Get Report" class="btn btn-warning pull-right">
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-body -->
    </form>

    </div>



</section>

<script>
$(function() {
    $('input[name="start1"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    });
});
$(function() {
    $('input[name="end1"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    });
});
</script>

@endsection
