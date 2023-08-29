<div class="mt-10" style="padding: 24px 12px 65px 12px;">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-8">
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</div>
</div>
<div class="page-content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<ul class="nav nav-tabs nav-justified nav-tabs-custom mb-3" role="tablist">
									<li class="nav-item waves-effect waves-light">
										<a class="nav-link active" data-toggle="tab" href="javascript:void(0)" role="tab" onclick="produk(0)">
											<i class="fas fa-window-restore mr-1"></i> Semua
										</a>
									</li>
									<?php
									$kategori = $this->db->get("m_kategori");
									if ($kategori->num_rows() > 0) {
										foreach ($kategori->result() as $key) {
									?>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-toggle="tab" href="javascript:void(0)" role="tab" onclick="produk(<?php echo $key->ID; ?>)">
													<i class="fas fa-window-restore mr-1"></i> <?php echo $key->DESKRIPSI; ?>
												</a>
											</li>
									<?php
										}
									}
									?>
								</ul>
								<div class="form-group m-0">
									<div class="input-group">
										<input type="hidden" id="kategori_aktif" value="0">
										<input type="text" class="form-control" id="pencarian" placeholder="Pencarian..." onkeyup="cari_produk()" autofocus>
										<div class="input-group-append">
											<button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="produk_show">

				</div>
			</div>
			<div class="col-md-4">
				<div class="card mb-4">
					<div class="card-body">
						<table class="table table-striped">
							<tbody id="barang">
							</tbody>
						</table>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<form action="<?php echo site_url('kasir/bayar') ?>" method="post" enctype="multipart/form-data">
							<div>
								<div class="form-row form-group-custom mb-4">
									<div class="col-12 mb-4">
										<h5 class="font-size-14"></h5>
										<a data-toggle="modal" data-target="#myModal" class="btn btn-primary mt-3" style="height:37px;width:100%" href="javascript:void(0)"><i class="mdi mdi-plus-thick"></i> Customer</a>
									</div>
									<div class="col-12">
										<h5 class="font-size-14">Customer</h5>
										<select name="customer" id="customer" class="selectize" onchange="lama()">
											<option value="">Pilih Nama - Alamat (No Telp)</option>
											<?php
											$cust = $this->db->query("SELECT * FROM m_customer WHERE `STATUS`=1 ORDER BY NAMA ASC");
											if ($cust->num_rows() > 0) {
												foreach ($cust->result() as $cs) {
													echo "<option value='" . $cs->ID . "'>" . $cs->NAMA . " - " . $cs->ALAMAT . " (" . $cs->NO_TELP . ")</option>";
												}
											}
											?>
										</select>
									</div>

								</div>
								<div class="form-group form-group-custom mb-4 contain">
									<!--<a data-toggle="modal" data-target="#PowerLensa"  href="javascript:void(0)" class="btn btn-primary" style="width:100%"><i class="mdi mdi-pencil-outline mr-1"></i>Ubah</a>
																		 <table class="table table-striped table-bordered">
																			<tr>
																				<td>Power Lensa</td>
																				<td width="200px">SPH</td>
																				<td width="200px">CYL</td>
																				<td width="200px">AXIS</td>
																				<td width="200px">ADD</td>
																				<td width="200px">PD</td>
																			</tr>
																			<tr>
																				<td>OD</td>
																				<td><input type="hidden" class="form-control" name="od-sph" id="od-sph"><span id="teks-od-sph"></span></td>
																				<td><input type="hidden" class="form-control" name="od-cyl" id="od-cyl"><span id="teks-od-cyl"></span></td>
																				<td><input type="hidden" class="form-control" name="od-axis" id="od-axis"><span id="teks-od-axis"></span></td>
																				<td><input type="hidden" class="form-control" name="od-add" id="od-add"><span id="teks-od-add"></span></td>
																				<td><input type="hidden" class="form-control" name="od-pd" id="od-pd"><span id="teks-od-pd"></span></td>
																			</tr>
																			<tr>
																				<td>OS</td>
																				<td><input type="hidden" class="form-control" name="os-sph" id="os-sph"><span id="teks-os-sph"></span></td>
																				<td><input type="hidden" class="form-control" name="os-cyl" id="os-cyl"><span id="teks-os-cyl"></span></td>
																				<td><input type="hidden" class="form-control" name="os-axis" id="os-axis"><span id="teks-os-axis"></span></td>
																				<td><input type="hidden" class="form-control" name="os-add" id="os-add"><span id="teks-os-add"></span></td>
																				<td><input type="hidden" class="form-control" name="os-pd" id="os-pd"><span id="teks-os-pd"></span></td>
																			</tr>
																		</table> -->

								</div>
								<div class="form-group form-group-custom mb-4">
									<h5 class="font-size-14">Keterangan</h5>
									<textarea name="keterangan" cols="6" rows="6" class="form-control"></textarea>
								</div>
								<div class="form-group form-group-custom mb-4">
									<h5 class="font-size-14">File Customer <span style="font-weight:bold;color:red">Only (CDR,PDF,JPG,JPEG,PNG) Max 2MB</span></h5>
									<input type="file" class="form-control mb-1" name="file_customer" id="file_customer">
									<input type="file" class="form-control mb-1" name="file_customer2" id="file_customer2">
									<input type="file" class="form-control mb-1" name="file_customer3" id="file_customer3">
								</div>
								<!-- <div class="form-group form-group-custom mb-4">
	                            	<h5 class="font-size-14">File Mentah</h5>
									<input type="text" class="form-control" name="file_mentah" placeholder="Masukkan Berupa Link">
								</div> -->
								<div class="form-group form-group-custom mb-4">
									<h5 class="font-size-14">Jenis Pembayaran</h5>
									<select class="form-control" name="jenis">
										<?php
										$jenis = $this->db->query("SELECT * FROM m_jenis_bayar");
										if ($jenis->num_rows() > 0) {
											foreach ($jenis->result() as $key) {
										?>
												<option value="<?php echo $key->ID; ?>"><?php echo $key->NAMA; ?></option>
										<?php
											}
										}
										?>
									</select>
								</div>
								<div class="form-group form-group-custom mb-4">
									<h5 class="font-size-14">Metode Pembayaran</h5>
									<select class="form-control" name="metode" id="metode" onchange="metode_bayar()">
										<option value="1">Full Payment</option>
										<option value="2">Down Payment</option>
									</select>
								</div>

								<div class="form-group form-group-custom mb-4">
									<h5 class="font-size-14">Deadline</h5>
									<input type="text" class="form-control datepicker2" data-language="en" id="estimasi" name="estimasi" value="<?php echo date('Y-m-d'); ?>" readonly required>
								</div>
								<!-- <div class="form-group form-group-custom mb-4">
	                            		<h5 class="font-size-14">Status Pengerjaan</h5>
																	<select class="form-control" name="status">
																		<option value="0">Dalam Proses</option>
																		<option value="1">Selesai</option>
																	</select>
	                            </div> -->
								<div class="form-group form-group-custom mb-4">
									<h5 class="font-size-14">Diskon</h5>
									<input type="text" class="form-control" id="diskon" name="diskon" value="0" onblur="total()">
								</div>
								<input type="hidden" name="nominal_belanja" id="nominal_belanja">
								<div class="form-group form-group-custom mb-1" id="tampil_bayar" style="display:none;">
									<h5 class="font-size-14">Bayar DP</h5>
									<input type="text" class="form-control" id="bayar" name="bayar" required="">
								</div>
								<div class="mt-4">
									<button class="btn btn-primary waves-effect waves-light" style="width:100%;font-size:16pt" type="submit"><span id='total_belanja'></span></button>
								</div>
							</div>
						</form>
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
				<h5 class="modal-title mt-0" id="myModalLabel">Tambah Data Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo site_url('kasir/simpanCustomer') ?>" method="post" id="form-customer">
				<div class="modal-body">
					<div class="form-group form-group-custom mb-4">
						<h5 class="font-size-14">Nama Customer</h5>
						<input type="text" class="form-control" name="nama" id="nama">
					</div>
					<div class="form-group form-group-custom mb-4">
						<h5 class="font-size-14">Alamat Customer</h5>
						<input type="text" class="form-control" name="alamat" id="alamat">
					</div>
					<div class="form-group form-group-custom mb-4">
						<h5 class="font-size-14">No HP / WhatsApp</h5>
						<input type="text" class="form-control" name="no_hp" id="no_hp">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<div id="PowerLensa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0" id="myModalLabel">Lensa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-lensa">
				<div class="modal-body">
					<table class="table table-striped table-bordered">
						<tr>
							<td>Power Lensa</td>
							<td width="200px">SPH</td>
							<td width="200px">CYL</td>
							<td width="200px">AXIS</td>
							<td width="200px">ADD</td>
							<td width="200px">PD</td>
						</tr>
						<tr>
							<td>OD</td>
							<td><input type="text" class="form-control" name="od-sph" id="od-sph-isi"></td>
							<td><input type="text" class="form-control" name="od-cyl" id="od-cyl-isi"></td>
							<td><input type="text" class="form-control" name="od-axis" id="od-axis-isi"></td>
							<td><input type="text" class="form-control" name="od-add" id="od-add-isi"></td>
							<td><input type="text" class="form-control" name="od-pd" id="od-pd-isi"></td>
						</tr>
						<tr>
							<td>OS</td>
							<td><input type="text" class="form-control" name="os-sph" id="os-sph-isi"></td>
							<td><input type="text" class="form-control" name="os-cyl" id="os-cyl-isi"></td>
							<td><input type="text" class="form-control" name="os-axis" id="os-axis-isi"></td>
							<td><input type="text" class="form-control" name="os-add" id="os-add-isi"></td>
							<td><input type="text" class="form-control" name="os-pd" id="os-pd-isi"></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	function metode_bayar() {
		if ($("#metode").val() == 1) {
			$('#tampil_bayar').css('display', 'none');
			total();
		} else if ($("#metode").val() == 2) {
			$("#bayar").val("");
			$('#tampil_bayar').css('display', 'block');
		}
	}
	tabel();
	produk(0);

	function total() {
		$.ajax({
			url: "<?php echo site_url('kasir/total'); ?>",
			type: "post",
			data: "diskon=" + $("#diskon").val(),
			success: function(result) {
				var fields = result.split('#');
				$("#total_belanja").html("Bayar <b>" + fields[1] + "</b>");
				$("#nominal_belanja").val(fields[0]);
				if ($("#metode").val() == 1) {
					$("#bayar").val(fields[3]);
				}
			}
		});
	}

	function tabel() {
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/tabel'); ?>",
			success: function(result) {
				$("#barang").html(result);
				total();
				$("#loading").hide();
			}
		});
	}

	function batal(id) {
		if (confirm("Anda yakin menghapus data ini?")) {
			$("#loading").show();
			$.ajax({
				url: "<?php echo site_url('kasir/batal'); ?>",
				type: "POST",
				data: "id=" + id,
				success: function(result) {
					tabel();
					$("#loading").hide();
				}
			});
		}
	}

	function gantiqty(id, rowid) {
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/gantiqty'); ?>",
			type: "POST",
			data: "produk=" + id + "&rowid=" + rowid + "&qty=" + $("#qty" + id).val(),
			success: function(result) {
				if (result == 99) {
					Swal.fire(
						'Terjadi Kesalahan',
						'Stok tidak mencukupi.',
						'error'
					)
				}
				tabel();
				$("#loading").hide();
			}
		});
	}

	function cari() {
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/cari'); ?>",
			type: "POST",
			data: "nama=" + $("#caribarang").val(),
			success: function(result) {
				$("#produk").html(result)
				$("#loading").hide();
			}
		});
	}
	$("#form-barcode").submit(function(e) {
		$("#loading").show();
		var form = $(this);
		var url = form.attr('action');
		$.ajax({
			type: "POST",
			url: url,
			data: form.serialize(),
			success: function(data) {
				$("#barcode").val('');
				$("#barcode").focus();
				if (data == 1) {

				} else if (data == 0) {
					Swal.fire(
						'Terjadi Kesalahan',
						'Stok tidak mencukupi.',
						'error'
					)
				} else {
					Swal.fire(
						'Terjadi Kesalahan',
						'Barang tidak ditemukan.',
						'error'
					)
				}
				tabel();
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

	function beli(id) {
		$("#loading").show();
		var form = $(this);
		var url = "<?php echo site_url('kasir/beli') ?>";
		$.ajax({
			type: "POST",
			url: url,
			data: "barang=" + id,
			success: function(data) {
				if (data == 1) {

				} else if (data == 0) {
					Swal.fire(
						'Terjadi Kesalahan',
						'Stok tidak mencukupi.',
						'error'
					)
				} else {
					Swal.fire(
						'Terjadi Kesalahan',
						'Barang tidak ditemukan.',
						'error'
					)
				}
				tabel();
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
	}
	$("#bayar").maskMoney();
	$("#diskon").maskMoney();

	//BARU//
	function produk(kategori) {
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/showProduk'); ?>",
			type: "POST",
			data: "id_kategori=" + kategori + "&pencarian=" + $("#pencarian").val(),
			success: function(result) {
				$("#kategori_aktif").val(kategori);
				$("#produk_show").html(result);
				$("#loading").hide();
			}
		});
	}

	function cari_produk() {
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/showProduk'); ?>",
			type: "POST",
			data: "id_kategori=" + $("#kategori_aktif").val() + "&pencarian=" + $("#pencarian").val(),
			success: function(result) {
				$("#produk_show").html(result);
				$("#loading").hide();
			}
		});
	}
	$("#form-customer").submit(function(e) {
		$("#loading").show();
		var form = $(this);
		var url = form.attr('action');
		$.ajax({
			type: "POST",
			url: url,
			data: form.serialize(),
			success: function(data) {
				$('#myModal').modal('hide');
				Swal.fire(
					'Berhasil',
					'Data Customer Telah Ditambahkan.',
					'success'
				);

				var $select = $(document.getElementById('customer'));
				var selectize = $select[0].selectize;
				selectize.addOption({
					value: data,
					text: $("#nama").val() + ' - ' + $("#alamat").val() + ' (' + $("#no_hp").val() + ')'
				});
				selectize.addItem(data);

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

	$("#form-lensa").submit(function(e) {
		$("#loading").show();

		$("#od-sph").val($("#od-sph-isi").val());
		$("#od-cyl").val($("#od-cyl-isi").val());
		$("#od-axis").val($("#od-axis-isi").val());
		$("#od-add").val($("#od-add-isi").val());
		$("#od-pd").val($("#od-pd-isi").val());
		$("#os-sph").val($("#os-sph-isi").val());
		$("#os-cyl").val($("#os-cyl-isi").val());
		$("#os-axis").val($("#os-axis-isi").val());
		$("#os-add").val($("#os-add-isi").val());
		$("#os-pd").val($("#os-pd-isi").val());

		$("#teks-od-sph").html($("#od-sph-isi").val());
		$("#teks-od-cyl").html($("#od-cyl-isi").val());
		$("#teks-od-axis").html($("#od-axis-isi").val());
		$("#teks-od-add").html($("#od-add-isi").val());
		$("#teks-od-pd").html($("#od-pd-isi").val());
		$("#teks-os-sph").html($("#os-sph-isi").val());
		$("#teks-os-cyl").html($("#os-cyl-isi").val());
		$("#teks-os-axis").html($("#os-axis-isi").val());
		$("#teks-os-add").html($("#os-add-isi").val());
		$("#teks-os-pd").html($("#os-pd-isi").val());

		$('#PowerLensa').modal('hide');
		$("#loading").hide();
		return false;
	});

	function lama() {
		// $("#loading").show();
		// $.ajax({
		// 	url: "<?php //echo site_url('kasir/historyTerakhir'); 
						?>", 
		// 	type: "POST",
		// 	data: "id_customer="+$("#customer").val(),
		// 	dataType:"json",
		// 	success: function(result){

		// 		$("#od-sph-isi").val(null);
		// 		$("#od-cyl-isi").val(null);
		// 		$("#od-axis-isi").val(null);
		// 		$("#od-add-isi").val(null);
		// 		$("#od-pd-isi").val(null);
		// 		$("#os-sph-isi").val(null);
		// 		$("#os-cyl-isi").val(null);
		// 		$("#os-axis-isi").val(null);
		// 		$("#os-add-isi").val(null);
		// 		$("#os-pd-isi").val(null);

		// 		$("#teks-od-sph").html("");
		// 		$("#teks-od-cyl").html("");
		// 		$("#teks-od-axis").html("");
		// 		$("#teks-od-add").html("");
		// 		$("#teks-od-pd").html("");
		// 		$("#teks-os-sph").html("");
		// 		$("#teks-os-cyl").html("");
		// 		$("#teks-os-axis").html("");
		// 		$("#teks-os-add").html("");
		// 		$("#teks-os-pd").html("");

		// 		$("#od-sph").val(null);
		// 		$("#od-cyl").val(null);
		// 		$("#od-axis").val(null);
		// 		$("#od-add").val(null);
		// 		$("#od-pd").val(null);
		// 		$("#os-sph").val(null);
		// 		$("#os-cyl").val(null);
		// 		$("#os-axis").val(null);
		// 		$("#os-add").val(null);
		// 		$("#os-pd").val(null);

		// 		$("#od-sph-isi").val(result['OD_SPH']);
		// 		$("#od-cyl-isi").val(result['OD_CYL']);
		// 		$("#od-axis-isi").val(result['OD_AXIS']);
		// 		$("#od-add-isi").val(result['OD_ADD']);
		// 		$("#od-pd-isi").val(result['OD_PD']);
		// 		$("#os-sph-isi").val(result['OS_SPH']);
		// 		$("#os-cyl-isi").val(result['OS_CYL']);
		// 		$("#os-axis-isi").val(result['OS_AXIS']);
		// 		$("#os-add-isi").val(result['OS_ADD']);
		// 		$("#os-pd-isi").val(result['OS_PD']);

		// 		$("#teks-od-sph").html(result['OD_SPH']);
		// 		$("#teks-od-cyl").html(result['OD_CYL']);
		// 		$("#teks-od-axis").html(result['OD_AXIS']);
		// 		$("#teks-od-add").html(result['OD_ADD']);
		// 		$("#teks-od-pd").html(result['OD_PD']);
		// 		$("#teks-os-sph").html(result['OS_SPH']);
		// 		$("#teks-os-cyl").html(result['OS_CYL']);
		// 		$("#teks-os-axis").html(result['OS_AXIS']);
		// 		$("#teks-os-add").html(result['OS_ADD']);
		// 		$("#teks-os-pd").html(result['OS_PD']);

		// 		$("#od-sph").val(result['OD_SPH']);
		// 		$("#od-cyl").val(result['OD_CYL']);
		// 		$("#od-axis").val(result['OD_AXIS']);
		// 		$("#od-add").val(result['OD_ADD']);
		// 		$("#od-pd").val(result['OD_PD']);
		// 		$("#os-sph").val(result['OS_SPH']);
		// 		$("#os-cyl").val(result['OS_CYL']);
		// 		$("#os-axis").val(result['OS_AXIS']);
		// 		$("#os-add").val(result['OS_ADD']);
		// 		$("#os-pd").val(result['OS_PD']);

		// 		$("#loading").hide();
		// 	}
		// });
	}
	$(document).ready(function() {
		$('#file_customer').on('change', function(evt) {
			if (this.files[0].size > 2097152) {
				Swal.fire(
					'File Tidak Sesuai',
					'File Lebih Dari 2MB',
					'error'
				)
				$("#file_customer").val("");
			}
		});
	});
</script>