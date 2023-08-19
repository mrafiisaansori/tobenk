<style>
    .focus-btn-group{
        display:none;
    }
    s{
    text-decoration : line-through;
    font-size:9pt!important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <a target="_blank" href="<?php echo site_url('admin/cetak-penjulan/'.$kasir.'/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$status); ?>" class="btn btn-primary mb-3"><i class="mdi mdi-printer mr-1"></i>Cetak</a>
            <!-- <a href="<?php //echo site_url('admin/eksporPenjualan/'.$kasir.'/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$status); ?>" class="btn btn-primary mb-3"><i class="mdi mdi-file-excel-outline mr-1"></i>Ekspor</a> -->
            <div class="table-rep-plugin">
              <div class="table-responsive mb-0" data-pattern="priority-columns">
                <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:9pt">
                    <thead>
                        <tr style="font-size:11pt!important">
                            <th>No</th>
                            <th>Customer</th>
                            <th>Tanggal</th>
                            <th>Transaksi</th>
                            <th>Diskon</th>
                            <th>Tagihan</th>
                            <th >Terbayar</th>
                            <th>Status</th>
                            <th>Laba</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $total=0;
                        $jumlah=0;
                        $diskon=0;
                        $pendapatan=0;
                        $terbayar=0;
                        $laba_total=0;
                        $belum_bayar=0;
                        if($penjualan)
                        {
                            foreach ($penjualan as $key) 
                            {
                                $jumlah++;
                                ?>
                                <tr>
                                    <td><?php echo sprintf("%06d",$key->ID); ?></td>
                                    <td><?php if($key->ID_CUSTOMER) echo "<a href='javascript:void()' onclick='detail(".$key->ID.")' style='font-size:11pt'><b>".($key->NAMA_CUSTOMER)."</b></a><br><span>".$key->ALAMAT."<br>".$key->NO_TELP."</span>"; else echo "<a href='javascript:void()' onclick='detail(".$key->ID.")' style='font-size:11pt'><b>Tidak Terdaftar</b></a>"; ?></td>
                                    <td><?php echo "<b>".tgl_indo_lengkap($key->TANGGAL)."</b><br><span>".$key->JAM."</span>"; ?></td>
                                    <td ><?php echo $key->JENIS_BAYAR; if($key->ID_METODE_BAYAR==1) echo "<br><span class='badge badge-soft-success' style='font-size:10pt'>Full</span>"; else  echo "<br><span class='badge badge-soft-danger' style='font-size:10pt'>DP</span>"; ?></td>
                                    <?php   $total+=$key->TOTAL; ?>
                                    <?php  $diskon+=$key->DISKON; ?>
                                    <td>
                                        <?php echo formatRupiah($key->DISKON); ?>
                                    </td>
                                    <td ><?php  $pnd=$key->TOTAL-$key->DISKON;  echo "<b>".formatRupiah($pnd)."</b>"; if($key->DISKON){ echo "<br><s>".formatRupiah($key->TOTAL)."</s>"; } $pendapatan+=$pnd;  ?></td>
                                    <td ><?php if($key->ID_METODE_BAYAR==1) { echo formatRupiah($pnd); $terbayar+=$pnd; $fa=0; }  else  { echo formatRupiah($key->BAYAR); $terbayar+=$key->BAYAR; $fa=$pnd-$key->BAYAR; }   $belum_bayar+=$fa;  ?></td>
                                    <td ><?php  if($key->LUNAS==1) echo "<span class='badge badge-primary' style='font-size:10pt'>Lunas</span>"; else echo "<span class='badge badge-danger' style='font-size:10pt'>Belum Lunas</span><br><span style='font-size:9pt'>Kurang ".formatRupiah($fa)."</span>"; ?></td>
                                    
                                    <td >
                                        <?php 
                                        $laba=0;
                                        $barang=$this->db->get_where("view_detail_penjualan",["ID_TRANSAKSI_PENJUALAN"=>$key->ID]);
                                        //echo $this->db->last_query();
                                        if($barang->num_rows()>0){
                                            foreach ($barang->result() as $keys) {
                                                $laba += ($keys->HARGA_JUAL-$keys->HARGA_BELI)*$keys->QTY;
                                            }
                                        }
                                        echo formatRupiah($laba);
                                        $laba_total+=$laba;
                                        ?>
                                    </td>
                                    
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot style="font-weight:bold;">
                        <tr style="font-size:11pt!important">
                            <td colspan=4 align=center>Total</td>
                            <td >
                                <?php echo formatRupiah($diskon);?>
                            </td>
                            <td >
                                <?php echo formatRupiah($pendapatan); ?>
                            </td>
                            <td >
                                <?php echo formatRupiah($terbayar); ?>
                            </td>
                            <td >
                                <?php echo formatRupiah($belum_bayar); ?>
                            </td>
                           
                            <td >
                                <?php echo formatRupiah($laba_total);?>
                            </td>
                            
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-xl-12">
        <div class="card text-white bg-primary">
            <h6 class="card-header bg-transparent border-bottom mt-0" style="color: white"><b>Laba Bersih</b></h6>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-0">
                    <p><?php echo formatRupiah($laba_total-$diskon);?></p>
                </blockquote>
                <footer class="blockquote-footer text-white">
                    Perhitungan dari Total Laba - Diskon
                </footer>
            </div>
        </div>
    </div>
    <!-- <div class="col-xl-2">
        <div class="card text-black" style="background-color:#d5ff94!important">
            <h6 class="card-header bg-transparent border-bottom mt-0" style="color: black"><b>Total Tagihan</b></h6>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-0">
                    <p><?php //echo formatRupiah($pendapatan); ?></p>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="col-xl-2">
        <div class="card text-black" style="background-color:#ffef9f!important">
            <h6 class="card-header bg-transparent border-bottom mt-0" style="color: black"><b>Omzet</b></h6>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-0">
                    <p><?php //echo formatRupiah($terbayar); ?></p>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="col-xl-2">
        <div class="card text-black" style="background-color:#ffc2c2!important">
            <h6 class="card-header bg-transparent border-bottom mt-0" style="color: black"><b>Total Belum Bayar</b></h6>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-0">
                    <p><?php //echo formatRupiah($belum_bayar); ?></p>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="col-xl-2">
        <div class="card text-black" style="background-color:lightblue!important">
            <h6 class="card-header bg-transparent border-bottom mt-0" style="color: black"><b>Total Laba</b></h6>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-0">
                    <p><?php //echo formatRupiah($laba_total);?></p>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="col-xl-2">
        <div class="card text-black" style="background-color:cyan!important">
            <h6 class="card-header bg-transparent border-bottom mt-0" style="color: black"><b>Total Diskon</b></h6>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-0">
                    <p><?php //echo formatRupiah($diskon);?></p>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="col-xl-2">
        <div class="card text-white bg-primary">
            <h6 class="card-header bg-transparent border-bottom mt-0" style="color: white"><b>Net</b></h6>
            <div class="card-body">
                <blockquote class="card-bodyquote mb-0">
                    <p><?php //echo formatRupiah($laba_total-$diskon);?></p>
                </blockquote>
            </div>
        </div>
    </div> -->
</div> <!-- end row -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" style="max-width:1339px!important">
			<div class="modal-content">
					<div class="modal-header">
							<h5 class="modal-title mt-0" id="myModalLabel">Detail Transaksi</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body">
							<div id="konten"></div>
					</div>
			</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<script>
    // $(document).ready(function(){
    //     $("#datatable").DataTable({
    //         responsive: true
    //     });
    // });
    function detail(id){
        $("#loading").show();
        $.ajax({
            type: "post",
            url:  "<?php echo site_url('admin/modalTransaksi'); ?>",
            data: "id="+id,
            cache :false,
            success :function(msg){
                $("#loading").hide();
                $("#konten").html(msg);
                $("#myModal").modal();
            },error: function(){
                alert('error');
            }
        });
        return false;
    }
</script>
<script src="<?php echo site_url('theme/Vertical/dist'); ?>/assets/js/pages/table-responsive.init.js"></script>