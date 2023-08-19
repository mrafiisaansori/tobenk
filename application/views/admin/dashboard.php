
<div class="page-title-box"> 
    <div class="container-fluid">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h4 class="page-title mb-1">Dashboard</h4>

                <ol class="breadcrumb m-0">

                <li class="breadcrumb-item active"></li>

                </ol>

            </div>


        </div>

    </div>

</div>

                    <!-- end page title end breadcrumb -->



<div class="page-content-wrapper">

    <div class="container-fluid">

        <div class="row">

            <div class="col-xl-6">

                <div class="card">

                    <div class="card-body">

                    <div class="row">

                            <div class="col-6">

                                <h5>Halo <?php echo strtolower($this->session->userdata('nama_admin')); ?>!</h5>

                                <p class="text-muted">Demi keamanan ,<B>Pastikan logout setelah menggunakan aplikasi ini..</B></p>



                                <div class="mt-4">

                                    <a href="#" class="btn btn-primary btn-sm">Online<i class="mdi mdi-arrow-right ml-1"></i></a>

                                </div>

                            </div>



                            <div class="col-5 ml-auto">

                                <div>

                                    <img src="<?php echo base_url()?>theme/Vertical/dist/assets/images/widget-img.png" alt="" class="img-fluid">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

               

            </div>
            <div class="col-lg-6">
                                    <div class="card">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="media my-2">
                                                    
                                                    <div class="media-body">
                                                        <p class="text-muted mb-2">Tanggal</p>
                                                        <h5 class="mb-0"><?php echo tgl_indo_lengkap(date("Y-m-d")); ?></h5>
                                                    </div>
                                                    <div class="icons-lg ml-2 align-self-center">
                                                        <i class="uim uim-layer-group"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="media my-2">
                                                    <div class="media-body">
                                                        <p class="text-muted mb-2">Pemasukan</p>
                                                        <h5 class="mb-0">
                                                        <?php
                                                        $tgl=date('Y-m-d'); ?>
                                                        <?php $penjualan = $this->db->query("SELECT * FROM t_penjualan WHERE TANGGAL='$tgl' AND `STATUS`=1");
                                                        $total=0;
                                                        if($penjualan->num_rows()>0)
                                                        {
                                                            foreach ($penjualan->result() as $key) 
                                                            {
                                                                $total+=$key->BAYAR;
                                                            }
                                                        }
                                                        echo formatRupiah($total);
                                                        ?>
                                                        </h5>
                                                    </div>
                                                    <div class="icons-lg ml-2 align-self-center">
                                                        <i class="uim uim-analytics"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="media my-2">
                                                    <div class="media-body">
                                                        <p class="text-muted mb-2">Barang Terjual</p>
                                                        <h5 class="mb-0"><?php echo $penjualan->num_rows(); ?></h5>
                                                    </div>
                                                    <div class="icons-lg ml-2 align-self-center">
                                                        <i class="uim uim-box"></i>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>





        </div>

        <!-- end row -->





    </div> <!-- container-fluid -->

</div>