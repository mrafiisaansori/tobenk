<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DATA JENIS BAYAR</h4>
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

                        <h4 class="header-title">Daftar Jenis Bayar</h4>
                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NAMA</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($jenisbayar){?>
                                <?php $seq_num=1;?>
                                <?php foreach($jenisbayar as $jb){?>
                                    <tr>
                                        <td><?php echo $seq_num;?></td>
                                        <td><?php echo $jb->NAMA;?></td>
                                        <td>
                                            <a onclick='modalEditJenisBayar(<?php echo $jb->ID?>)' class='btn btn-warning' style='color:white;'><i class='mdi mdi-pencil'></i></a>&nbsp;
                                            <a href='<?php echo base_url('admin/deleteJenisBayar/'.$jb->ID)?>' style='color:white;' class='btn btn-danger' onclick="return confirm('Yakin Hapus Data?')"><i class='mdi mdi-delete'></i></a>							
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
            <form  action="<?php echo base_url('admin/tambahJenisBayar')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jenis Bayar</h5>
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
            <form  action="<?php echo base_url('admin/editJenisBayar')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Jenis Bayar</h5>
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
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
        
    function modalEditJenisBayar(id){
        $.ajax({
            type :"post",
            url: "<?php echo base_url('admin/modalEditJenisBayar')?>",
            data : "id="+id,
            dataType: 'json',
            success: function(data){
                $("#e_id").val(data['ID']);
                $("#e_nama").val(data['NAMA']);
                $("#modalEdit").modal();
            }
        })
    }
</script>