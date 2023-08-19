<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DETAIL PEMBELIAN - NOMOR NOTA : <?php echo $pembelian->NO_NOTA;?></h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                <li class="breadcrumb-item active"></li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">
                        <?php if($pembelian->STATUS == 0){?>
                            <a  class="btn btn-light btn-rounded e" onclick="modalSelesaikanPembelian(<?php echo $id_pembelian;?>)">
                                <i class="mdi mdi-check-all mr-1"></i> Selesai
                            </a>
                            <button class="btn btn-light btn-rounded e" type="button" data-toggle="modal" data-target="#modalTambah" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-plus mr-1"></i> Tambah
                            </button>
                        <?php }?>
                        <a class="btn btn-light btn-rounded e" href="<?php echo base_url('admin/pembelian.html')?>" >
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
                <div class="alert alert-success" role="alert">
                          Dengan menekan tombol <strong>Selesai</strong> maka stok pada menu <strong>produk</strong> akan otomatis bertambah
                        </div>
                <div class="card">
                    <div class="card-body">
                        
                        <h4 class="header-title">
                            <div class="float-left">Detail Pembelian</div>
                            
                        </h4><br><br>
                        
                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Beli</th>
                                    <th>Qty</th>
                                    <th>Supplier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $jumlah=0;$nominal=0;?>
                            <?php if($detail_pembelian){?>
                                <?php $seq_num=1;?>
                                <?php foreach($detail_pembelian as $db){?>
                                    <tr>
                                        <td><?php echo $seq_num;?></td>
                                        <td><?php echo $db->NAMA_PRODUK;?></td>
                                        <td><?php echo formatRupiah($db->HARGA_BELI);?></td>
                                        <td><?php echo $db->QTY;?></td><?php $jumlah += $db->QTY;$nominal+=$db->HARGA_BELI*$db->QTY;?>
                                        <td><?php echo $db->NAMA_SUPPLIER;?></td>
                                        <td>
                                            <?php if($pembelian->STATUS == 0){?>
                                                <a href='<?php echo base_url('admin/deleteDetailPembelian/'.$id_pembelian.'/'.$db->ID_DETAIL_PEMBELIAN)?>' style='color:white;' class='btn btn-danger' onclick="return confirm('Yakin Hapus Data?')"><i class='mdi mdi-delete'></i></a>							
                                            <?php }?>                                               
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
            <div class="col-6">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-5">Total Qty</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5"><?php echo $jumlah;?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-5">Total Nominal</div>
                            <div class="col-md-2"> : </div>
                            <div class="col-md-5"><?php echo formatRupiah($nominal);?></div>
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
            <form  action="<?php echo base_url('admin/tambahDetailPembelian/'.$id_pembelian)?>" method="post">
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
                            <select id="produk" name="produk" class="form-control" required onchange="getHargaBeli()">
                            <option>Pilih Produk</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Harga Beli Terakhir</label>
                        <div class="col-md-8 mt-2">
                            <span id="beli_terakhir">Rp. 0</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Harga Beli Sekarang</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="harga_beli" id="harga_beli" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Qty</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="jumlah" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Supplier</label>
                        <div class="col-md-8">
                            <select name="supplier" class="form-control">
                                <?php if($supplier){?>
                                    <?php foreach($supplier as $s){?>
                                        <option value="<?php echo $s->ID?>"><?php echo $s->NAMA;?></option>
                                    <?php }?>
                                <?php }?>
                            </select>
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
    function getHargaBeli(){
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/getHargaBeli')?>",
            data: "id_produk="+$("#produk").val(),
            cache: false,
            success: function(msg){
                $("#beli_terakhir").html(msg);
            },error: function(){
                alert("error");
            }
        });
        return false;
    }
    $("#cari").keyup(function(){
        if($(this).val().length >= 3){
            $.ajax({
                type: "post",
                url: "<?php echo base_url('admin/cariProduk')?>",
                data: "cari="+$(this).val(),
                cache: false,
                success: function(msg){
                    $("#produk").html(msg);
                    getHargaBeli();
                },error: function(){
                    alert("error");
                }
            })
        }else{
            $("#produk").html("");
        }
    });
    function modalSelesaikanPembelian(id_pembelian){
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/modalSelesaikanPembelian')?>",
            data: "id_pembelian="+id_pembelian,
            cache: false,
            success: function(msg){
                $(msg).modal();
            },error: function(){
                alert('error');
            }
        });
    }
    $("#harga_beli").maskMoney();
</script>