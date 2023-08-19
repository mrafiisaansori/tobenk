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
                            <th>Detail</th>
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
                        if($data->num_rows()>0)
                        {
                            foreach ($data->result() as $key) 
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
                                    <td>
                                    <a target="_blank" href="<?php echo site_url('kasir/detail/'.base64_encode_fix($key->ID)); ?>" class="btn btn-primary mr-1"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                    
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot style="font-weight:bold;">
                        <tr style="font-size:10pt!important">
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
                            <td>
                                
                            </td>
                        </tr>
                    </tfoot>
                </table>
<script type="text/javascript">
    $('#datatable').DataTable({
        responsive: true
    });
    function hapus(id){
        if(confirm("Anda yakin menghapus transaksi ini?")){
			$("#loading").show();
			$.ajax({
				url: "<?php echo site_url('kasir/delete_transaksi'); ?>",
				type: "POST",
				data: "id="+id, 
				success: function(result){
                    if(result=="1"){
                        Swal.fire(
                            'Berhasil',
                            'Transkasi Telah Dibatalkan',
                            'success'
                        );
                    }
                    else if(result=="0"){
                        Swal.fire(
                            'Gagal',
                            'Transkasi Gagal Dibatalkan',
                            'error'
                        );
                    }
                    $("#form-beli").submit();
			    	$("#loading").hide();
			 	}
			});
		}
    }
</script>