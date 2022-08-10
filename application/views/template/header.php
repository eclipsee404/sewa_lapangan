<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/jquery-ui-1.13.2.custom/jquery-ui.min.css">
    <link href="<?= base_url() ?>assets/select2-4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js">
    </script>
    <script src="<?= base_url() ?>assets/jquery-ui-1.13.2.custom/jquery-ui.min.js">
    </script>
    <script src="<?= base_url() ?>assets/js/swal/node_modules/sweetalert/dist/sweetalert.min.js">
    </script>
    <script src="<?= base_url() ?>assets/select2-4.0.13/dist/js/select2.min.js">
    </script>
    <title>Tayo Futsal</title>
    <style>

    </style>
    <script>
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <img src="<?= base_url() ?>/assets/img/logo/logo.png" class="rounded shadow"
                            style="height:70px !important;" alt="...">
                        <br><br>
                    </div>
                </div>
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <a class="navbar-brand" href="<?= base_url() ?>home">Tayo Futsal</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>lapangan">Lapangan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>jadwal">Jadwal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>customer">Customer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>booking">Booking</a>
                                </li>
                            </ul>
                            <a href="<?= base_url() ?>auth/logout" class="btn btn-outline-success my-2 my-sm-0"
                                type="submit">Logout</a>

                        </div>
                    </nav>
                </div>

            </div>