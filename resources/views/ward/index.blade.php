@extends('template.main')

@section('title', $title)

@section('content_title',__("Wards"))
@section('content_description',__("Ward Management"))
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div style="margin-top:1vh;padding:3%" class="pb-0 row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{session()->get('success')}}
        </div>
        @endif
        @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>

            {{session()->get('fail')}}
        </div>
        @endif
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('Add New Ward')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form method="POST" action="{{route('add-ward')}}" class="form-horizontal">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="ward_num">{{__('Ward Number')}}<span style="color:red">*</span></label></label>

                        <div class="col-sm-10">
                            <input class="form-control" name="ward_num" required id="ward_num" type="number"
                                placeholder="Ward Number">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="total_beds">{{__('Total Beds')}}<span
                                style="color:red">*</span></label></label>

                        <div class="col-sm-10">
                            <input class="form-control" required name="total_beds" id="total_beds" type="number"
                                placeholder="Total Beds">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="free_beds">{{__('Free Beds')}}<span
                                style="color:red">*</span></label></label>

                        <div class="col-sm-10">
                            <input class="form-control" required name="free_beds" id="free_beds" type="number"
                                placeholder="Free Beds">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="doctor">{{__('Doctor in-charge')}}<span
                                style="color:red">*</span></label></label>

                        <div class="col-sm-10">
                            <select class="form-control" name="doctor" id="doctor">
                                @foreach ($docs as $doctor)
                                <option value="{{$doctor->id}}">Dr. {{ucWords($doctor->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default" type="reset">{{__('Cancel')}}</button>
                    <button class="btn btn-info pull-right" type="submit">{{__('Add Ward')}}</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<div style="padding:3%" class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{__('Ward Details')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                    <br>
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th>{{__('Ward No.')}}</th>
                                <th>{{__('Bed Count')}}</th>
                                <th>{{__('Free Beds')}}</th>
                                <th>{{__('Doctor Incharge')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $app)
                            <tr>
                                <td>{{$app->ward_no}}</td>
                                <td>{{$app->beds}}</td>
                                <td>{{$app->free_beds}}</td>
                                <td>Dr. {{ucWords(App\User::find($app->doctor_id)->name)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>{{__('Ward No.')}}</th>
                            <th>{{__('Bed Count')}}</th>
                            <th>{{__('Free Beds')}}</th>
                            <th>{{__('Doctor Incharge')}}</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <!-- /.box-body -->
</div>
@endsection
@section('optional_scripts')
<script>
    $(function () {

        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })

</script>

@endsection
