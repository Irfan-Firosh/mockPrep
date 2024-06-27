<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/bfb6533a4c.js" crossorigin="anonymous"></script>
    <style>
        html {
            overflow: hidden;
            height: 100%;
        }

        body {
            height: 100%;
            overflow: auto;
        }
    </style>
</head>
<body style="background-image: url('{{asset('assets/images/login-bg.jpg')}}');background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">
            <div class="container">
                <div class="row d-flex justify-content-center mt-5 align-items-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        @yield('body')
                    </div>
                </div>
            </div>
</body>
</html>