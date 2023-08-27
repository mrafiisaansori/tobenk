<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DATA PENGGUNA</h4>
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

                        <h4 class="header-title">Daftar Pengguna</h4>
                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>No Telepon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($pengguna) { ?>
                                    <?php $seq_num = 1; ?>
                                    <?php foreach ($pengguna as $p) { ?>
                                        <tr>
                                            <td><?php echo $seq_num; ?></td>
                                            <td><?php echo $p->NAMA; ?></td>
                                            <td><?php echo $p->USERNAME; ?></td>
                                            <td>
                                                <?php if ($p->LEVEL == 1) { ?>
                                                    <span class="badge badge-primary">Admin</span>
                                                <?php } else if ($p->LEVEL == 3) { ?>
                                                    <span class="badge badge-danger">Produksi</span>
                                                <?php } else if ($p->LEVEL == 4) { ?>
                                                    <span class="badge badge-warning">Desiner</span>
                                                <?php } else if ($p->LEVEL == 5) { ?>
                                                    <span class="badge badge-secondary">Manager Toko</span>
                                                <?php }  else { ?>
                                                    <span class="badge badge-info">Kasir</span>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $p->TELP ?></td>
                                            <td>
                                                <?php if ($p->LEVEL != 1) { ?>
                                                    <a onclick='modalEditPengguna(<?php echo $p->ID ?>)' class='btn btn-warning' style='color:white;'><i class='mdi mdi-pencil'></i></a>&nbsp;
                                                <?php } ?>
                                                <a href="<?php echo base_url('admin/resetPasswordPengguna/' . $p->ID) ?>" class='btn btn-info' style='color:white;' onclick="return confirm('Yakin Reset Password?')"><i class='mdi mdi-reload'></i></a>&nbsp;
                                                <?php if ($p->LEVEL != 1) { ?>
                                                    <a href='<?php echo base_url('admin/deletePengguna/' . $p->ID) ?>' style='color:white;' class='btn btn-danger' onclick="return confirm('Yakin Hapus Data?')"><i class='mdi mdi-delete'></i></a>
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
        </div> <!-- end row -->
    </div>
</div>
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/tambahPengguna') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Username</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Password</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Level</label>
                        <div class="col-md-8">
                            <select name="level" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Kasir</option>
                                <option value="3">Produksi</option>
                                <option value="4">Desainer</option>
                                <option value="5">Manager Toko</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">No Telepon</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="telp">
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
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="<?php echo base_url('admin/editPengguna') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_nama" name="nama">
                            <input class="form-control" type="hidden" id="e_id" name="id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Username</label>
                        <div class="col-md-8">
                            <span id="e_username"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Level</label>
                        <div class="col-md-8">
                            <select name="level" id="e_level" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Kasir</option>
                                <option value="3">Produksi</option>
                                <option value="4">Desainer</option>
                                <option value="5">Manager Toko</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">No Telepon</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_telp" name="telp">
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
    function modalEditPengguna(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/modalEditPengguna') ?>",
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                $("#e_id").val(data['ID']);
                $("#e_nama").val(data['NAMA']);
                $("#e_username").html(data['USERNAME']);
                $("#e_level option[value='" + data['LEVEL'] + "']").attr('selected', true);
                $("#e_telp").val(data['TELP']);
                $("#modalEdit").modal();
            }
        })
    }
</script>