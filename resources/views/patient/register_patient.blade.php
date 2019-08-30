@extends('dash')

@section('content')
{{--  patient registration  --}}
  @if (session()->has('regpsuccess'))
    <div class="row">
        <div class="alert alert-success" role="alert">
            {{session()->get('regpsuccess')}}
        </div>
    </div>
  @endif
    <div class="row">
        <!-- right column -->
        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Registration Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{ route('patient_register') }}" class="form-horizontal">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_pname" placeholder="Enter Patient Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_paddress" placeholder="Enter Patient Address ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Occupation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reg_poccupation" placeholder="Enter Patient Occupation ">
                    </div>
                </div>
              <!-- select -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sex</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="reg_psex">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <label for="inputEmail3" class="col-sm-1 control-label">Age</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="reg_page" placeholder="Enter Age">
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-info pull-right" value="Register">
                    <input type="button" class="btn btn-default" value="Cancel">
                </div>
              <!-- /.box-footer -->
            </form>

                </div>
            </div>
        </div>
    </div>

    @endsection
