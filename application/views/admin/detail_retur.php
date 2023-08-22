<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DETAIL RETUR - NOMOR NOTA : <?php echo $retur->NO_NOTA; ?></h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">
                        <?php if ($retur->STATUS == 0) { ?>
                            <!-- <a  class="btn btn-light btn-rounded e">
                                <i class="mdi mdi-check-all mr-1"></i> Selesai
                            </a> -->
                            <button class="btn btn-light btn-rounded e" type="button" data-toggle="modal" data-target="#modalTambah" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-plus mr-1"></i> Tambah
                            </button>
                        <?php } ?>
                        <a class="btn btn-light btn-rounded e" href="<?php echo base_url('admin/retur.html') ?>">
                            <i class="mdi mdi-skip-backward mr-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">
                            <div class="float-left">Detail Retur</div>

                        </h4><br><br>
                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Supplier</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $jumlah = 0;
                                $nominal = 0; ?>
                                <?php if ($detail_retur) { ?>
                                    <?php $seq_num = 1; ?>
                                    <?php foreach ($detail_retur as $dr) { ?>
                                        <tr>
                                            <td><?php echo $seq_num; ?></td>
                                            <td><?php echo $dr->NAMA_PRODUK; ?></td>
                                            <td><?php echo $dr->QTY; ?></td><?php $jumlah += $dr->QTY; ?>
                                            <td><?php echo $dr->NAMA_SUPPLIER; ?></td>
                                            <td><?php echo $dr->KETERANGAN; ?></td>
                                            <td>
                                                <?php if ($retur->STATUS == 0) { ?>
                                                    <a href='<?php echo base_url('admin/deleteDetailRetur/' . $id_retur . '/' . $dr->ID_DETAIL_RETUR) ?>' style='color:white;' class='btn btn-danger' onclick="return confirm('Yakin Hapus Data?')"><i class='mdi mdi-delete'></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $seq_num++; ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-6">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-5">Total Qty</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5"><?php echo $jumlah; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div>
</div>
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/tambahDetailRetur/' . $id_retur) ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Detail Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Pencarian Produk</label>
                        <div class="col-md-8">
                            <input type="text" name="cari" class="form-control" id="cari" placeholder="Masukkan minimal 3 digit untuk pencarian...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Produk</label>
                        <div class="col-md-8">
                            <select id="produk" name="produk" class="form-control" required onchange="getUkuran()">
                                <option>Pilih Produk</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Ukuran</label>
                        <div class="col-md-8">
                            <select id="produk_detail" name="produk_detail" class="form-control" required>
                                <option>Pilih Ukuran</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Qty</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="jumlah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Supplier</label>
                        <div class="col-md-8">
                            <select name="supplier" class="form-control" style="width:100%;">
                                <?php if ($supplier) { ?>
                                    <?php foreach ($supplier as $s) { ?>
                                        <option value="<?php echo $s->ID ?>"><?php echo $s->NAMA; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea name="keterangan" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#cari").keyup(function() {
        if ($(this).val().length >= 3) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('admin/cariProduk') ?>",
                data: "cari=" + $(this).val(),
                cache: false,
                success: function(msg) {
                    $("#produk").html(msg);
                    getUkuran();
                },
                error: function() {
                    alert("error");
                }
            })
        } else {
            $("#produk").html("");
        }
    });

    function getUkuran() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/getUkuran') ?>",
            data: "id_produk=" + $("#produk").val(),
            cache: false,
            success: function(msg) {
                $("#produk_detail").html(msg);
            },
            error: function() {
                alert("error");
            }
        });
        return false;
    }
</script>