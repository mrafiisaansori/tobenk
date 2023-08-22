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
				<div class="float-right d-none d-md-block">
					<div class="dropdown">
						<a class="btn btn-light btn-rounded e" href="<?php echo base_url('admin/customer.html') ?>">
							<i class="mdi mdi-skip-backward mr-1"></i> Kembali
						</a>
					</div>
				</div>
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
									$total = 0;
									$jumlah = 0;
									$diskon = 0;
									$pendapatan = 0;
									$terbayar = 0;
									if ($penjualan->num_rows() > 0) {
										foreach ($penjualan->result() as $key) {
											$jumlah++;
									?>
											<tr>
												<td><?php echo sprintf("%06d", $key->ID); ?></td>
												<td><?php echo "<b>" . tgl_indo_lengkap($key->TANGGAL) . "</b><br><span style='font-size:9pt'>" . $key->JAM . "</span>"; ?></td>
												<td><?php echo $key->JENIS_BAYAR; ?></td>
												<?php $total += $key->TOTAL; ?>
												<?php $diskon += $key->DISKON; ?>
												<td style='font-size:10pt'><?php echo formatRupiah($key->TOTAL - $key->DISKON);
																			$pendapatan += ($key->TOTAL - $key->DISKON); ?></td>
												<td style='font-size:10pt'><?php if ($key->ID_METODE_BAYAR == 1) {
																				echo formatRupiah($key->TOTAL - $key->DISKON);
																				$terbayar += $key->TOTAL - $key->DISKON;
																			} else {
																				echo formatRupiah($key->BAYAR);
																				$terbayar += $key->BAYAR;
																			} ?></td>
												<td>
													<?php
													if ($key->LUNAS == 1)
														echo "<span style='font-size:10pt' class='badge badge-primary'>Lunas</span></span>";
													else
														echo "<span style='font-size:10pt' class='badge badge-danger'>Belum Lunas</span></span>";
													?>
													<br><span style='font-size:9pt'><?php if ($key->ID_METODE_BAYAR == 1) echo "Full Payment";
																					else  echo "Down Payment"; ?></span>
												</td>
												<td>
													<?php
													if ($key->STATUS == 1) {
														if ($key->STATUS_PENGERJAAN == 0) echo "<span class='badge badge-secondary' style='font-size:10pt;'>Diproses</span>";
														else if ($key->STATUS_PENGERJAAN == 1) echo "<span class='badge badge-warning' style='font-size:10pt;'>Desain Diupload</span>";
														else if ($key->STATUS_PENGERJAAN == 2) echo "<span class='badge badge-danger' style='font-size:10pt;'>Revisi Desain</span>";
														else if ($key->STATUS_PENGERJAAN == 3) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Desain</span>";
														else if ($key->STATUS_PENGERJAAN == 4) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Produksi</span>";
														else if ($key->STATUS_PENGERJAAN == 5) echo "<span class='badge badge-success' style='font-size:10pt;'>Diambil</span>";
													} else {
														echo "<span style='font-size:10pt' class='badge badge-soft-secondary'>Dibatalkan</span>";
													}
													?>
												</td>
												<td>
													<a onclick="detail(<?php echo $key->ID; ?>)" href="javascript:void(0)" class="btn btn-primary mr-1"><i class="mdi mdi-eye"></i></a>
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

<div id="myModald" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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



<script type="text/javascript">
	function detail(id) {
		$("#loading").show();
		$.ajax({
			type: "post",
			url: "<?php echo site_url('admin/modalTransaksi'); ?>",
			data: "id=" + id,
			cache: false,
			success: function(msg) {
				$("#loading").hide();
				$("#konten").html(msg);
				$("#myModald").modal();
			},
			error: function() {
				alert('error');
			}
		});
		return false;
	}
	// $('#myModal').modal('show');
	function edit(id) {
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
			success: function(data) {
				$("#laporan").html(data);
				$("#loading").hide();
			},
			error: function(data) {
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

	function hapus(id) {
		if (confirm("Anda yakin menghapus transaksi ini?")) {
			$("#loading").show();
			$.ajax({
				url: "<?php echo site_url('kasir/delete_transaksi'); ?>",
				type: "POST",
				data: "id=" + id,
				success: function(result) {
					if (result == "1") {
						Swal.fire(
							'Berhasil',
							'Transkasi Telah Dibatalkan',
							'success'
						);
					} else if (result == "0") {
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
</script>