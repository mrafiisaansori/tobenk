<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Histori Revisi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden=" true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <table class="table table-bordered table-hover table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mockup</th>
                            <th>Keterangan</th>
                            <th>File Tambahan Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php
                        // if (count($data) == 1) {
                        //     $data = null;
                        // }
                        ?>
                        <?php if ($data) {
                            $num_histori = 1; ?>
                            <?php foreach ($data as $dataVal) { ?>
                                <?php if ($num_histori < count($data)) {
                                    $num_histori++;
                                } else {
                                    continue;
                                } ?>
                                <tr>
                                    <td>
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (file_exists('./upload/mockup/' . $dataVal->MOCKUP) && $dataVal->MOCKUP != null) {
                                            echo "<a href='" . base_url() . "upload/mockup/" . $dataVal->MOCKUP . "' target='_blank' class='btn btn-sm btn-primary'>Lihat</a>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?= $dataVal->KETERANGAN; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (file_exists('./upload/file_customer_revisi/' . $dataVal->FILE_CUSTOMER) && $dataVal->FILE_CUSTOMER != null) {
                                            echo "<a href='" . base_url() . "upload/file_customer_revisi/" . $dataVal->FILE_CUSTOMER . "' target='_blank' class='btn btn-sm btn-primary'>Lihat</a>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="4">Tidak Ada Data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>