@extends('template.main')

@section('title', $title)

@section('content_title',"Reset User")
@section('content_description',"Reset Any User Password To System Default")
@section('breadcrumbs')

<ol class="breadcrumb">
  <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
  <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<div style="margin-top:1.5vh;padding:3%" class="row">
  <div class="col-md-2"></div>
  <div class="mx-auto col-md-8">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{session()->get('success')}}
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{session()->get('error')}}
        </div>
        @endif
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Reset User</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form method="POST" action="{{route('resetuser_save')}}" class="form-horizontal">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputEmail3">User ID</label>

            <div class="col-sm-10">
              <input class="form-control" name="userid" id="inputEmail3" required type="text" placeholder="User ID">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="inputPassword3">Your Password</label>

            <div class="col-sm-10">
              <input class="form-control" name="admin_password" id="inputPassword3" type="password"
                placeholder="Password">
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input class="btn btn-default" type="reset" value="Cancel">
          <button class="btn btn-info pull-right" type="submit">Reset User</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </div>
  <div class="col-md-2"></div>
</div>

@endsection