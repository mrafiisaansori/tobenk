<style>
</style>
<div class="page-title-box"> 
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Detail Transaksi</h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Detail Transaksi</li>
                </ol>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
						<?php
							if($data->STATUS==1){ 
							if($data->LUNAS==1){ ?>
						<div class="alert alert-primary" role="alert">
								Pembayaran Lunas &nbsp; <i class="mdi mdi-progress-check" style="font-size:12pt"></i>
						</div>
						<?php } else { ?>
						<div class="alert alert-danger" role="alert">
								Pembayaran Belum Lunas &nbsp; <i class="mdi mdi-pause-circle" style="font-size:12pt"></i>
						</div>
					<?php }}
					else{
						?>
						<div class="alert alert-danger" role="alert">
								Transaksi Dibatalkan &nbsp; <i class="mdi mdi-trash-o" style="font-size:12pt"></i>
						</div>
						<?php
					}
					 ?>
			<div class="row">
			    <div class="col-xl-5">
			        <div class="card">
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>History Transaksi</b></h6>
			            <div class="card-body">
										<div class="row">
			    						<div class="col-xl-12">
												<table class="table table-bordered" style="font-size:10pt">
													<tbody>
														<tr>
															<th style="background-color:#f8f9fa"><b>No Nota</b></th>
															<th style=""><?php echo sprintf("%06d",$data->ID); ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>Nama</b></th>
															<th style=""><?php echo $data->NAMA_CUSTOMER ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>Alamat</b></th>
															<th style=""><?php echo $data->ALAMAT ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>No Telp</b></th>
															<th style=""><?php echo $data->NO_TELP ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>Tanggal Transaksi</b></th>
															<th><?php echo tgl_indo_lengkap($data->TANGGAL)." (".$data->JAM.")"; ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>Tanggal Deadline</b></th>
															<th><?php echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>Jenis Bayar</b></th>
															<th><?php echo $data->JENIS_BAYAR ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>Metode Bayar</b></th>
															<th><?php if($data->ID_METODE_BAYAR==1) echo "Full Payment"; else echo "Down Payment"; ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>Status Pengerjaan</b></th>
															<th><?php if($data->STATUS==1){ if($data->STATUS_PENGERJAAN==1) echo "<span style='font-size:10pt' class='badge badge-soft-success'>Selesai</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($data->SELESAI)."</span>"; elseif($data->STATUS_PENGERJAAN==0)  echo "<span style='font-size:10pt' class='badge badge-soft-danger'>Proses Pengerjaan</span>"; if($data->STATUS_PENGERJAAN==2) echo "<span style='font-size:10pt' class='badge badge-soft-primary'>Diambil</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($data->AMBIL)."</span>"; } else { echo "<span style='font-size:10pt' class='badge badge-soft-secondary'>Dibatalkan</span>"; }  ?></th>
														</tr>
														<tr>
															<th style="background-color:#f8f9fa"><b>Keterangan</b></th>
															<th><?php echo $data->KETERANGAN ?></th>
														</tr>
													</tbody>
												</table>
												
											</div>
										</div>
			            </div>
			        </div>
			    </div>
					<div class="col-xl-7">
						<div class="card">
								<h6 class="card-header bg-transparent border-bottom mt-0"><b>Produk</b></h6>
			            <div class="card-body">
									<table class="table table-bordered"  style="font-size:10pt">
												<tr style="background-color:#f8f9fa">
													<td style="font-weight:bold;" align="center">Produk</td>
													<td style="font-weight:bold;" align="center">Qty</td>
													<td style="font-weight:bold;" align="center">Harga</td>
													<td style="font-weight:bold;" align="center">Total</td>
												</tr>
												<?php
												$tot=0;
												if($produk->num_rows()>0){
												foreach ($produk->result() as $dat) {
													?>
													<tr>
														<td><B><?php echo $dat->NAMA_PRODUK; ?> (<?php echo $dat->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $dat->KETERANGAN; ?></span></td>
														<td align="center"><?php echo $dat->QTY; ?></td>
														<td align="right"><?php echo formatRupiah($dat->HARGA_JUAL); ?></td>
														<td align="right"><?php echo formatRupiah($dat->QTY*$dat->HARGA_JUAL); $tot+=$dat->QTY*$dat->HARGA_JUAL; ?></td>
													</tr>
													<?php
												}
											}
												?>
												<tfoot>
													<tr>
														<td colspan="3" align="right" style="font-weight:bold;">Grand Total</td>
														<td align="right"><?php echo formatRupiah($tot); ?></td>
													</tr>
													<tr>
														<td colspan="3" align="right" style="font-weight:bold;">Diskon</td>
														<td align="right"><?php echo formatRupiah($data->DISKON); ?></td>
													</tr>
													<tr>
														<td colspan="3" align="right" style="font-weight:bold;">Tagihan</td>
														<td align="right"><?php echo formatRupiah($tot-$data->DISKON);  $hd = $tot-$data->DISKON; ?></td>
													</tr>
													<tr>
														<td colspan="3" align="right" style="font-weight:bold;">Dibayar</td>
														<td align="right"><?php echo formatRupiah($data->BAYAR); ?></td>
													</tr>
													<tr>
														<td colspan="3" align="right" style="font-weight:bold;"><?php  if($data->ID_METODE_BAYAR==1) echo "Kembalian"; else echo "Kurang Bayar"; ?></td>
														<td align="right"><?php $tsemua = $data->BAYAR-$hd;  echo formatRupiah(abs($tsemua)); ?></td>
													</tr>
												</tfoot>
											</table>
			            </div>
			        </div>
							<?php if($data->STATUS_PENGERJAAN==0){ ?>
									<?php  if($data->STATUS==1){ ?>
									<a href="<?php echo site_url('kasir/selesai/'.base64_encode_fix($id)); ?>" class="btn btn-block btn-success "><i class="mdi mdi-file-document-box-check mr-1"></i> Selesaikan Pekerjaan</a>
									<a href="javascript:void(0)" onclick="hapus(<?php echo $data->ID; ?>)" class="btn btn-block btn-danger  mb-3"><i class="mdi mdi-trash-can mr-1"></i> Batalkan</a>
									<?php  } ?>
							<?php }  else if($data->STATUS_PENGERJAAN==1){  ?>
							<a href="<?php echo site_url('kasir/ambil/'.base64_encode_fix($id)); ?>" class="btn btn-block btn-primary mb-3" onclick="return confirm('Dengan menekan tombol ini, maka transaksi dianggap selesai dan pesanan telah diberikan kepada customer')"><i class="mdi mdi-check-bold mr-1"></i> Selesaikan Transaksi</a>
							<?php } ?>
			    </div>

			</div>
	</div>
</div>





<script type="text/javascript">
	$("#form-beli").submit(function(e) {
		$("#loading").show();
	    var form = $(this);
	    var url = form.attr('action');
	    $.ajax({
	       type: "POST",
	       url: url,
	       data: form.serialize(),
	       success: function(data)
	       {
	       	  $("#laporan").html(data);
	          $("#loading").hide();
	       },
	       error: function(data)
	       {
	       		Swal.fire(
                  'Terjadi Kesalahan',
                  'Periksa kembali koneksi anda',
                  'error'
                )
	       }
	     });
	     return false;
	});
	$("#bayar").maskMoney();
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
										window.setTimeout(function(){
											window.location.reload();
										}, 5000);
                   
			 	}
			});
		}
    }
</script>