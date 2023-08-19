<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DATA PEMBELIAN</h4>
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
                        <h4 class="header-title">Daftar Pembelian</h4>
                        <table id="tableAjax" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Nota</th>
                                    <th>Tanggal</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th class="no-sort">Action</th>
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
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form  action="<?php echo base_url('admin/tambahPembelian')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">No Nota</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="no_nota" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Tanggal</label>
                        <div class="col-md-8">
                            <input class="form-control datepicker2" type="text" name="tanggal" data-language="en" required>
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
            <form  action="<?php echo base_url('admin/editPembelian')?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">No Nota</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_no_nota" name="no_nota" required>
                            <input class="form-control" type="hidden" id="e_id" name="id" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Tanggal</label>
                        <div class="col-md-8">
                            <input class="form-control datepicker2" type="text" name="tanggal" id="e_tanggal" data-language="en" required>
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
    $(document).ready(function(){
        $("#tableAjax").dataTable({
            "iDisplayLength": 10, 
            "aLengthMenu": [10,25,50,100],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo base_url('admin/getTabelJsonPembelian')?>" , 
            "sPaginationType": "full_numbers",
            "order": [[ 0, "desc" ]]
        });
    })
    function modalEditPembelian(id){
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/modalEditPembelian')?>",
            data: "id="+id,
            dataType: "json",
            success: function(data){
                $("#e_id").val(data['ID_PEMBELIAN']);
                $("#e_no_nota").val(data['NO_NOTA']);
                $("#e_tanggal").val(data['TANGGAL']);
                $("#modalEdit").modal();
            }
        });
    }
    function deleteData(id){
        if(confirm('Yakin menghapus pembelian? Detail pembelian juga akan dihapus.')){
            window.location.href="<?php echo base_url('admin/hapusPembelian/')?>"+id;
        }
    }
</script>