<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/af9fc7310f.js"></script>

    <title>Print Attendance</title>

    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <button onclick="window.history.back()" class="mt-5 btn-sm btn btn-success no-print"><i
                            class="fa fa-arrow-left"></i> Back
                    </button>
                    <button onclick="window.print()" class="mt-5 btn-sm btn btn-warning no-print">Print <i
                            class="fas fa-print"></i></button>
                    <button onclick="HTMLtoPDF()" class="mt-5 btn-sm btn btn-danger no-print">Download PDF</button>
                </div>
            </div>
            <br>

            <div class="box" id="HTMLtoPDF">
                <h2 align="center">CENTRAL HOSPITAL OF AYRVEDA</h2>
                <h4 align="center">Clinic Report</h4>

                <br>
                {{-- <label>Date : -----------------------</label>
                <br> --}}
                <label>Date : @php echo date('Y/m/d'); @endphp</label>
                <br>
                <br>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Clinic Name</th>
                                    <th>Doctor Incharge</th>
                                    <th>male</th>
                                    <th>female</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Clinic::all() as $item)
                                <tr>
                                    <td>{{$item->name_eng}}</td>
                                    <td>Dr.{{ucwords($item->doctor->name)}}</td>
                                    @php
                                    $male=0;
                                    $female=0;
                                    foreach ($item->patients as $patient){

                                    if($patient->sex=="Male"){
                                    $male+=1;
                                    }else{
                                    $female+=1;
                                    }
                                    }
                                    @endphp
                                    <td>{{$male}}</td>
                                    <td>{{$female}}</td>
                                    <td>{{$item->patients->count()}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>Clinic Name</th>
                                <th>Doctor Incharge</th>
                                <th>male</th>
                                <th>female</th>
                                <th>Total</th>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <br>
                <label>Made By : {{$name}}</label>
                <div align="right">
                    <label style="display:block">...............................................................</label>
                    <label>Sighned By , Officer</label>
                </div>
                <br>
                <br>
            </div>
        </section>
    </div>
    <script src="js/pdf_js/jspdf.js"></script>
    <script src="js/pdf_js/jquery-2.1.3.js"></script>
    <script src="js/pdf_js/pdfFromHTML.js"></script>
</body>

</html>
