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
                                <th>Ukuran</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th width="78px">Harga Beli</th>
                                <th width="78px">Harga Jual</th>
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
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form  action="<?php echo base_url('admin/tambahProduk')?>" method="post" enctype="multipart/form-data">
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
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Ukuran</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="ukuran">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select name="kategori" id="" class="form-control">
                                <?php if($kategori){?>
                                    <?php foreach($kategori as $k){?>
                                        <option value="<?php echo $k->ID?>"><?php echo $k->DESKRIPSI?></option>
                                    <?php }?>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <input type="file" name="foto">
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
            <form  action="<?php echo base_url('admin/editProduk')?>" method="post" enctype="multipart/form-data">
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
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Ukuran</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="ukuran" id="ukuran">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Kategori</label>
                        <div class="col-md-8">
                            <select name="kategori" id="e_kategori" class="form-control">
                                <?php if($kategori){?>
                                    <?php foreach($kategori as $k){?>
                                        <option value="<?php echo $k->ID?>"><?php echo $k->DESKRIPSI?></option>
                                    <?php }?>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Foto</label>
                        <div class="col-md-8">
                            <input type="file" id="foto" name="foto">
                            <br>
                            <span id="foto_preview"></span>
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
            <form  action="<?php echo base_url('admin/stokInsidentil')?>" method="post" enctype="multipart/form-data">
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
    $(document).ready(function(){
        $("#tableAjax").dataTable({
            "iDisplayLength": 10, 
            "responsive":true,
            "aLengthMenu": [10,25,50,100],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo base_url('admin/getTabelJsonProduk')?>" , 
            "sPaginationType": "full_numbers"
        });
    })
        
    function modalEditProduk(id){
        $.ajax({
            type :"post",
            url: "<?php echo base_url('admin/modalEditProduk')?>",
            data : "id="+id,
            dataType: 'json',
            success: function(data){
                $("#e_id").val(data['ID_PRODUK']);
                $("#e_nama").val(data['NAMA_PRODUK']);
                $("#ukuran").val(data['UKURAN']);
                $("#e_kategori option[value='"+data['ID_KATEGORI']+"']").attr('selected',true);
                $("#e_stok").html(data['STOK']);
                $("#e_harga_beli").val(data['HARGA_BELI']);
                $("#e_harga_jual").val(data['HARGA_JUAL']);
                $("#e_barcode").val(data['BARCODE']);
                $("#e_keterangan").val(data['KETERANGAN']);
                if(data['FOTO']){
                    $("#foto_preview").html("<img src='<?php echo site_url(); ?>/"+data['FOTO']+"' class='mt-4 img-thumbnail' width='150px'>");
                }
                $("#e_barcode").val();
                
                $("#modalEdit").modal();
            }
        })
    }
    function modalStok(id){
        $("#id").val(id);
        $("#modalStok").modal();
    }
    function modalHistory(id){
        $.ajax({
            type :"post",
            url: "<?php echo base_url('admin/modalHistory')?>",
            data : "id="+id,
            success: function(data){
                $("#hist").html(data);
                $("#modalHistory").modal();
            }
        })
    }
    function deleteData(id){
        if(confirm('Yakin Hapus Data?')){
            window.location.href = "<?php echo base_url('admin/deleteProduk/')?>"+id;
        }
    }
    function tidak(){
        Swal.fire(
            'Mohon Maaf',
            'Anda tidak dapat menghapus data ini, karena ada transaksi yang terkait.',
            'warning'
        )
    }
</script>