<div class="page-title-box">
    <div class="container-fluid">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h4 class="page-title mb-1">Pencatatan Uang Keluar</h4>


            </div>


            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">
                        <button class="btn btn-light btn-rounded e" type="button" data-toggle="modal" data-target="#modalTambah" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="page-content-wrapper">

    <div class="container-fluid">


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>Uang Keluar</h5>
                        </div>
                        <table class="table table-striped table-bordered" id="tables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Hapus</th>
                                </tr>
                                <?php $total = 0; ?>
                            <tbody>
                                <?php if ($data) : $no = 1; ?>
                                    <?php foreach ($data as $dataVal) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $dataVal->KETERANGAN; ?></td>
                                            <td><?= tgl_indo_lengkap($dataVal->TANGGAL); ?></td>
                                            <td><?= formatRupiah($dataVal->NOMINAL);
                                                $total += $dataVal->NOMINAL ?></td>
                                            <td>
                                                <a href="<?= base_url('kasir/deleteUangKeluar/' . $dataVal->ID); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                            </thead>
                        </table>
                        <div class="row">
                            <div class="col-xl-3 mt-4">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <blockquote class="card-bodyquote mb-0">
                                            <p><?php echo formatRupiah($total); ?></p>
                                            <footer class="blockquote-footer text-white">
                                                Total
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->

</div>

<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('kasir/insertUangKeluar') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Pencatatan Uang Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-4 col-form-label">Nominal</label>
                            <div class="col-md-8">
                                <input type="text" name="nominal" class="form-control only-num" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-4 col-form-label">Keterangan</label>
                            <div class="col-md-8">
                                <textarea name="keterangan" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-4 col-form-label">Tanggal</label>
                            <div class="col-md-8">
                                <input type="text" name="tanggal" class="form-control datepicker2" data-language="en" required readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM

    });
</script>
<script>
    $(document).ready(function() {
        $("#tables").dataTable();
    })
</script>