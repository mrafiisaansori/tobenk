<style>
</style>
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Detail Histori Kerjaan</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Detail Histori Kerjaan</li>
                </ol>
            </div>
            <div class="col-md-4">
                <a href="<?= base_url('produksi/historiKerjaan') ?>" class="btn btn-warning" style="float:right;">Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php
                if ($data->STATUS == 1) {
                    if ($data->LUNAS == 1) { ?>
                        <div class="alert alert-primary" role="alert">
                            Pembayaran Lunas &nbsp; <i class="mdi mdi-progress-check" style="font-size:12pt"></i>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Pembayaran Belum Lunas &nbsp; <i class="mdi mdi-pause-circle" style="font-size:12pt"></i>
                        </div>
                    <?php }
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Transaksi Dibatalkan &nbsp; <i class="mdi mdi-trash-o" style="font-size:12pt"></i>
                    </div>
                <?php
                }
                ?>
                <div class="row">
                    <div class="col-xl-4">
                        <table class="table table-bordered" style="font-size:12pt">
                            <tbody>
                                <tr style="background-color:#f8f9fa;font-size:10pt;font-weight:bold;">
                                    <td><i class="fas fa-user-friends mr-1"></i> Customer</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><?php echo $data->NAMA_CUSTOMER ?></b><br>
                                        <span style="font-size:10pt"><?php echo $data->ALAMAT ?><br>
                                            <?php echo $data->NO_TELP ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered" style="font-size:12pt">
                            <tbody>
                                <tr style="background-color:#f8f9fa;font-size:10pt;font-weight:bold;">
                                    <td><i class="fas fa-file-alt mr-1"></i> Transaksi</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b><?php echo sprintf("%06d", $data->ID); ?></b><br>
                                        <span style="font-size:10pt">
                                            Transaksi <?php echo tgl_indo_lengkap($data->TANGGAL); ?><br>
                                            Estimasi Selesai <?php echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?><br>
                                            Resep <?php echo ($data->RESEP); ?><br>
                                            Pembayaran <?php echo ($data->JENIS_BAYAR); ?><br>
                                            Metode <?php if ($data->ID_METODE_BAYAR == 1) echo "Full Payment";
                                                    else echo "Down Payment"; ?><br>
                                            <?php if ($data->STATUS == 1) {
                                                if ($data->STATUS_PENGERJAAN == 0) echo "<span class='badge badge-secondary' style='font-size:10pt;'>Diproses</span>";
                                                else if ($data->STATUS_PENGERJAAN == 1) echo "<span class='badge badge-warning' style='font-size:10pt;'>Desain Diupload</span>";
                                                else if ($data->STATUS_PENGERJAAN == 2) echo "<span class='badge badge-danger' style='font-size:10pt;'>Revisi Desain</span>";
                                                else if ($data->STATUS_PENGERJAAN == 3) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Desain</span>";
                                                else if ($data->STATUS_PENGERJAAN == 4) echo "<span class='badge badge-info' style='font-size:10pt;'>Selesai Produksi</span>";
                                                else if ($data->STATUS_PENGERJAAN == 5) echo "<span class='badge badge-dark' style='font-size:10pt;'>Diambil</span>";
                                            } else {
                                                echo "Dibatalkan";
                                            }  ?><br>
                                            File Mentah <?php if ($data->FILE_MENTAH) {
                                                            echo "<a target='_blank' href='" . $data->FILE_MENTAH . "'>" . ($data->FILE_MENTAH) . "</a>";
                                                        } else {
                                                            echo "-";
                                                        } ?><br>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xl-8">
                        <table class="table table-bordered" style="font-size:12pt">
                            <tbody>
                                <tr style="background-color:#f8f9fa;font-size:10pt;font-weight:bold;">
                                    <td><i class="fas fa-file-alt mr-1"></i> Mockup</td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <img height="150px" src="<?php echo site_url('upload/mockup/' . $data->MOCKUP); ?>" alt="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered" style="font-size:10pt">
                            <tr style="background-color:#f8f9fa">
                                <td style="font-weight:bold;" align="center">Produk</td>
                                <td style="font-weight:bold;" align="center">Qty</td>
                            </tr>
                            <?php
                            $tot = 0;
                            $tot_beli = 0;
                            $laba = 0;
                            if ($produk->num_rows() > 0) {
                                foreach ($produk->result() as $dat) {
                            ?>
                                    <tr>
                                        <td><B><?php echo $dat->NAMA_PRODUK; ?> (<?php echo $dat->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $dat->KETERANGAN; ?></span></td>
                                        <td align="center"><?php echo $dat->QTY; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">
    $("#form-beli").submit(function(e) {
        $("#loading").show();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data) {
                $("#laporan").html(data);
                $("#loading").hide();
            },
            error: function(data) {
                Swal.fire(
                    'Terjadi Kesalahan',
                    'Periksa kembali koneksi anda',
                    'error'
                )
            }
        });
        return false;
    });
    $("#bayar").maskMoney();

    function hapus(id) {
        if (confirm("Anda yakin menghapus transaksi ini?")) {
            $("#loading").show();
            $.ajax({
                url: "<?php echo site_url('kasir/delete_transaksi'); ?>",
                type: "POST",
                data: "id=" + id,
                success: function(result) {
                    if (result == "1") {
                        Swal.fire(
                            'Berhasil',
                            'Transkasi Telah Dibatalkan',
                            'success'
                        );
                    } else if (result == "0") {
                        Swal.fire(
                            'Gagal',
                            'Transkasi Gagal Dibatalkan',
                            'error'
                        );
                    }
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 5000);

                }
            });
        }
    }
</script>