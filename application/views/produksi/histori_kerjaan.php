<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Histori Kerjaan</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Histori Kerjaan</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                    <img src="<?php echo site_url('theme/loader.gif'); ?>" width="50px" style="display: none;" id="loading">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:9pt">
                            <thead>
                                <tr style="font-size:11pt!important">
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Tanggal</th>
                                    <th>Estimasi Selesai</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $jumlah = 0;
                                $diskon = 0;
                                $pendapatan = 0;
                                $terbayar = 0;
                                $laba_total = 0;
                                $belum_bayar = 0;
                                if ($data) {
                                    foreach ($data as $key) {
                                        $jumlah++;
                                ?>
                                        <tr>
                                            <td><?php echo sprintf("%06d", $key->ID); ?></td>
                                            <td><?php if ($key->ID_CUSTOMER) echo "<b>" . ($key->NAMA_CUSTOMER) . "</b><br><span>" . $key->ALAMAT . "<br>" . $key->NO_TELP . "</span>";
                                                else echo "<b>Tidak Terdaftar</b>"; ?></td>
                                            <td><?php echo "<b>" . tgl_indo_lengkap($key->TANGGAL) . "</b><br><span>" . $key->JAM . "</span>"; ?></td>
                                            <td><?php echo "<b>" . tgl_indo_lengkap($key->ESTIMASI_SELESAI); ?></td>
                                            <td>
                                                <?php
                                                if ($key->STATUS_PENGERJAAN == 0) echo "<span class='badge badge-secondary' style='font-size:10pt;'>Diproses</span>";
                                                else if ($key->STATUS_PENGERJAAN == 1) echo "<span class='badge badge-warning' style='font-size:10pt;'>Desain Diupload</span>";
                                                else if ($key->STATUS_PENGERJAAN == 2) echo "<span class='badge badge-danger' style='font-size:10pt;'>Revisi Desain</span>";
                                                else if ($key->STATUS_PENGERJAAN == 3) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Desain</span>";
                                                else if ($key->STATUS_PENGERJAAN == 4) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Produksi</span>";
                                                else if ($key->STATUS_PENGERJAAN == 5) echo "<span class='badge badge-success' style='font-size:10pt;'>Diambil</span>";
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('produksi/detailHistoriKerjaan/' . base64_encode_fix($key->ID)); ?>" class="btn btn-primary mr-1"><i class="mdi mdi-eye"></i></a>
                                            </td>

                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#datatable').DataTable({
        responsive: true
    });

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
                    $("#form-beli").submit();
                    $("#loading").hide();
                }
            });
        }
    }
</script>