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
$user_type =$user->user_type;
$image_path =$user->img_path;
$outlet = 'Rural Ayruvedic Hospital Kesbawa'?>

<section class="content">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title ">Clinic Report</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <th>Clinic Name</th>
                                    <th>Doctor Incharge</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$item->name_eng}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->total}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>Clinic Name</th>
                                <th>Doctor Incharge</th>
                                <th>Total</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- /.box-body -->
            {{-- print priview --}}
            <div class="col-md-3">
                <form action="{{route('print_clinic')}}" method="post">
                    @csrf
                    <button type="submit" class="btnprn btn btn-danger">Print Preview</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->

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
<script type="text/javascript">
    $(document).ready(function () {
            $('.btnprn').printPage();
        });
</script>

@endsection
