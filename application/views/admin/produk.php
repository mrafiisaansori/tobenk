<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DATA PRODUK</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
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
<!-- end page title end breadcrumb -->

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Daftar Produk</h4>
                        <table id="tableAjax" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <!-- <th>Ukuran</th> -->
                                    <th>Keterangan</th>
                                    <th>Kategori</th>
                                    <th>Ukuran</th>
                                    <!-- <th width="78px">Harga Beli</th>
                                    <th width="78px">Harga Jual</th> -->
                                    <th width="130px">Action</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <form action="<?php echo base_url('admin/tambahProduk') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Ukuran File Max 500 Kb
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea name="keterangan" class="form-control" id="" rows="5" placeholder="Keterangan Produk"></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Ukuran</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="ukuran">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select name="kategori" id="" class="form-control">
                                <?php if ($kategori) { ?>
                                    <?php foreach ($kategori as $k) { ?>
                                        <option value="<?php echo $k->ID ?>"><?php echo $k->DESKRIPSI ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row" id="v_stok">
                        <label for="example-text-input" class="col-md-4 col-form-label">Stok</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" name="stok">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Harga Beli</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" name="harga_beli">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Harga Jual</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" name="harga_jual">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Barcode</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="barcode">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Tanpa Stok</label>
                        <div class="col-md-8">
                            <select name="tanpa_stok" id="tanpa_stok" class="form-control" onchange="ubahFlagStok(this,'')">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <legend>
                        Ukuran
                        <div style="float:right;">
                            <button class="btn btn-success btn-sm" onclick="tambahUkuran('')" type="button"><i class="mdi mdi-plus mr-1"></i></button>
                        </div>
                    </legend>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Ukuran</th>
                                        <th class='v_stok'>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Barcode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="v_ukuran">
                                    <tr>
                                        <td>
                                            <input type="text" name="ukuran[]" class="form-control" required>
                                        </td>
                                        <td class='v_stok'>
                                            <input class="form-control only-nums" type="text" name="stok[]" value="0" required>
                                        </td>
                                        <td>
                                            <input class="form-control only-num" type="text" name="harga_beli[]">
                                        </td>
                                        <td>
                                            <input type="text" name="harga_jual[]" class="form-control only-num">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="barcode[]">
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/editProduk') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Ukuran File Max 500 Kb
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_nama" name="nama">
                            <input class="form-control" type="hidden" id="e_id" name="id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea name="keterangan" class="form-control" id="e_keterangan" rows="5" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Ukuran</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="ukuran" id="ukuran">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select name="kategori" id="e_kategori" class="form-control">
                                <?php if ($kategori) { ?>
                                    <?php foreach ($kategori as $k) { ?>
                                        <option value="<?php echo $k->ID ?>"><?php echo $k->DESKRIPSI ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg">
                            <br>
                            <span id="foto_preview"></span>
                        </div>
                    </div>
                    <!-- <div class="form-group row" id="e_v_stok">
                        <label for="example-text-input" class="col-md-4 col-form-label">Stok</label>
                        <div class="col-md-8">
                            <span id="e_stok"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Harga Beli</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="e_harga_beli" name="harga_beli">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Harga Jual</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" id="e_harga_jual" name="harga_jual">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Barcode</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_barcode" name="barcode">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Tanpa Stok</label>
                        <div class="col-md-8">
                            <select name="tanpa_stok" id="e_tanpa_stok" class="form-control" onchange="ubahFlagStok(this,'e_')">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <legend>
                        Ukuran
                        <div style="float:right;">
                            <button class="btn btn-success btn-sm" onclick="tambahUkuran('e_')" type="button"><i class="mdi mdi-plus mr-1"></i></button>
                        </div>
                    </legend>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Ukuran</th>
                                        <th class='e_v_stok'>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Barcode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="e_v_ukuran">
                                </tbody>
                            </table>
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

<div class="modal fade" id="modalStok" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/stokInsidentil') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pengaturan Stok Insidentil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Jenis</label>
                        <div class="col-md-8">
                            <select name="jenis" id="" class="form-control">
                                <option value="1">Masuk</option>
                                <option value="2">Keluar</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Jumlah</label>
                        <div class="col-md-8">
                            <input type="number" name="jumlah" class="form-control">
                            <input type="hidden" name="id" id="id" class="form-control">
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

<div class="modal fade" id="modalHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">History Stok Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="hist"></div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#tableAjax").dataTable({
            "iDisplayLength": 10,
            "responsive": true,
            "aLengthMenu": [10, 25, 50, 100],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo base_url('admin/getTabelJsonProduk') ?>",
            "sPaginationType": "full_numbers"
        });
    })

    function modalEditProduk(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/modalEditProduk') ?>",
            data: "id=" + id,
            dataType: 'json',
            success: function(resp) {
                const {
                    data,
                    detail_produk
                } = resp;
                $("#e_id").val(data['ID_PRODUK']);
                $("#e_nama").val(data['NAMA_PRODUK']);
                $("#ukuran").val(data['UKURAN']);
                $("#e_kategori option[value='" + data['ID_KATEGORI'] + "']").attr('selected', true);
                $("#e_stok").html(data['STOK']);
                $("#e_harga_beli").val(data['HARGA_BELI']);
                $("#e_harga_jual").val(data['HARGA_JUAL']);
                $("#e_barcode").val(data['BARCODE']);
                $("#e_keterangan").val(data['KETERANGAN']);
                if (data['FOTO']) {
                    $("#foto_preview").html("<img src='<?php echo site_url(); ?>/" + data['FOTO'] + "' class='mt-4 img-thumbnail' width='150px'>");
                }
                $("#e_barcode").val();
                $("#e_tanpa_stok option").removeAttr('selected');
                $("#e_tanpa_stok option[value='" + data['TANPA_STOK'] + "'").attr('selected', true).change();
                $("#e_v_ukuran").html("");
                detail_produk.forEach((detail) => {
                    tambahUkuran('e_', detail);
                });
                $("#modalEdit").modal();
            }
        })
    }

    function modalStok(id) {
        $("#id").val(id);
        $("#modalStok").modal();
    }

    function modalHistory(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/modalHistory') ?>",
            data: "id=" + id,
            success: function(data) {
                $("#hist").html(data);
                $("#modalHistory").modal();
            }
        })
    }

    function deleteData(id) {
        if (confirm('Yakin Hapus Data?')) {
            window.location.href = "<?php echo base_url('admin/deleteProduk/') ?>" + id;
        }
    }

    function tidak() {
        Swal.fire(
            'Mohon Maaf',
            'Anda tidak dapat menghapus data ini, karena ada transaksi yang terkait.',
            'warning'
        )
    }

    function ubahFlagStok(element, jenis) {
        $(element).val() == 1 ? $("." + jenis + "v_stok").hide() : $("." + jenis + "v_stok").show();
    }

    function tambahUkuran(jenis, data = null) {
        const ukuran = data ? data.UKURAN : "";
        const stok = data ? data.STOK : "0";
        const harga_beli = data ? data.HARGA_BELI : "";
        const harga_jual = data ? data.HARGA_JUAL : "";
        const barcode = data ? data.BARCODE : "";
        const id = data ? data.ID : "";

        console.table(ukuran, stok, harga_beli, harga_jual, barcode, id);

        var hide = $("#" + jenis + "tanpa_stok").val() == 1 ? "style='display:none;'" : "";
        var saveButton = jenis == "e_" ?
            `<button class="btn btn-primary btn-sm mr-1" onclick="saveUkuran(this)" type="button">
                    <i class="mdi mdi mdi-check-bold mr-1"></i>
            </button>` : ``;
        $('#' + jenis + "v_ukuran").append(`
        <tr>
            <td>
                <input type="text" name="ukuran[]" class="form-control" value='${ukuran}' required>
                <input type="hidden" name="id[]" class="form-control" value='${id}'>
            </td>
            <td class='${jenis}v_stok' ${hide}>
                <input class="form-control only-nums" type="text" name="stok[]" value="${stok}" required ${data ? 'disabled' : ''}>
            </td>
            <td>
                <input class="form-control only-num" type="text" name="harga_beli[]" value="${harga_beli}">
            </td>
            <td>
                <input type="text" name="harga_jual[]" class="form-control only-num" value="${harga_jual}">
            </td>
            <td>
                <input class="form-control" type="text" name="barcode[]" value="${barcode}">
            </td>
            <td>
                <div class="d-flex">
                    ${saveButton}
                    <button class="btn btn-danger btn-sm" onclick="hapusUkuran(this)" type="button">
                    <i class="mdi mdi-delete mr-1"></i>
                    </button>
                </div>
            </td>
        </tr>
        `);
    }

    function hapusUkuran(element) {
        id = $(element).closest('tr').find('input[name="id[]"]').val();
        if (id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('admin/hapusUkuran') ?>",
                data: "id=" + id,
                success: function(msg) {
                    if (msg == 1) {
                        $(element).closest('tr').remove();
                    } else {
                        alert('Ukuran sudah terpakai, tidak dapat dihapus');
                    }
                }
            })
        } else {
            $(element).closest('tr').remove();
        }
    }

    function saveUkuran(element) {
        const tr = $(element).closest('tr');
        const id_produk = $("#modalEdit").find('input[name="id"]').val();
        const id_detail = tr.find('input[name="id[]"]').val();
        const ukuran = tr.find('input[name="ukuran[]"]').val();
        const stok = tr.find('input[name="stok[]"]').val();
        const harga_beli = tr.find('input[name="harga_beli[]"]').val();
        const harga_jual = tr.find('input[name="harga_jual[]"]').val();
        const barcode = tr.find('input[name="barcode[]"]').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/saveUkuran') ?>",
            data: {
                id_produk,
                id_detail,
                ukuran,
                stok,
                harga_beli,
                harga_jual,
                barcode
            },
            success: function(msg) {
                if (msg > 0) {
                    tr.find('input[name="id[]"]').val(msg);
                    alert('Berhasil Disimpan');
                } else {
                    alert('Gagal Disimpan');
                }
            }
        })
    }
</script>