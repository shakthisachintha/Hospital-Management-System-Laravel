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

    <title>Patient Card</title>

    <style>
    @media print
{
    .no-print, .no-print *
    {
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
                                <button onclick="window.print()" class="mt-5 btn-sm btn btn-danger no-print">Print <i class="fas fa-print"></i></button>
                            </div>

                        </div>
                        <br>
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body">

                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
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
                        </div>
                    </div>
                </section>



        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>












