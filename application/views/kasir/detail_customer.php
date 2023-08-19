<style>
</style>
<div class="page-title-box"> 
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Detail Customer</h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Detail Customer</li>
                </ol>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
			<div class="row">
			    <div class="col-xl-3">
			        <div class="card">
			            <div class="card-body">
										<div class="row">
			    						<div class="col-xl-12">
												<center>
													<img src="<?php echo site_url('theme/user.png'); ?>" alt="" width="150" class="mb-3 mt-2">
													<h4><?php echo $customer->NAMA ?></h4>
													<p class="mb-2">(<?php echo $customer->NO_TELP ?>)<br><?php echo $customer->ALAMAT ?></p>
													<a href="javascript:void(0)" onclick="edit(<?php echo $customer->ID ?>)" class="btn btn-block btn-primary"><i class="mdi mdi-pencil mr-1"> </i> Edit Customer</a>
													<?php
													if($penjualan->num_rows()==0)
													{
													?>
														<a href="<?php echo site_url('kasir/hapusCustomer/'.base64_encode_fix($customer->ID)); ?>" onclick="return confirm('Yakin menghapus data customer ini?')" class="btn btn-block btn-danger"><i class="mdi mdi-trash-can mr-1"> </i> Hapus Customer</a>
													<?php
													}else{
														?>
														<a onclick="tidak()" href="javascript:void(0)" class="btn btn-block btn-danger"><i class="mdi mdi-trash-can mr-1"> </i> Hapus Customer</a>
														<?php
													}
													?>
												</center>
											</div>
										</div>
			            </div>
			        </div>
			    </div>
					<div class="col-xl-9">
						<div class="card">
								<h6 class="card-header bg-transparent border-bottom mt-0"><b>History Transaksi</b></h6>
			            <div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
											<thead>
											<tr>
													<th>No</th>
													<th>Tanggal</th>
													<th>Transaksi</th>
													<th>Tagihan</th>
													<th>Terbayar</th>
													<th>Pembayaran</th>
													<th>Status</th>
													<th>Action</th>
											</tr>
											</thead>
											<tbody>
													<?php
													$total=0;
													$jumlah=0;
													$diskon=0;
													$pendapatan=0;
													$terbayar=0;
													if($penjualan->num_rows()>0)
													{
															foreach ($penjualan->result() as $key) 
															{
																	$jumlah++;
																	?>
																	<tr>
																			<td><?php echo sprintf("%06d",$key->ID); ?></td>
																			<td><?php echo "<b>".tgl_indo_lengkap($key->TANGGAL)."</b><br><span style='font-size:9pt'>".$key->JAM."</span>"; ?></td>
																			<td><?php echo $key->JENIS_BAYAR; ?></td>
																			<?php   $total+=$key->TOTAL; ?>
																			<?php  $diskon+=$key->DISKON; ?>
																			<td style='font-size:10pt'><?php  echo formatRupiah($key->TOTAL-$key->DISKON); $pendapatan+=($key->TOTAL-$key->DISKON); ?></td>
																			<td style='font-size:10pt'><?php if($key->ID_METODE_BAYAR==1) { echo formatRupiah($key->TOTAL-$key->DISKON); $terbayar+=$key->TOTAL-$key->DISKON; }  else  { echo formatRupiah($key->BAYAR); $terbayar+=$key->BAYAR; } ?></td>
																			<td>
																				<?php 
																				if($key->LUNAS==1) 
																					echo "<span style='font-size:10pt' class='badge badge-primary'>Lunas</span></span>"; 
																				else
																					echo "<span style='font-size:10pt' class='badge badge-danger'>Belum Lunas</span></span>"; 
																			?>
																			<br><span style='font-size:9pt'><?php if($key->ID_METODE_BAYAR==1) echo "Full Payment"; else  echo "Down Payment"; ?></span>
																		</td>
																			<td>
																				<?php 
																				if($key->STATUS==1){
																					if($key->STATUS_PENGERJAAN==1) 
																						echo "<span style='font-size:10pt' class='badge badge-soft-success'>Selesai</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($key->SELESAI)."</span>"; 
																					elseif($key->STATUS_PENGERJAAN==0)  
																						echo "<span style='font-size:10pt' class='badge badge-soft-danger'>Proses Pengerjaan</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($key->TANGGAL." ".$key->JAM)."</span>"; 
																					elseif($key->STATUS_PENGERJAAN==2) 
																						echo "<span style='font-size:10pt' class='badge badge-soft-primary'>Diambil</span><br><span style='font-size:9pt'>".tgl_jam_indo_lengkap($key->AMBIL)."</span>"; 
																				} 
																				else
																				{
																					 echo "<span style='font-size:10pt' class='badge badge-soft-secondary'>Dibatalkan</span>"; 
																				}  
																				?>
																			</td>
																			<td>
																					<a target="_blank" href="<?php echo site_url('kasir/detail/'.base64_encode_fix($key->ID)); ?>" class="btn btn-primary mr-1"><i class="mdi mdi-eye"></i></a>
																	</tr>
																	<?php
															}
													}
													?>
											</tbody>
									</table>
									</div>
									</div>
							</div>
			    </div>
			</div>
	</div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">
							<h5 class="modal-title mt-0" id="myModalLabel">Detail Transaksi</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<form action="<?php echo site_url('kasir/editCustomer/'.base64_encode_fix($id)) ?>" method="post">
					<div class="modal-body">
						<div class="form-group form-group-custom mb-4">
								<h5 class="font-size-14">Nama</h5>
								<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $customer->NAMA; ?>">
						</div>
						<div class="form-group form-group-custom mb-4">
								<h5 class="font-size-14">Alamat</h5>
								<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $customer->ALAMAT; ?>">
						</div>
						<div class="form-group form-group-custom mb-4">
								<h5 class="font-size-14">No Telp</h5>
								<input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $customer->NO_TELP; ?>">
						</div>
					</div>
					<div class="modal-footer">
							<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary waves-effect">Simpan</button>
					</div>
					</form>
			</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>




<script type="text/javascript">
	// $('#myModal').modal('show');
	function edit(id){
		$("#loading").show();
		$('#myModal').modal('show');
		$("#loading").hide();
	}
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
                    window.location.reload();
			 	}
			});
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