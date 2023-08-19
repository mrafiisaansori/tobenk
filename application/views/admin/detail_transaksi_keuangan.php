<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">DATA TRANSAKSI KEUANGAN - TANGGAL <?php echo tgl_indo_lengkap($tgl);?></h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                <li class="breadcrumb-item active"></li>
                </ol>
            </div>
            <div class="col-md-4">
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
                        <h4 class="header-title">
                            <div class="float-left">Daftar Transaksi</div>
                            <div class="float-right">
                                <a href="<?php echo base_url('admin/transaksi-keuangan.html');?>" class="btn btn-info text-white"><i class="mdi mdi-arrow-left-bold"></i></a>
                            </div>
                        </h4>
                        <form action="<?php echo base_url('admin/insertTransaksiKeuangan')?>" method="post" id="formTransaksi">
                            <div id="tabel-transaksi">
                                <table class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th width="50px;">No</th>
                                            <th>Nama Transaksi</th>
                                            <th width="170px">Debit</th>
                                            <th width="170px">Kredit</th>
                                            <th width="170px">Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $seq_num = 1;$saldo = 0;$debit=0;$kredit=0;?>
                                        <?php if($transaksi){?>
                                            <?php foreach($transaksi as $t){?>
                                                <tr>
                                                    <td><?php echo $seq_num;?></td>
                                                    <td ><?php echo $t->NAMA_TRANSAKSI;?></td>
                                                    <td><?php if($t->JENIS_TRANSAKSI == 'D'){ echo formatRupiah($t->NOMINAL); $saldo += $t->NOMINAL;$debit += $t->NOMINAL;}?></td>
                                                    <td><?php if($t->JENIS_TRANSAKSI == 'K'){ echo formatRupiah($t->NOMINAL); $saldo -= $t->NOMINAL;$kredit += $t->NOMINAL;}?></td>
                                                    <td><?php if($saldo < 0){echo " - ".formatRupiah(substr($saldo,1));}else{echo formatRupiah($saldo);}?></td>
                                                </tr>
                                                <?php $seq_num++;?>
                                            <?php }?>
                                        <?php }else{?>
                                        <tr>
                                            <td colspan="5" align="center">Belum Ada Transaksi</td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td colspan="2" align="center">Total</td>
                                            <td><?php echo formatRupiah($debit);?></td>
                                            <td><?php echo formatRupiah($kredit);?></td>
                                            <td><?php if($saldo < 0){echo " - ".formatRupiah(substr($saldo,1));}else{echo formatRupiah($saldo);}?></td>
                                        </tr>
                                        <?php if($tgl){?>
                                            <tr>
                                                <td colspan="3"><input type="text" class="form-control" placeholder="Nama Transaksi" name="nama" required ></td>
                                                <td>
                                                    <select name="jenis" id="" class="form-control">
                                                        <option value="D">Debit</option>
                                                        <option value="K">Kredit</option>
                                                    </select>
                                                </td>
                                                <td>
                                                <input type="text" class="form-control" placeholder="Nominal" name="nominal" required >
                                                <input type="hidden" name="tgl" value="<?php echo $tgl;?>" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="right">
                                                    <img src="http://sale.rafiisa.com/theme/loader.gif" width="50px" style="display:none;" id="loading">
                                                    <input type="submit" class="btn btn-primary" value="Tambah">
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#formTransaksi").submit(function(event){
            $("#loading").show();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                cache: false,
                success: function(msg){
                    if(msg == 0){
                        Swal.fire(
                            'Transaksi Keuangan',
                            'Gagal Tambah Data!',
                            'error'
                        )
                    }else{
                        Swal.fire(
                            'Transaksi Keuangan',
                            'Berhasil Tambah Data!',
                            'success'
                        )
                        $("#tabel-transaksi").html(msg);
                    }          
                    $(this).reset();
                    $("#loading").hide();
                }
            })
            event.preventDefault();
        });
    });
</script>