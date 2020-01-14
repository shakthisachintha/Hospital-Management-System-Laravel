@extends('template.main')

@section('title', $title)

@section('content_title',"User Profile")
@section('content_description',"Personalize Your Account")
@section('breadcrumbs')

    <ol class="breadcrumb">
        <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
        <li class="active">Here</li>
    </ol>
@endsection

@section('main_content')
    <?php $user = Auth::user();
    $name = $user->name;
    $user_type = $user->user_type;
    $image_path = $user->img_path;
    $outlet = 'Rural Ayruvedic Hospital Kesbawa'?>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Statics Reports</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">

                            <center><h3>Outpatient Department</h3></center>
                            <br>

                            <div class="form-group">
                                <label  class="col-sm-3 control-label">OPD opened dates</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="enter number of dates">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-3 control-label">Employees Total Atendance</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="total attendance">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-3 control-label">AVG of daily OPD patients</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="avg of opd patients">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-3 control-label">Value of Issued medicine</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="medicine value">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-3 control-label">AVG price for one patient</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="avg for one patient">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Issuing medicines according to OPD dates</label>
                                <br>
                            </div>

                            {{--  <div class="row">  --}}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th scope="col">Day 03</th>
                                            <th scope="col">Day 05</th>
                                            <th scope="col">Day 07</th>
                                            <th scope="col">Day 06</th>
                                            <th scope="col">Day</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">No. of patients from OPD</th>
                                        <td><input type="text" name="no_patient_day3"></td>
                                        <td><input type="text" name="no_patient_day5"></td>
                                        <td><input type="text" name="no_patient_day7"></td>
                                        <td><input type="text" name="no_patient_day6"></td>
                                        <td><input type="text" name="no_patient_day"></td>
                                        <td><input type="text" name="no_patient_total"></td>
                                        </tr>
                                        <tr>
                                        <th scope="row">No. of OPD days</th>
                                        <td><input type="text" name="no_opd_day3"></td>
                                        <td><input type="text" name="no_opd_day5"></td>
                                        <td><input type="text" name="no_opd_day7"></td>
                                        <td><input type="text" name="no_opd_day6"></td>
                                        <td><input type="text" name="no_opd_day"></td>
                                        <td><input type="text" name="no_opd_day_total"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            {{--  </div>  --}}

                            <center><h3>Inpatient Department</h3></center>
                            <br>

                            <div class="form-group">
                                <label  class="col-sm-3 control-label">No of wards</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="enter no of wards">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">No of wards</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="enter no of wards">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">No of wards</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="enter no of wards">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">No of wards</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="enter no of wards">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">No of wards</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="enter no of wards">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">No of wards</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="enter no of wards">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">No of wards</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="enter no of wards">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-info pull-right">Sign in</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>

        </div>
        <!-- /.row -->

    </section>

@endsection
