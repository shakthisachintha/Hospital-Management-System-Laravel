@extends('template.main')

@section('title', $title)

@section('content_title',"Notices")
@section('content_description',"Send Notices & Push General Notices To Noticeboard")
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

    <div class="row">

        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class="@if (!session('success')||session('successnotice')) active @endif">
                        <a href="#activity" data-toggle="tab"
                            aria-expanded="@if (!session('success')||session('successnotice')) true @else false @endif">Add
                            Notice</a>
                    </li>

                    <li class="@if (session('success')  ) active @endif">
                        <a href="#settings" data-toggle="tab"
                            aria-expanded="@if (session('success') ) true @else false @endif">Send
                            Notice</a>
                    </li>


                </ul>

                <div class="tab-content">

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="tab-pane @if (!session('success')||session('successnotice')) active @endif"
                        id="activity">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <div class="row">
                                        @if (session('successnotice'))
                                        <div class="alert alert-success">
                                            {{ session('successnotice') }}
                                        </div>
                                        @endif
                                        <div class="col-md-10">
                                            <br>
                                            <form class="form-inline" method="POST" action="{{route('addnotice')}}">
                                                @csrf
                                                <div class="form-group mb-2">
                                                    <input type="text" class="form-control" name="subject"
                                                        placeholder="enter subject">
                                                </div>
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <input type="text" class="form-control" name="description"
                                                        placeholder="enter description">
                                                </div>
                                                <button type="submit" class="btn btn-warning mb-2">Add</button>
                                            </form>
                                        </div>
                                        <div class="col-md-2"></div>

                                        <div class="col-sm-12">
                                            <br>
                                            <table id="example1" class="table table-bordered table-striped dataTable"
                                                role="grid" aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Description</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($notices as $app)
                                                    <tr>
                                                        <td>{{$app->subject}}</td>
                                                        <td>{{$app->description}}</td>
                                                        <td>{{$app->time}}</td>
                                                        <td>
                                                            <form action="{{route('deletenotice')}}" method="post">
                                                                @csrf
                                                                <input type="text" style="display:none" name="id"
                                                                    value="{{$app->id}}">
                                                                <button type="submit" class="btn-sm btn-danger"><i
                                                                        class="fa fa-trash">
                                                                        Delete</i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <th>Subject</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane @if (session('success') ) active @endif" id="settings">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">

                                {{--  display validattion errors  --}}

                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                                <form role="form" method="post" action="{{ route('sendnotice') }}">

                                    {{csrf_field()}}

                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Enter your Message</label>
                                        <textarea class="form-control" name="message" rows="5"
                                            placeholder="Enter Message" required></textarea>
                                    </div>

                                    <br>

                                    <div class="row">
                                        <div class="col-md-1">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Select Method :</label>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="emails" value="email"> Emails
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="sms" value="sms"> SMS
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Select Receivers :</label>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="receiverlist[]" value="admin"> Admin
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="receiverlist[]" value="doctor"> Doctor
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="receiverlist[]" value="general"> Staff
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="receiverlist[]" value="pharmacist">
                                                    Pharmasist
                                                </label>
                                            </div>
                                            {{-- <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="receiverlist[]" value="patient"> Patient
                                    </label>
                                </div> --}}
                                        </div>

                                        <div class="col-md-1">
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group col-md-2 pull-right">
                                        <input type="submit" class="btn btn-danger btn-lg" name="send" value="Send">
                                    </div>

                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

        <div class="col-md-3">

        </div>
        <!-- /.col -->
    </div>


</section>


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
