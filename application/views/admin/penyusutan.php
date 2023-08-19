<?php
if($produk->num_rows()>0)
{
?>
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1"><?php echo $produk->row()->NAMA; ?></h4>
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
                 <div class="alert alert-warning" role="alert">
                      Hapus data penyusutan akan berdampak pada berubahnya <b>Harga Jual di data produk</b> sesuai dengan <b>Harga Pokok pada data penyusutan</b>.
                    </div>
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">
                            <div class="float-left">Penyusutan Produk</div>
                            <div class="float-right">
                                <a href="<?php echo base_url('admin/produk.html')?>" class="btn btn-info text-white"><i class="mdi mdi-arrow-left-bold"></i></a>
                            </div>
                        </h4><br><br>
                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Harga Pokok</th>
                                    <th>Prosentase</th>
                                    <th>Harga Pokok Penjualan</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $jumlah=0;$nominal=0;?>
                            <?php if($detail_pembelian->num_rows()>0){?>
                                <?php $seq_num=1;?>
                                <?php foreach($detail_pembelian->result() as $db){?>
                                    <tr>
                                        <td><?php echo $seq_num;?></td>
                                        <td><?php echo formatRupiah($db->HARGA_JUAL_AWAL); ?></td>
                                        <td><?php echo $db->PROSENTASE_PENYUSUTAN."%"; ?></td>
                                        <td><?php echo formatRupiah($db->HARGA_JUAL_AKHIR);?></td>
                                        <td><?php if($db->TANGGAL) $all = explode(" ", $db->TANGGAL); echo "<b>".tgl_indo_lengkap($all[0])."</b> ".$all[1]; ?></td>
                                        <td><a href="<?php echo site_url('urgent/hapuspenyusutan/'.$db->ID); ?>" class="btn btn-danger" onclick="return confirm('Hapus data akan mengubah harga jual di produk sesuai dengan harga pokok yang ada di penyusutan, anda yakin melakukan penghapusan data?');">Hapus</a></td>
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
            <form  action="<?php echo base_url('urgent/dopenyusutan/'.$produk->row()->ID); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Penyusutan Harga Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Harga Pokok</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="harga_pokok" readonly="" style="background: #dddddd;" id="harga_pokok" value="<?php echo $produk->row()->HARGA_JUAL; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Prosentase</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="prosentase" id="prosentase" onkeyup="prosentaseae()" placeholder="Hanya di isi angka saja, tanpa %">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-md-4 col-form-label">Harga Pokok Penjualan</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text"  name="harga_pokok_penjualan" id="harga_pokok_penjualan">
                        </div>
                    </div>
                    <div class="alert alert-warning" role="alert">
                      Setelah di simpan <b>Harga Pokok Penjualan</b> Otomatis merubah harga jual pada produk.
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>
<script>
    function prosentaseae() 
    {
        var harga_pokok = parseInt($("#harga_pokok").val());
        var prosentase = parseInt($("#prosentase").val());
        var perhitungan = (harga_pokok*(prosentase/100))+harga_pokok;
        $("#harga_pokok_penjualan").val(parseInt(perhitungan));
    }
    function setInputFilter(textbox, inputFilter) {
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      });
    }
    setInputFilter(document.getElementById("prosentase"), function(value) { return /^-?\d*$/.test(value); });
</script>