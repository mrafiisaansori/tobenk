<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DATA KATEGORI</h4>
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

                        <h4 class="header-title">Daftar Kategori</h4>
                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                <?php if($kategori){?>
                                    <?php $seq_num = 1;?>
                                    <?php foreach($kategori as $k){?>
                                        <tr>
                                            <td><?php echo $seq_num;?></td>
                                            <td><?php echo $k->DESKRIPSI;?></td>
                                            <td>
                                                <a onclick="modalEditKategori(<?php echo $k->ID;?>)" class="btn btn-warning" style="color:white;"><i class="mdi mdi-pencil"></i></a>&nbsp;
                                                <?php 
                                                $cek=$this->db->get_where("m_produk",["ID_KATEGORI"=>$k->ID]);
                                                $confirm="return confirm('Yakin Hapus Data?')";
                                                if($cek->num_rows()==0){
                                                    $w='href="'.base_url('admin/deleteKategori/'.$k->ID).'" onclick="'.$confirm.'"';
                                                }else{
                                                    $w='onclick="tidak()"';
                                                }
                                                ?>
                                                <a <?php echo $w; ?>  style="color:white;" class="btn btn-danger" ><i class="mdi mdi-delete"></i></a>
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
            <form  action="<?php echo base_url('admin/tambahKategori')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="dekripsi" name="deskripsi">
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
            <form  action="<?php echo base_url('admin/editKategori')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Deskripsi</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_deskripsi" name="deskripsi">
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
    function modalEditKategori(id){
        $.ajax({
            type :"post",
            url: "<?php echo base_url('admin/modalEditKategori')?>",
            data : "id="+id,
            dataType: 'json',
            success: function(data){
                $("#e_id").val(data['ID']);
                $("#e_deskripsi").val(data['DESKRIPSI']);
                $("#modalEdit").modal();
            }
        })
    }
    function tidak(){
        Swal.fire(
            'Mohon Maaf',
            'Anda tidak dapat menghapus data ini, karena ada produk yang terkait.',
            'warning'
        )
    }
</script>