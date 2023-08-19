<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <?php $identitas = $this->db->get("m_identitas")->row(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Zona Kasir, Aplikasi Kasir Murah, Point Of Sales, Aplikasi Toko Berbasis Website Murah" name="description" />
        <meta content="Zona Kasir" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>upload/logo/logo.png">

        <!-- Sweet Alert-->
        <link href="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="<?php echo base_url(); ?>theme/Vertical/dist/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url(); ?>theme/Vertical/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url(); ?>theme/Vertical/dist/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-primary bg-pattern">
        <!-- <div class="home-btn d-none d-sm-block">
            <a href=""><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div> -->

        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <a href="" class="logo"><img src="<?php echo base_url(); ?>upload/logo/logo-light.png" height="80" alt="logo"></a>
                            <h5 class="font-size-16 text-white-50 mb-4"></h5>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-xl-5 col-sm-8">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="p-2">
                                    <h5 class="mb-5 text-center"><?php echo $identitas->NAMA; ?></h5>
                                    <form class="form-horizontal" action="<?php echo site_url('login/login') ?>" method="post">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="text" class="form-control" id="username" name="username" required>
                                                    <label for="username">User Name</label>
                                                </div>

                                                <div class="form-group form-group-custom mb-4">
                                                    <input type="password" class="form-control" id="userpassword" name="password" required>
                                                    <label for="userpassword">Password</label>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="text-md-right mt-3 mt-md-0">
                                                            <a href="javascript:void(0)" onclick="lupa()" class="text-muted"><i class="mdi mdi-lock"></i> Lupa Password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                                <div class="mt-4 text-center">
                                                    <a href="" class="text-muted"> © 2023 | <?php echo $identitas->NAMA; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/node-waves/waves.min.js"></script>

        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/js/app.js"></script>

        <!-- Sweet Alerts js -->
        <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <script type="text/javascript">
            function lupa()
            {
                Swal.fire(
                  'Anda Lupa Password?',
                  'Silahkan hubungi administrator.',
                  'info'
                )
            }
            <?php
            if($this->session->flashdata('wrong'))
            {
                ?>
                Swal.fire(
                  'Terjadi Kesalahan',
                  'Username atau password tidak sesuai.',
                  'error'
                )
                <?php
            }
            ?>
        </script>
    </body>
</html>
