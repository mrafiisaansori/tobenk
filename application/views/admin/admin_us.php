<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <?php $identitas = $this->db->get("m_identitas")->row(); ?>

    <title>Administrator</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Point Of Sales" name="description" />

    <meta content="" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="<?php echo base_url() ?>upload/logo/logo.png">



    <!-- DataTables -->
    <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


    <!-- datepicker -->

    <link href="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/air-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />



    <!-- jvectormap -->

    <link href="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />



    <!-- Bootstrap Css -->

    <link href="<?php echo base_url() ?>theme/Vertical/dist/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->

    <link href="<?php echo base_url() ?>theme/Vertical/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App Css-->

    <link href="<?php echo base_url() ?>theme/Vertical/dist/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>theme/select2.min.css">
    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/jquery/jquery.min.js"></script>

    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/metismenu/metisMenu.min.js"></script>

    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/simplebar/simplebar.min.js"></script>

    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/node-waves/waves.min.js"></script>


    <script src="<?php echo site_url('theme/jquery.maskMoney.js'); ?>" type="text/javascript"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>


    <script src="<?php echo base_url() ?>theme/select2.min.js"></script>

    <!-- datepicker -->

    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/air-datepicker/js/datepicker.min.js"></script>

    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/air-datepicker/js/i18n/datepicker.en.js"></script>




    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/jquery-knob/jquery.knob.min.js"></script>

    <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Jq vector map -->

    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/jqvmap/jquery.vmap.min.js"></script>

    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>
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
    <!-- Responsive Table css -->
    <link href="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/RWD-Table-Patterns/css/rwd-table.min.css" rel="stylesheet" type="text/css" />

    <style>
        .datepicker {
            z-index: 9999 !important;
        }
    </style>
</head>



<body data-topbar="colored">



    <!-- Begin page -->

    <div id="layout-wrapper">



        <header id="page-topbar">

            <div class="navbar-header">

                <div class="d-flex">

                    <!-- LOGO -->

                    <div class="navbar-brand-box">

                        <a href="" class="logo logo-dark">

                            <span class="logo-sm">

                                <img src="<?php echo base_url() ?>upload/logo/logo.png" alt="" height="40">

                            </span>

                            <span class="logo-lg">

                                <img src="<?php echo base_url() ?>upload/logo/logo-dark.png" alt="" height="45">

                            </span>

                        </a>



                        <a href="" class="logo logo-light">

                            <span class="logo-sm">

                                <img src="<?php echo base_url() ?>theme/Vertical/dist/assets/images/logo-sm-light.png" alt="" height="22">

                            </span>

                            <span class="logo-lg">

                                <img src="<?php echo base_url() ?>theme/Vertical/dist/assets/images/logo-light.png" alt="" height="20">

                            </span>

                        </a>

                    </div>



                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">

                        <i class="mdi mdi-backburger"></i>

                    </button>



                    <!-- App Search-->



                </div>



                <div class="d-flex">



                    <div class="dropdown d-inline-block d-lg-none ml-2">

                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <i class="mdi mdi-magnify"></i>

                        </button>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">



                            <form class="p-3">

                                <div class="form-group m-0">

                                    <div class="input-group">

                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">

                                        <div class="input-group-append">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>







                    <div class="dropdown d-inline-block">

                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <img class="rounded-circle header-profile-user" src="<?php echo base_url() ?>theme/Vertical/dist/assets/images/users/avatar-1.jpg" alt="Header Avatar">

                            <span class="d-none d-sm-inline-block ml-1"><?php echo strtolower($this->session->userdata('nama_admin')); ?></span>

                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>

                        </button>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?php echo site_url('admin/ubah-password.html'); ?>"><i class="mdi mdi-home font-size-16 align-middle mr-1"></i> Ubah Password</a>


                            <a class="dropdown-item" href="<?php echo site_url('logout'); ?>"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>

                        </div>

                    </div>



                </div>

            </div>



        </header>



        <!-- ========== Left Sidebar Start ========== -->

        <div class="vertical-menu">



            <div data-simplebar class="h-100">



                <!--- Sidemenu -->

                <div id="sidebar-menu">

                    <!-- Left Menu Start -->

                    <ul class="metismenu list-unstyled" id="side-menu">

                        <li class="menu-title">Master</li>



                        <li>

                            <a href="<?php echo site_url('admin'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'dashboard') {
                                                                                                echo "active";
                                                                                            } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Dashboard</span>

                            </a>

                        </li>

                        <!-- <li>

                                <a href="<?php //echo site_url('admin/identitas.html'); 
                                            ?>" class="waves-effect <?php //if($this->session->userdata('menu') == 'identitas'){ echo "active";}
                                                                                                                ?>">

                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                    <span>Identitas</span>

                                </a>

                            </li> -->

                        <li>

                            <a href="<?php echo site_url('admin/pengguna.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'pengguna') {
                                                                                                                echo "active";
                                                                                                            } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Pengguna</span>

                            </a>

                        </li>


                        <li>

                            <a href="<?php echo site_url('admin/kategori.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'kategori') {
                                                                                                                echo "active";
                                                                                                            } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Kategori</span>

                            </a>

                        </li>

                        <li>

                            <a href="<?php echo site_url('admin/produk.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'produk') {
                                                                                                            echo "active";
                                                                                                        } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Produk</span>

                            </a>

                        </li>

                        <li>

                            <a href="<?php echo site_url('admin/supplier.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'supplier') {
                                                                                                                echo "active";
                                                                                                            } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Supplier</span>

                            </a>

                        </li>

                        <!--<li>

                                <a href="<?php //echo site_url('admin/jenis-bayar.html'); 
                                            ?>" class="waves-effect <?php //if($this->session->userdata('menu') == 'jenis-bayar'){ echo "active";}
                                                                                                                    ?>">

                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                    <span>Jenis Bayar</span>

                                </a>

                            </li>-->


                        <li class="menu-title">Transaksi</li>

                        <li>

                            <a href="<?php echo site_url('admin/pembelian.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'pembelian') {
                                                                                                                echo "active";
                                                                                                            } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Pembelian</span>

                            </a>

                        </li>
                        <li>

                            <a href="<?php echo site_url('admin/retur.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'retur') {
                                                                                                            echo "active";
                                                                                                        } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Retur</span>

                            </a>

                        </li>
                        <li>

                                <a href="<?php echo site_url('admin/perubahan.html'); 
                                            ?>" class="waves-effect <?php if($this->session->userdata('menu') == 'perubahan'){ echo "active";}
                                                                                                                            ?>">

                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                    <span>Perubahan Transaksi</span>

                                </a>

                            </li>

                        <li class="menu-title">Laporan</li>

                        <li>

                            <a href="<?php echo site_url('admin/laporan-penjualan.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'laporan-penjualan') {
                                                                                                                        echo "active";
                                                                                                                    } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Penjualan</span>

                            </a>

                        </li>
                        <li>

                            <a href="<?php echo site_url('admin/laporan-penjualan-hapus.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'laporan-penjualan-hapus') {
                                                                                                                            echo "active";
                                                                                                                        } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Batal Penjualan</span>

                            </a>

                        </li>
                        <li>

                            <a href="<?php echo site_url('admin/customer.html'); ?>" class="waves-effect <?php if ($this->session->userdata('menu') == 'customer') {
                                                                                                                echo "active";
                                                                                                            } ?>">

                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                <span>Customer</span>

                            </a>

                        </li>

                        <!--<li>

                                <a href="<?php //echo site_url('admin/laporan-penyusutan.html'); 
                                            ?>" class="waves-effect <?php //if($this->session->userdata('menu') == 'laporan-penyusutan'){ echo "active";}
                                                                                                                            ?>">

                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                    <span>Laporan Penyusutan</span>

                                </a>

                            </li>-->

                        <!-- <li>

                                <a href="<?php //echo site_url('admin/laporan-pendapatan.html'); 
                                            ?>" class="waves-effect <? php // if($this->session->userdata('menu') == 'laporan-pendapatan'){ echo "active";}
                                                                                                                            ?>">

                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                    <span>Laporan Pendapatan</span>

                                </a>

                            </li> -->
                        <!--<li>

                                <a href="<?php //echo site_url('admin/laporan-stok.html'); 
                                            ?>" class="waves-effect <?php //if($this->session->userdata('menu') == 'laporan-stok'){ echo "active";}
                                                                                                                    ?>">

                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                    <span>Laporan Stok</span>

                                </a>

                            </li>  -->
                        <!--<li>

                                <a href="<?php //echo site_url('admin/laporan-keuangan.html'); 
                                            ?>" class="waves-effect <?php //if($this->session->userdata('menu') == 'laporans'){ echo "active";}
                                                                                                                        ?>">

                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>

                                    <span>Laporan Keuangan</span>

                                </a>

                            </li>-->




                    </ul>



                </div>

                <!-- Sidebar -->

            </div>

        </div>

        <!-- Left Sidebar End -->



        <!-- ============================================================== -->

        <!-- Start right Content here -->

        <!-- ============================================================== -->

        <div class="main-content">



            <div class="page-content">



                <!-- Page-Title -->

                <?php $this->load->view($page); ?>

                <!-- end page-content-wrapper -->

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






    <script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/libs/RWD-Table-Patterns/js/rwd-table.min.js"></script>
    <script src="<?php echo base_url() ?>theme/Vertical/dist/assets/js/app.js"></script>

    <script type="text/javascript">
        <?php
        if ($this->session->flashdata('status')) {
        ?>
            Swal.fire(
                '<?php echo $this->session->flashdata('judul'); ?>',
                '<?php echo $this->session->flashdata('status'); ?>',
                '<?php echo $this->session->flashdata('type'); ?>'
            )
        <?php
        }
        ?>
        $(document).ready(function() {
            $(".datepicker2").datepicker({
                dateFormat: "yyyy-mm-dd",
            });

            $(".select2-input").select2();

            $(".only-num").on("keypress keyup blur", function(event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
        });
    </script>


</body>

</html>