<style>
</style>
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Detail Kerjaan</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Detail Kerjaan</li>
                </ol>
            </div>
            <div class="col-md-4">
            <a href="<?= base_url('desainer/list') ?>" class="btn btn-warning mr-1" style="float:right;"><i class="mdi mdi-chevron-triple-left mr-1"></i> Kembali</a>
			<a target="_blank" href="<?php echo site_url('desainer/cetak/'.base64_encode_fix($data->ID).'/'.base64_encode_fix($data->BAYAR)); ?>" class="btn btn-info mr-1" style="float:right;"><i class="mdi mdi-printer mr-1"></i> Cetak</a>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <?php
        if ($data->STATUS == 1) {
            if ($data->LUNAS == 1) { ?>
                <div class="alert alert-primary" role="alert">
                    <i class="fas fa-check" style="font-size:12pt"></i> Pembayaran Lunas
                </div>
            <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-atlas" style="font-size:12pt"></i> Pembayaran Belum Lunas
                </div>
            <?php }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                <i class="mdi mdi-trash-o" style="font-size:12pt"></i> Transaksi Dibatalkan
            </div>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-xl-5">
                <div class="card">
                    <h6 class="card-header bg-transparent border-bottom mt-0"><b>History Transaksi</b></h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <table class="table table-bordered" style="font-size:10pt">
                                    <tbody>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>No Nota</b></th>
                                            <th style=""><?php echo sprintf("%06d", $data->ID); ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>Nama</b></th>
                                            <th style=""><?php echo $data->NAMA_CUSTOMER ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>Alamat</b></th>
                                            <th style=""><?php echo $data->ALAMAT ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>No Telp</b></th>
                                            <th style=""><?php echo $data->NO_TELP ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>Tanggal Transaksi</b></th>
                                            <th><?php echo tgl_indo_lengkap($data->TANGGAL) . " (" . $data->JAM . ")"; ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>Tanggal Deadline</b></th>
                                            <th><?php echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>Jenis Bayar</b></th>
                                            <th><?php echo $data->JENIS_BAYAR ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>Metode Bayar</b></th>
                                            <th><?php if ($data->ID_METODE_BAYAR == 1) echo "Full Payment";
                                                else echo "Down Payment"; ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>Status Pengerjaan</b></th>
                                            <th><?php if ($data->STATUS == 1) {
                                                    if ($data->STATUS_PENGERJAAN == 0) echo "<span class='badge badge-secondary' style='font-size:10pt;'>Diproses</span>";
                                                    else if ($data->STATUS_PENGERJAAN == 1) echo "<span class='badge badge-warning' style='font-size:10pt;'>Desain Diupload</span>";
                                                    else if ($data->STATUS_PENGERJAAN == 2) echo "<span class='badge badge-danger' style='font-size:10pt;'>Revisi Desain</span>";
                                                    else if ($data->STATUS_PENGERJAAN == 3) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Desain</span>";
                                                    else if ($data->STATUS_PENGERJAAN == 4) echo "<span class='badge badge-info' style='font-size:10pt;'>Selesai Produksi</span>";
                                                    else if ($data->STATUS_PENGERJAAN == 5) echo "<span class='badge badge-dark' style='font-size:10pt;'>Diambil</span>";
                                                } else {
                                                    echo "<span style='font-size:10pt' class='badge badge-soft-secondary'>Dibatalkan</span>";
                                                }  ?></th>
                                        </tr>
                                        <tr>
                                            <th style="background-color:#f8f9fa"><b>Keterangan</b></th>
                                            <th><?php echo $data->KETERANGAN ?></th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h6 class="card-header bg-transparent border-bottom mt-0"><b>Produk</b></h6>
                            <div class="card-body">
                                <table class="table table-bordered" style="font-size:10pt">
                                    <tr style="background-color:#f8f9fa">
                                        <td style="font-weight:bold;" align="center">Produk</td>
                                        <td style="font-weight:bold;" align="center">Qty</td>
                                    </tr>
                                    <?php
                                    $tot = 0;
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

                    <div class="col-md-12">
                        <div class="card">
                            <h6 class="card-header bg-transparent border-bottom mt-0"><b>Desain</b></h6>
                            <div class="card-body">
                                <form action="<?= base_url('desainer/uploadDesain/' . base64_encode_fix($data->ID)) ?>" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered" style="font-size:10pt">
                                        <tbody>
                                            <tr>
                                                <th width="30%" style="background-color:#f8f9fa"><b>File Dari Customer</b></th>
                                                <th>
                                                <?php if($data->FILE_CUSTOMER){ echo "<a target='_blank' href=".site_url('upload/file_customer/'.$data->FILE_CUSTOMER).">".$data->FILE_CUSTOMER."</a>"; } else echo "-"; ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="30%" style="background-color:#f8f9fa"><b>File Mentah</b></th>
                                                <th>
                                                    <?php if ($data->STATUS_PENGERJAAN < 3){ ?>
                                                    <input type="text" class="form-control" name="file_mentah" value="<?= $data->FILE_MENTAH ?>">
                                                    <?php }
                                                    else
                                                    {
                                                        echo $data->FILE_MENTAH;
                                                    } ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="background-color:#f8f9fa"><b>Mockup</b></th>
                                                <th style="">
                                                    <?php if ($data->STATUS_PENGERJAAN < 3){ ?>
                                                    <input type="file" name="mockup" accept="image/*">
                                                    <?php } else { echo $data->MOCKUP; } ?>
                                                    <?php
                                                    if (file_exists('./upload/mockup/' . $data->MOCKUP) && $data->MOCKUP != null) {
                                                        echo "<a style='float:right;' href='" . base_url() . "upload/mockup/" . $data->MOCKUP . "' target='_blank' class='btn btn-sm btn-primary'>Lihat</a>";
                                                    }
                                                    ?>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php if ($data->STATUS_PENGERJAAN < 3) { ?>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
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