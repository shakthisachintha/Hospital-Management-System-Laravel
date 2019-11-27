@extends('template.main')

@section('title', $title)

@section('content_title',"Pharamacy")
@section('content_description',"Issue medicines here.")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')
{{--  issue medicine  --}}

<div @if (session()->has('regpsuccess') || session()->has('regpfail')) style="margin-bottom:0;margin-top:3vh" @else
    style="margin-bottom:0;margin-top:8vh" @endif class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @if (session()->has('regpsuccess'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{session()->get('regpsuccess')}}
        </div>
        @endif
        @if (session()->has('regpfail'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{session()->get('regpfail')}}
        </div>
        @endif

    </div>
    <div class="col-md-1"></div>

</div>





<div class="box box-info" id="issuemedicine1">
    <div class="box-header with-border">
        <h3 class="box-title">Enter Registration No. Or Scan the bar code</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Registration No:</label>
                <div class="col-sm-10" id="al-box">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Enter reg No" />
                </div>
            </div>
        </div>
        <!-- /.box-body -->

    </form>

    <div class="box-footer">
        <button type="button" class="btn btn-info pull-right" onclick="issuemedicinefunction()">Enter</button>
    </div>
    <!-- /.box-footer -->


</div>


<div class="row" id="issuemedicine2" style="display:none">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Prescription</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Registration No.</th>
                            <th>Appointment No.</th>
                            <th>Medicine</th>
                            <th>Issued or Not</th>

                        </tr>
                    </thead>



                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<!-- /.content -->
















<script>
    function issuemedicinefunction() {
        

        var x;
        x = document.getElementById("inputEmail3").value;
        if (x == 0) 
        {
            alert("Please Enter a Registration Number!");
            window.location.$("#issuemedicine1");
        }

        $("#issuemedicine2").slideDown(1000);
        $("#issuemedicine1").slideUp(1000);
       
    }

    
   

</script>



@endsection