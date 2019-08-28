@extends('dash')

@section('content')
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
            <form method="POST" action="{{ route('patient_register') }}" class="form-horizontal">
              <div class="box-body">
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-10 control-label">Reg. No:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="reg_pno" placeholder="Number">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reg_pname" placeholder="Enter Patient Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reg_paddress" placeholder="Enter Patient Address ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Occupation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reg_poccupation" placeholder="Enter Patient Occupation ">
                    </div>
                </div>
                {{-- <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>
              </div> --}}
              <!-- select -->
            <div class="form-group">
                <label class="col-sm-2 control-label">Sex</label>
                <div class="col-sm-3">
                    <select class="form-control" id="reg_psex">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <label for="inputEmail3" class="col-sm-1 control-label">Age</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="reg_page" placeholder="Enter Age">
                </div>
                <!-- Date -->
                <label class="col-sm-1 control-label">Date</label>
                <div class="col-sm-3">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="dd/mm/yyyy">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Register</button>
            </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
    </div>

    @endsection
