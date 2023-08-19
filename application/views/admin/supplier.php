<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DATA SUPPLIER</h4>
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

                        <h4 class="header-title">Daftar Supplier</h4>
                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Nama PIC</th>
                                    <th>No Telepon PIC</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($supplier){?>
                                <?php $seq_num=1;?>
                                <?php foreach($supplier as $s){?>
                                    <tr>
                                        <td><?php echo $seq_num;?></td>
                                        <td><?php echo $s->NAMA;?></td>
                                        <td><?php echo $s->ALAMAT?></td>
                                        <td><?php echo $s->NO_TELP?></td>
                                        <td><?php echo $s->NAMA_PIC?></td>
                                        <td><?php echo $s->NO_TELP_PIC?></td>
                                        <td>
                                            <a onclick='modalEditSupplier(<?php echo $s->ID?>)' class='btn btn-warning' style='color:white;'><i class='mdi mdi-pencil'></i></a>&nbsp;
                                            <?php 
                                            $cek=$this->db->get_where("t_detail_pembelian",["ID_SUPPLIER"=>$s->ID]);
                                            if($cek->num_rows()==0){
                                            ?>
                                                <a href='<?php echo base_url('admin/deleteSupplier/'.$s->ID)?>' onclick="return confirm('Yakin Hapus Data?')" style='color:white;' class='btn btn-danger' ><i class='mdi mdi-delete'></i></a>				
                                            <?php
                                            }else{
                                                ?>
                                                <a onclick="tidak()" style='color:white;' class='btn btn-danger' ><i class='mdi mdi-delete'></i></a>
                                                <?php
                                            }
                                            ?>			
                                        </td>   
                                    </tr>
                                    <?php $seq_num++;?>
                                <?php }?>
                            <?php }?>
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
            <form  action="<?php echo base_url('admin/tambahSupplier')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">No Telepon</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="telp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Nama PIC</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="nama_pic">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">No Telepon PIC</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="telp_pic">
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
            <form  action="<?php echo base_url('admin/editSupplier')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Supplier</h5>
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
                        <label for="example-text-input" class="col-md-4 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_alamat" name="alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">No Telepon</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_telp" name="telp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Nama PIC</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_nama_pic" name="nama_pic">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">No Telepon PIC</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_telp_pic" name="telp_pic">
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
        
    function modalEditSupplier(id){
        $.ajax({
            type :"post",
            url: "<?php echo base_url('admin/modalEditSupplier')?>",
            data : "id="+id,
            dataType: 'json',
            success: function(data){
                $("#e_id").val(data['ID']);
                $("#e_nama").val(data['NAMA']);
                $("#e_alamat").val(data['ALAMAT']);
                $("#e_telp").val(data['NO_TELP']);
                $("#e_nama_pic").val(data['NAMA_PIC']);
                $("#e_telp_pic").val(data['NO_TELP_PIC']);
                $("#modalEdit").modal();
            }
        })
    }
    function tidak(){
        Swal.fire(
            'Mohon Maaf',
            'Anda tidak dapat menghapus data ini, karena ada transaksi yang terkait.',
            'warning'
        )
    }
</script>