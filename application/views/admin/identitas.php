<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DATA IDENTITAS</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                <li class="breadcrumb-item active"></li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">
                        <button class="btn btn-light btn-rounded e" type="button" onclick="modalEditIdentitas()">
                            <i class="mdi mdi-pencil mr-1"></i> Edit
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
                        <table class="table table-striped ">
                            <tr>
                                <td width="200px">Nama</td>
                                <td width="50px">:</td>
                                <td><?php echo $identitas->NAMA?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?php echo $identitas->ALAMAT?></td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>:</td>
                                <td><?php echo $identitas->NO_TELP?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $identitas->EMAIL?></td>
                            </tr>
                            <tr>
                                <td>Website</td>
                                <td>:</td>
                                <td><?php echo $identitas->WEBSITE?></td>
                            </tr>
                            <tr>
                                <td>Logo</td>
                                <td>:</td>
                                <td>
                                    <?php if($identitas->LOGO){?>
                                        <img src="<?php echo base_url('upload/logo/'.$identitas->LOGO)?>" alt="" style="width:100px;">
                                    <?php }?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form  action="<?php echo base_url('admin/editIdentitas')?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Identitas</h5>
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
                        <label for="example-text-input" class="col-md-4 col-form-label">Email</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Website</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" id="e_website" name="website">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">
                            Logo<br>
                            <span style="color:red">*Format File PNG<br>*Max 5 MB</span>
                        </label>
                        <div class="col-md-8">
                            <input class="form-control" type="file" name="logo">
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
        
    function modalEditIdentitas(){
        $.ajax({
            type :"post",
            url: "<?php echo base_url('admin/modalEditIdentitas')?>",
            dataType: 'json',
            success: function(data){
                $("#e_id").val(data['ID']);
                $("#e_nama").val(data['NAMA']);
                $("#e_alamat").val(data['ALAMAT']);
                $("#e_telp").val(data['NO_TELP']);
                $("#e_email").val(data['EMAIL']);
                $("#e_website").val(data['WEBSITE']);
                $("#modalEdit").modal();
            }
        })
    }
</script>