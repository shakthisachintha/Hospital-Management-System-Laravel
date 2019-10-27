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
        <div class="mx-auto row">
            <div class="col-3"></div>
            <div style="margin-top:30vh;" class="col-6">
                    <div style="height:6.5cm;width:11cm" class="border border-dark rounded bg-light">
                        <div class="rounded" style="margin-left:0.01cm;height:1.7cm;width:10.93cm;background-color:rgb(204, 99, 14)">
                            <h4 style="padding-top: 16px;font-weight: lighter"
                                class="text-uppercase text-center text-white">Ayruvedic Hospital Kesbawa</h4>
                        </div>
                        <div style="margin-left:1px;font-size:13px" class="row mt-2">
    
                            <div class="col-4">
                                <span>Reg. Num.<br></span>
                                <span>Name<br></span>
                                <span>Birth Day & Sex<br></span>
                                <span>Registration Date<br></span>
                            </div>
                            <div class="col-1 m-0 p-0 text-left">
                                <span>: <br></span>
                                <span>: <br></span>
                                <span>: <br></span>
                                <span>: </span>
                            </div>
                            <div class="col-7 m-0 p-0">
                                <div class="row m-0 p-0">
                                    <div class=" m-0 p-0 col-7">
                                    <span>{{$id}}<br></span>
                                    <span>{{$name}}<br></span>
                                    <span>{{$dob}} {{ucfirst($sex)}}<br></span>
                                    <span>{{$reg}}</span>
                                    </div>
                                    <div  class="col-3 m-0 p-0">
                                        <img src="{{$url}}"
                                            style="width: 70px;height:70px;" alt="...">
                                    </div>
                                </div>
                            </div>
    
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <div class="mt-3 mx-auto">
                                      
                                        <?php 
                                        echo '<img src="/' . DNS1D::getBarcodePNGPath(preg_replace('/\s+/', '', $id), "C39+",1.5,70,array(0,0,0), true) . '" alt="barcode"   />';
                                            ?>
                                </div>
                                   
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            <div class="col-3">
                <button onclick="window.print()" class="mt-5 btn-sm btn btn-outline-primary no-print">Print <i class="fas fa-print"></i></button>
            </div>
        
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
