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
    $user_type = $user->user_type;
    $image_path = $user->img_path;
    $outlet = 'Rural Ayruvedic Hospital Kesbawa'?>

    <section class="content">

        <div class="box">


            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Attend Dates</th>
                                    <th>Short Leave</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($details as $result)
                                    <tr>
                                        <td>{{$result->name}}</td>
                                        <td>{{$result->type}}</td>
                                        <td>{{$result->attended}}</td>
                                        <td>{{$result->shortleave}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Attend Dates</th>
                                <th>Short Leave</th>
                                </tfoot>

                            </table>

                        </div>

                    </div>
                </div>

                {{-- print priview --}}
                <div class="col-md-3">
                    <form action="{{route('all_print_preview')}}" method="get">
                        {{csrf_field()}}
                        <button type="submit" class="btnprn btn btn-danger">Print Preview</button>
                        <input type="text" name="start" value={{$start}} style="display:none">
                        <input type="text" name="end" value={{$end}} style="display:none">
                        <input type="text" name="type" value={{$type}} style="display:none">
                    </form>
                </div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btnprn').printPage();
        });
    </script>

@endsection
