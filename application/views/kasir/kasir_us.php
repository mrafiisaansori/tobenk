<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Cashier</title>
        <?php $identitas = $this->db->get("m_identitas")->row(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url()?>upload/logo/logo.png">

       <!-- Selectize -->
       <link href="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/selectize/css/selectize.css" rel="stylesheet" type="text/css" />

          <!-- Sweet Alert-->
        <link href="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <!-- datepicker -->
        <link href="<?php echo base_url()?>theme/Vertical/dist/assets/libs/air-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css" />

        <!-- jvectormap -->
        <link href="<?php echo base_url()?>theme/Vertical/dist/assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

         <!-- DataTables -->
        <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     


        <!-- Bootstrap Css -->
        <link href="<?php echo base_url()?>theme/Vertical/dist/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url()?>theme/Vertical/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url()?>theme/Vertical/dist/assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/jquery/jquery.min.js"></script>

         <script src="<?php echo site_url('theme/jquery.maskMoney.js'); ?>" type="text/javascript"></script>

         <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

  <!-- Sweet Alerts js -->
  <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/sweetalert2/sweetalert2.min.js"></script>

         
    </head>

    <body data-topbar="colored" data-layout="horizontal" data-layout-size="boxed">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="container-fluid">
                        <div class="float-right">
                            <div class="dropdown d-inline-block ml-2">
                                <img src="<?php echo site_url('theme/loading-2.gif'); ?>" width="30px" id="loading" style="display:none;">
                            </div>
                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user" src="<?php echo base_url()?>theme/Vertical/dist/assets/images/users/avatar-1.jpg" alt="Header Avatar">
                                    <span class="d-none d-sm-inline-block ml-1"><?php echo $this->session->userdata("nama_kasir"); ?></span>
                                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a class="dropdown-item" href="<?php echo site_url('kasir/password'); ?>"><i class="mdi mdi-home font-size-16 align-middle mr-1"></i> Ubah Password</a>
                                    <a class="dropdown-item" href="<?php echo site_url('kasir/logout'); ?>"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>
                                </div>
                            </div>
                        </div>

                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url()?>upload/logo/logo-white.png" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url()?>upload/logo/logo-light.png" alt="" height="40">
                                </span>
                            </a>

                            <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?php echo base_url()?>upload/logo/logo-white.png" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo base_url()?>upload/logo/logo-light.png" alt="" height="40">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <div class="topnav">
                            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                                <div class="collapse navbar-collapse" id="topnav-menu-content">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('kasir'); ?>">
                                                Beranda
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('transaksi-full.html'); ?>">
                                                Transaksi
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('kasir/desain_selesai'); ?>">
                                                Desain Selesai
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('kasir/produksi_selesai'); ?>">
                                                Produksi Selesai
                                            </a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Laporan <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-components">
                                                <div class="dropdown">  
                                                    <a href="<?php echo site_url('kasir/laporan'); ?>" class="dropdown-item">
                                                        <div class="d-inline-block icons-sm mr-2"><i class="uim uim-schedule"></i></div> Transaksi
                                                    </a>
                                                    <a href="<?php echo site_url('kasir/laporan_batal'); ?>" class="dropdown-item">
                                                        <div class="d-inline-block icons-sm mr-2"><i class="uim uim-exclamation-triangle"></i></div> Pembatalan Transaksi
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('kasir/customer'); ?>">
                                                Customer
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('kasir/stok'); ?>">
                                                Stok
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

    
            </header>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    
                    <?php $this->load->view($page);?>

                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                            Copyright © 2023
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                <?php echo $identitas->NAMA; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
    
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom rightbar-nav-tab nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-3 active" data-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text font-size-22"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3" data-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox font-size-22"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3" data-toggle="tab" href="#settings-tab" role="tab">
                            <i class="mdi mdi-settings font-size-22"></i>
                        </a>
                    </li>
                </ul>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        
        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/node-waves/waves.min.js"></script>

        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        <!-- datepicker -->
        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/air-datepicker/js/datepicker.min.js"></script>
        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/air-datepicker/js/i18n/datepicker.en.js"></script>

        <!-- Jq vector map -->
        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>

        <script src="<?php echo base_url()?>theme/Vertical/dist/assets/js/app.js"></script>

<!-- Required datatable js -->
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/jszip/jszip.min.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        
        <!-- Datatable init js -->
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/js/pages/datatables.init.js"></script>
        <!-- Selectize -->
        <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        
        <script type="text/javascript">
            <?php
            if($this->session->flashdata('status'))
            {
                ?>
                Swal.fire(
                  '<?php echo $this->session->flashdata('judul'); ?>',
                  '<?php echo $this->session->flashdata('pesan'); ?>',
                  '<?php echo $this->session->flashdata('type'); ?>'
                )
                <?php
            }
            ?>
         $('.filterme').keypress(function(eve) {
            if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46) ) {
                eve.preventDefault();
            }
                
            // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
            $('.filterme').keyup(function(eve) {
            if($(this).val().indexOf('.') == 0) {    $(this).val($(this).val().substring(1));
            }
            });
            });
                $(document).ready(function(){
                        $(".datepicker2").datepicker({
                            dateFormat: "yyyy-mm-dd",
                        });
                        $(".selectize").selectize();
                    });
        </script>
    </body>
</html>
