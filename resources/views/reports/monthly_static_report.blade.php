@extends('template.main')

@section('title', $title)

@section('content_title',"REPORTS")
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

<style>
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border no-print ">
                    <h3 class="box-title">Monthly Statics Reports</h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form class="form-horizontal" >

                    <div class="box-body" >

                        <h2 align="center">Ayruvedic Department</h2>
                        <h4 align="center">Monthly Statics Report</h4>

                        <br>
                        Institute : {{$outlet}}
                        <div class="pull-right">
                            <?php echo date('Y F'); ?>
                            <br>
                            Kesbewa District
                        </div>


                        <br>
                        <br>
                        <center>
                            <h4>Outpatient Department</h4>
                        </center>
                        <br>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">OPD opened dates : <input readonly
                                    style="border: 0px none" type="text" value="{{$nodays}}"></label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Employees Total Atendance : <input readonly
                                    style="border: 0px none" type="text" value="{{$noemp}}"></label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">AVG of daily OPD patients : <input readonly
                                    style="border: 0px none" type="text" value="{{$avgpatient}}"></label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Value of Issued medicine : <input
                                    style="border: 0px none" type="text" placeholder="enter total value"></label>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">AVG price for one patient : <input
                                    style="border: 0px none" type="text"
                                    placeholder="avg value for one patient"></label>
                        </div>
                        <br>
                        <br>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Issuing medicines according to OPD dates</label>
                            <br>
                            <br>
                            <br>
                        </div>

                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th scope="col">Day 03</th>
                                            <th scope="col">Day 05</th>
                                            <th scope="col">Day 07</th>
                                            <th scope="col">Day 06</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">No. of patients from OPD</th>
                                            <td><input style="border: 0px none" type="text" ></td>
                                            <td><input style="border: 0px none" type="text" ></td>
                                            <td><input style="border: 0px none" type="text" ></td>
                                            <td><input style="border: 0px none" type="text" ></td>
                                            <td><input style="border: 0px none" type="text" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">No. of OPD days</th>
                                            <td><input style="border: 0px none" type="text" ></td>
                                            <td><input style="border: 0px none" type="text" ></td>
                                            <td><input style="border: 0px none" type="text" ></td>
                                            <td><input style="border: 0px none" type="text" ></td>
                                            <td><input style="border: 0px none" type="text" >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <br>
                        <br>

                        <center>
                            <h4>Inpatient Department</h4>
                        </center>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">No of wards : <input readonly
                                        style="border: 0px none" type="text" value="{{$wardcnt}}"></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">No of beds in wards : <input readonly
                                        style="border: 0px none" type="text" value="{{$bedcnt}}"></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">No of in-patients in this month : <input readonly
                                        style="border: 0px none" type="text" value="{{$inpcnt}}"></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">No of in-patients discharged(this month) : <input
                                        readonly style="border: 0px none" type="text" value="{{$dispcnt}}"></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label">No of in-patient dates : <input readonly
                                        style="border: 0px none" type="text" value="{{$wardcnt}}"></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-7 control-label">AVG no of days that in-patient spent in the
                                    hospital : <input readonly style="border: 0px none" type="text"
                                        value="{{$wardcnt}}"></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-7 control-label">Monthly revenue for the medicines issued for the
                                    in-patients : <input style="border: 0px none" type="text"
                                        placeholder="enter value"></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-7 control-label">Revenue for the medicines issued for one
                                    in-patient day : <input style="border: 0px none" type="text"
                                        placeholder="enter value"></label>
                            </div>
                        </div>
                        <br>
                        <br>

                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-9"></div>
                            <div class="col-sm-2 no-print"><button type="button" class="btn btn-success"
                                    onclick="myFunction()">Add Row</button></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>type of drug produced</th>
                                            <th colspan="2">Drugs produced in the institute</th>
                                            <th colspan="2">Drugs received from othe institutes</th>
                                            <th colspan="2">Drugs received from Pharmaceutical Corporation</th>
                                            <th colspan="2">Total Medicines Available</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>Quentity</th>
                                            <th>Value</th>
                                            <th>Quentity</th>
                                            <th>Value</th>
                                            <th>Quentity</th>
                                            <th>Value</th>
                                            <th>Quentity</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td><input style="border: 0px none" type="text"></td>
                                            <td><input style="border: 0px none" type="text"></td>
                                            <td><input style="border: 0px none" type="text"></td>
                                            <td><input style="border: 0px none" type="text"></td>
                                            <td><input style="border: 0px none" type="text"></td>
                                            <td><input style="border: 0px none" type="text"></td>
                                            <td><input style="border: 0px none" type="text"></td>
                                            <td><input style="border: 0px none" type="text"></td>
                                            <td><input style="border: 0px none" type="text"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <center>
                            <h3>Dry Medicines Provision</h3>
                        </center>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Total value for the medicines which bought this
                                month </label>

                            <div class="col-sm-9">
                                <input type="text" style="border: 0px none" class="form-control"
                                    placeholder="total value for medicines">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Total value for the medicines which got as
                                donations </label>

                            <div class="col-sm-9">
                                <input type="text" style="border: 0px none" class="form-control"
                                    placeholder="total value for medicines as donations">
                            </div>
                        </div>
                        <br>
                        <br>
                        <center>
                            <h3>Approval Board</h3>
                        </center>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Total number of employees approved to the hospital(in
                                all grades)</label>

                            <div class="col-sm-9">
                                <input type="text" style="border: 0px none" class="form-control"
                                    placeholder="number of employees">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Number of employees served for this month</label>

                            <div class="col-sm-9">
                                <input type="text" style="border: 0px none" class="form-control"
                                    placeholder="Number of employees">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Number of vacancies available at the end of the
                                month(in all grades)</label>

                            <div class="col-sm-9">
                                <input type="text" style="border: 0px none" class="form-control"
                                    placeholder="Number of vacancies available">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Excess number of workers(Exceed the approved number of
                                employees)</label>

                            <div class="col-sm-9">
                                <input type="text" style="border: 0px none" class="form-control"
                                    placeholder="Excess number of workers">
                            </div>
                        </div>
                        <label>Number of days of duty in the field within the month :-</label>
                        <br><br>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Head of the institute :
                                <input type="text" style="border: 0px none" readonly value="{{$admindaycnt}}">
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Other medical officers :
                                <input type="text" style="border: 0px none" readonly value="{{$doctordaycnt}}">
                            </label>
                        </div>



                        <br>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <p>I certified that the above statical reports and informations are true</p>
                                <div class="pull-right">
                                    <p>.............................</p>
                                    <p>Certified By</p>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer no-print">
                        <button action="refresh()" type="submit" class="btn btn-default no-print">Cancel</button>
                        <button onclick="window.print()" class="float-right btn btn-warning no-print">Print <i
                                class="fas fa-print"></i></button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->


</section>
<script>
    function myFunction() {
                var table = document.getElementById("myTable");
                var row = table.insertRow(2);

                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var cell8 = row.insertCell(7);
                var cell9 = row.insertCell(8);

                var input="<input style='border: 0px none' type='text'>";
                cell1.innerHTML = input;
                cell2.innerHTML = input;
                cell3.innerHTML = input;
                cell4.innerHTML = input;
                cell5.innerHTML = input;
                cell6.innerHTML = input;
                cell7.innerHTML = input;
                cell8.innerHTML = input;
                cell9.innerHTML = input;
            }
</script>
@endsection
