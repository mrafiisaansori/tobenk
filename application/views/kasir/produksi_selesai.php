<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Produksi Selesai</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">List Kerjaan</li>
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
                                    <th>Deadline</th>
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
                                            <td>TO-<?php echo sprintf("%06d", $key->ID); ?></td>
                                            <td><?php if ($key->ID_CUSTOMER) echo "<b>" . ($key->NAMA_CUSTOMER) . "</b><br><span>" . $key->ALAMAT . "<br>" . $key->NO_TELP . "</span>";
                                                else echo "<b>Tidak Terdaftar</b>"; ?></td>
                                            <td><?php echo "<b>" . tgl_indo_lengkap($key->TANGGAL) . "</b><br><span>" . $key->JAM . "</span>"; ?></td>
                                            <td><?php echo "<b>" . tgl_indo_lengkap($key->ESTIMASI_SELESAI); ?></td>
                                            <td>
                                                <?php
                                                if ($key->STATUS_PENGERJAAN == 0) echo "<span class='badge badge-secondary' style='font-size:10pt;'>Diproses</span>";
                                                else if ($key->STATUS_PENGERJAAN == 1) echo "<span class='badge badge-warning' style='font-size:10pt;'>Desain Diupload</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($key->SP_1)."</span>";
                                                else if ($key->STATUS_PENGERJAAN == 2) echo "<span class='badge badge-danger' style='font-size:10pt;'>Revisi Desain</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($key->SP_2)."</span>";
                                                else if ($key->STATUS_PENGERJAAN == 3) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Desain</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($key->SP_3)."</span>";
                                                else if ($key->STATUS_PENGERJAAN == 4) echo "<span class='badge badge-info' style='font-size:10pt;'>Selesai Produksi</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($key->SP_4)."</span>";
                                                else if ($key->STATUS_PENGERJAAN == 5) echo "<span class='badge badge-dark' style='font-size:10pt;'>Diambil</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($key->SP_5)."</span>";
                                                ?>
                                            </td>
                                            <td>
                                            <a target="_blank" href="<?php echo site_url('kasir/detail/'.base64_encode_fix($key->ID)); ?>" class="btn btn-primary mr-1"><i class="mdi mdi-eye"></i></a>
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
</script>