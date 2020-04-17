
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Beranda</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('/') }}assets/img/favicon.ico' />
</head>

<body>
<div class="loader"></div>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">

                    <div class="login-brand">
                        Silahkan Pilih Absen !
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Pilih Absen :</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <a href="{{ url('absen/apel') }}"><button class="btn btn-info" style="height: 150px; width: 150px; font-size: 15pt;"> Absen Apel </button></a>
                                </div>
                                <div class="col-md-4 text-center">
                                    <a href="{{ url('absen/pagi') }}"><button class="btn btn-info" style="height: 150px; width: 150px; font-size: 15pt;"> Absen Pagi </button></a>
                                </div><div class="col-md-4 text-center">
                                    <a href="{{ url('absen/siang') }}"><button class="btn btn-info" style="height: 150px; width: 150px; font-size: 15pt;"> Absen Siang </button</a>
                                </div>

                            </div>
                            <hr>
                            <div class="row mt-4 mb-3 justify-content-center">
                                <div class="col-md-3 text-center">
                                    <a href="{{ route('login') }}"><button class="btn btn-sm btn-success">Login Aplikasi</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; Digtive 2020
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- General JS Scripts -->
<script src="{{ asset('/') }}assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="{{ asset('/') }}assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="{{ asset('/') }}assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@if(\Illuminate\Support\Facades\Session::has('alert-absen'))
    <script>
        Swal.fire(
            'Berhasil !',
            'Absen berhasil dilakukan!',
            'success'
        )
    </script>
@endif
@if(\Illuminate\Support\Facades\Session::has('sudah-absen'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Kamu sudah absen sebelumnya !'
        })
    </script>
@endif
</html>
