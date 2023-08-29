<div class="page-title-box">
    <div class="container-fluid">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h4 class="page-title mb-1">Beranda</h4>

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item active">Beranda</li>

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

                            <div class="col-7">

                                <h5>Selamat datang</h5>

                                <p class="text-muted">Demi keamanan bersama <B>Pastikan logout setelah menggunakan aplikasi ini.</B></p>



                                <div class="mt-4">
                                    <a href="<?php echo site_url('transaksi-full.html'); ?>" class="btn btn-primary btn-sm">Transaksi <i class="mdi mdi-arrow-right ml-1"></i></a>

                                </div>

                            </div>



                            <div class="col-5 ml-auto">

                                <div>

                                    <img src="<?php echo base_url() ?>theme/Vertical/dist/assets/images/widget-img.png" alt="" class="img-fluid">

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
                                    <p class="text-muted mb-2">Penjualan Hari Ini</p>
                                    <h5 class="mb-0">
                                        <?php $id_kasir = $this->session->userdata("id_kasir");
                                        $tgl = date('Y-m-d'); ?>
                                        <?php $penjualan = $this->db->query("SELECT * FROM t_penjualan WHERE ID_USER='$id_kasir' AND TANGGAL='$tgl' AND `STATUS`=1");
                                        $total = 0;
                                        if ($penjualan->num_rows() > 0) {
                                            foreach ($penjualan->result() as $key) {
                                                $total += $key->BAYAR;
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
                                    <p class="text-muted mb-2">Barang Terjual Hari Ini</p>
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

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Transaksi</h5>
                        <table class="table" id="tableAjax">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Tanggal</th>
                                    <th>Pembayaran</th>
                                    <th>Diskon</th>
                                    <th width="300">Tagihan</th>
                                    <th width="300">Terbayar</th>
                                    <th>Status Pengerjaan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Pesanan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- end row -->





    </div> <!-- container-fluid -->

</div>

<script>
    $(document).ready(function() {
        $("#tableAjax").dataTable({
            responsive: true,
            "iDisplayLength": 10,
            "responsive": true,
            "aLengthMenu": [10, 25, 50, 100],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo base_url('kasir/getTableTransaksiJson') ?>",
            "sPaginationType": "full_numbers"
        });

    });

    function ubahStatusPesanan(select) {
        const id = $(select).data('id');
        $.ajax({
            type: "post",
            url: "<?= base_url('kasir/ubahStatusPesanan') ?>",
            data: {
                id: id,
                status: $(select).val()
            },
            cache: false,
            success: function() {

            },
            error: function() {
                console.log('error');
            }
        })
    }
</script>