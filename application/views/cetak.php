

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Lacak Pekerjaan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Zona Kasir" name="description" />
        <meta content="Zona Kasir" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('theme/Vertical/dist'); ?>/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="<?php echo base_url('theme/Vertical/dist'); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url('theme/Vertical/dist'); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url('theme/Vertical/dist'); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

         <!-- Sweet Alert-->
        <link href="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-primary bg-pattern">
       

        <div class="account-pages my-3 pt-sm-3">
            <div class="container">
                <!-- end row -->

                <div class="row justify-content-center">
                        <?php if($data->STATUS==1){ ?>
                            <?php if($data->LUNAS==1){  ?>
                            <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-body border mb-0">
                                    <div class="text-center">
                                        <div class="icons-xl uim-icon-primary my-4">
                                            <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M10.3125,16.09375a.99676.99676,0,0,1-.707-.293L6.793,12.98828A.99989.99989,0,0,1,8.207,11.57422l2.10547,2.10547L15.793,8.19922A.99989.99989,0,0,1,17.207,9.61328l-6.1875,6.1875A.99676.99676,0,0,1,10.3125,16.09375Z" opacity=".99"></path><path class="uim-tertiary" d="M12,2A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm5.207,7.61328-6.1875,6.1875a.99963.99963,0,0,1-1.41406,0L6.793,12.98828A.99989.99989,0,0,1,8.207,11.57422l2.10547,2.10547L15.793,8.19922A.99989.99989,0,0,1,17.207,9.61328Z"></path></svg></span>
                                        </div>
                                        <h4 class="alert-heading font-size-20">Pembayaran Lunas</h4>
                                        <p class="text-muted">Terima kasih</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } 
                        else if($data->LUNAS==0){  ?>
                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-body border mb-0">
                                    <div class="text-center">
                                        <div class="icons-xl uim-icon-warning my-4">
                                            <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-tertiary" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"></path><circle cx="12" cy="17" r="1" class="uim-primary"></circle><path class="uim-primary" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"></path></svg></span>
                                        </div>
                                        <h4 class="alert-heading font-size-20">Pembayaran Belum Lunas</h4>
                                        <p class="text-muted">Silahkan bayar pada saat pengambilan, terima kasih.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                         } else { ?>
                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-body border mb-0">
                                    <div class="text-center">
                                        <div class="icons-xl uim-icon-danger my-4">
                                            <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M13.41406,12l3.293-3.293A.99989.99989,0,0,0,15.293,7.293L12,10.58594,8.707,7.293A.99989.99989,0,0,0,7.293,8.707L10.58594,12,7.293,15.293A.99989.99989,0,0,0,8.707,16.707L12,13.41406l3.293,3.293A.99989.99989,0,0,0,16.707,15.293Z"></path><path class="uim-tertiary" d="M19.0708,4.9292A9.99962,9.99962,0,1,0,4.9292,19.0708,9.99962,9.99962,0,1,0,19.0708,4.9292ZM16.707,15.293A.99989.99989,0,1,1,15.293,16.707L12,13.41406,8.707,16.707A.99989.99989,0,0,1,7.293,15.293L10.58594,12,7.293,8.707A.99989.99989,0,0,1,8.707,7.293L12,10.58594l3.293-3.293A.99989.99989,0,0,1,16.707,8.707L13.41406,12Z"></path></svg></span>
                                        </div>
                                        <h4 class="alert-heading font-size-20">Transaksi Dibatalkan</h4>
                                        <p class="text-muted">Transaksi Dibatalkan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-transparent p-3">
                                <h4 class="header-title mb-0" style="font-size:13pt;font-weight:bold">Lacak Pekerjaan</h4>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="media my-2">
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Nomor Nota</p>
                                            <h5 class="mb-0"><?php echo sprintf("%06d",$data->ID); ?></h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-star"></i>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="media my-2">
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Nama Customer </p>
                                            <h5 class="mb-0">
                                                <?php echo $data->NAMA_CUSTOMER; ?>
                                            </h5>
                                        </div>
                                            <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-airplay"></i>
                                        </div>
                                    </div>
                                </li>
                                
                                <li class="list-group-item">
                                    <div class="media my-2">
                                        
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Estimasi Selesai</p>
                                            <h5 class="mb-0">
                                                <?php echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?>
                                            </h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-calender"></i>
                                        </div>
                                        
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="media my-2">
                                        
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Status Pengerjaan</p>
                                            <h5 class="mb-0">
                                            <?php if($data->STATUS==1){ if($data->STATUS_PENGERJAAN==1) echo "<span style='font-size:12pt' class='badge badge-soft-primary'>Selesai</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($data->SELESAI)."</span>"; elseif($data->STATUS_PENGERJAAN==0)  echo "<span style='font-size:12pt' class='badge badge-soft-danger'>Proses Pengerjaan</span>"; if($data->STATUS_PENGERJAAN==2) echo "<span style='font-size:12pt' class='badge badge-soft-success'>Diambil</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($data->AMBIL)."</span>"; } else { echo "<span style='font-size:10pt' class='badge badge-danger'>Dibatalkan</span>"; }  ?>
                                            </h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-horizontal-align-left"></i>
                                        </div>
                                        
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="media my-2">
                                        
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Jenis Pembayaran</p>
                                            <h5 class="mb-0">
                                                <?php echo ($data->JENIS_BAYAR); ?>
                                            </h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-comment-alt-message"></i>
                                        </div>
                                        
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="media my-2">
                                        
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Metode Pembayaran</p>
                                            <h5 class="mb-0">
                                                <?php  if($data->ID_METODE_BAYAR==1) echo "Full Payment"; else echo "Down Payment"; ?>
                                            </h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-window-grid"></i>
                                        </div>
                                        
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="media my-2">
                                        
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Total Tagihan</p>
                                            <h5 class="mb-0">
                                                <?php $hd=$data->TOTAL-$data->DISKON; echo formatRupiah($hd);  ?>
                                            </h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-flip-v-alt"></i>
                                        </div>
                                        
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="media my-2">
                                        
                                        <div class="media-body">
                                            <p class="text-muted mb-2">Total Bayar</p>
                                            <h5 class="mb-0">
                                                <?php echo formatRupiah($data->BAYAR);  ?>
                                            </h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-window-maximize"></i>
                                        </div>
                                        
                                    </div>
                                </li>
                                <?php if($data->ID_METODE_BAYAR==1){ $kata="Kembalian"; } else { $kata="Kurang Bayar"; }  ?>
                                <li class="list-group-item">
                                    <div class="media my-2">
                                        
                                        <div class="media-body">
                                            <p class="text-muted mb-2"><?php echo $kata; ?></p>
                                            <h5 class="mb-0">
                                                <?php $ha = $hd-$data->BAYAR; echo formatRupiah(abs($ha));  ?>
                                            </h5>
                                        </div>
                                        <div class="icons-lg ml-2 align-self-center">
                                            <i class="uim uim-exclamation-octagon"></i>
                                        </div>
                                        
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url('theme/Vertical/dist'); ?>/assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url('theme/Vertical/dist'); ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url('theme/Vertical/dist'); ?>/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url('theme/Vertical/dist'); ?>/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url('theme/Vertical/dist'); ?>/assets/libs/node-waves/waves.min.js"></script>

        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        <script src="<?php echo base_url('theme/Vertical/dist'); ?>/assets/js/app.js"></script>
         <!-- Sweet Alerts js -->
        <script src="<?php echo base_url(); ?>theme/Vertical/dist/assets/libs/sweetalert2/sweetalert2.min.js"></script>

    </body>
</html>

