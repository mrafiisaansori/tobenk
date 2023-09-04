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
		if ($data->STATUS == 1) {
			if ($data->LUNAS == 1) { ?>
				<div class="alert alert-primary" role="alert">
					<i class="fas fa-check" style="font-size:12pt"></i> Pembayaran Lunas
				</div>
			<?php } else { ?>
				<div class="alert alert-danger" role="alert">
					<i class="fas fa-atlas" style="font-size:12pt"></i> Pembayaran Belum Lunas
				</div>
			<?php }
		} else {
			?>
			<div class="alert alert-danger" role="alert">
				<i class="mdi mdi-trash-o" style="font-size:12pt"></i> Transaksi Dibatalkan
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
											<th style="">TO-<?php echo sprintf("%06d", $data->ID); ?></th>
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
											<th><?php echo tgl_indo_lengkap($data->TANGGAL) . " (" . $data->JAM . ")"; ?></th>
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
											<th><?php if ($data->ID_METODE_BAYAR == 1) echo "Full Payment";
												else echo "Down Payment"; ?></th>
										</tr>
										<tr>
											<th style="background-color:#f8f9fa"><b>Status Pengerjaan</b></th>
											<th>
												<?php if ($data->STATUS == 1) {
													if ($data->STATUS_PENGERJAAN == 0) echo "<span class='badge badge-secondary' style='font-size:10pt;'>Diproses</span>";
													else if ($data->STATUS_PENGERJAAN == 1) echo "<span class='badge badge-warning' style='font-size:10pt;'>Desain Diupload</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_1) . "</span>";
													else if ($data->STATUS_PENGERJAAN == 2) echo "<span class='badge badge-danger' style='font-size:10pt;'>Revisi Desain</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_2) . "</span>";
													else if ($data->STATUS_PENGERJAAN == 3) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Desain</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_3) . "</span>";
													else if ($data->STATUS_PENGERJAAN == 4) echo "<span class='badge badge-info' style='font-size:10pt;'>Selesai Produksi</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_4) . "</span>";
													else if ($data->STATUS_PENGERJAAN == 5) echo "<span class='badge badge-dark' style='font-size:10pt;'>Diambil</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_5) . "</span>";
												} else {
													echo "<span style='font-size:10pt' class='badge badge-soft-secondary'>Dibatalkan</span>";
												}  ?>
											</th>
										</tr>
										<tr>
											<th style="background-color:#f8f9fa"><b>Keterangan</b></th>
											<th><?php echo $data->KETERANGAN ?></th>
										</tr>
										<tr>
											<th style="background-color:#f8f9fa"><b>File Customer</b></th>
											<th><?php if ($data->FILE_CUSTOMER) echo "<a target='_blank' href='" . site_url('upload/file_customer/' . $data->FILE_CUSTOMER) . "'>" . $data->FILE_CUSTOMER . "</a>";
												else echo "-"; ?></th>
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
						<a href="javascript:void(0)" onclick="modalTambah()" class="btn btn-block btn-primary mb-3">Tambah</a>
						<table class="table table-bordered" style="font-size:10pt">
							<tr style="background-color:#f8f9fa">
								<td style="font-weight:bold;" align="center">No</td>
								<td style="font-weight:bold;" align="center">Produk</td>
								<td style="font-weight:bold;" align="center">Qty</td>
								<td style="font-weight:bold;" align="center">Harga</td>
								<td style="font-weight:bold;" align="center">Total</td>
								<td style="font-weight:bold;" align="center" width="160">Action</td>
							</tr>
							<?php
							$tot = 0;
							$no = 1;
							if ($produk->num_rows() > 0) {
								foreach ($produk->result() as $dat) {
							?>
								<?php 
									$edit=$this->db->get_where("t_detail_penjualan_edit",["ID_DETAIL_TRANSAKSI_PENJUALAN"=>$dat->ID,"STATUS"=>0]); 
								?>
								<tr <?php if($edit->num_rows()>0) { if($edit->row()->ACTION=="HAPUS") echo "bgcolor='#ffb7b7'"; else echo "bgcolor='#aed6fe'"; } ?>>
									<td><?php echo $no++; ?></td>
									<td>
										<B><?php echo $dat->NAMA_PRODUK; ?> (<?php echo $dat->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $dat->KETERANGAN; ?></span>
										
									</td>
									<td align="center"><?php echo $dat->QTY; ?></td>
									<td align="right"><?php echo formatRupiah($dat->HARGA_JUAL); ?></td>
									<td align="right"><?php echo formatRupiah($dat->QTY * $dat->HARGA_JUAL); $tot += $dat->QTY * $dat->HARGA_JUAL; ?></td>
									<td align="center">
										<?php if($edit->num_rows()==0){ ?>
										<a href="javascript:void(0)" onclick="modalEdit(<?php echo $dat->ID; ?>)" class="btn btn-primary mr-1"><i class="mdi mdi-pencil"></i></a>
										<a href="<?php echo site_url('kasir/hapusRequest/'.base64_encode_fix($dat->ID)); ?>" onclick="return confirm('Yakin menghapus data?')" class="btn btn-danger mr-1"><i class="mdi mdi-trash-can"></i></a>
										<?php } else { echo "<a href='javascript:void(0)' onclick='modalRequest(".$edit->row()->ID.")'>Request Perubahan Data Terkirim</a>"; } ?>
									</td>
								</tr>
							<?php
								}
							}
							$tambahan = $this->db->get_where("view_detail_penjualan_edit",["ACTION"=>"TAMBAH","ID_TRANSAKSI_PENJUALAN"=>$data->ID,"STATUS"=>0]);
							if ($tambahan->num_rows() > 0) {
								foreach ($tambahan->result() as $tambah) {
							?>
								<tr bgcolor="#d4fff0">
									<td><?php echo $no++; ?></td>
									<td>
										<B><?php echo $tambah->NAMA; ?> (<?php echo $tambah->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $tambah->KETERANGAN; ?></span>
									</td>
									<td align="center"><?php echo $tambah->QTY; ?></td>
									<td align="right"><?php echo formatRupiah($tambah->HARGA_JUAL); ?></td>
									<td align="right"><?php echo formatRupiah($tambah->QTY * $tambah->HARGA_JUAL); $tot += $tambah->QTY * $tambah->HARGA_JUAL; ?></td>
									<td align="center">
										<?php echo "<a href='javascript:void(0)' onclick='modalRequest(".$tambah->ID.")'>Request Penambahan Data Terkirim</a>"; ?>
									</td>
								</tr>
							<?php
								}
							}
							?>
							<tfoot>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;">Grand Total</td>
									<td align="right"><?php echo formatRupiah($tot); ?></td>
									<td rowspan=5 style="background-color:lightgrey"></td>
								</tr>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;">Diskon</td>
									<td align="right"><?php echo formatRupiah($data->DISKON); ?></td>
								</tr>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;">Tagihan</td>
									<td align="right"><?php echo formatRupiah($tot - $data->DISKON);
														$hd = $tot - $data->DISKON; ?></td>
								</tr>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;">Dibayar</td>
									<td align="right"><?php echo formatRupiah($data->BAYAR); ?></td>
								</tr>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;"><?php $tsemua = $data->BAYAR - $hd;
																							$notif = "";
																							if ($hd<$data->BAYAR) {
																								echo "Kembalian";
																							} else {
																								echo "Kurang Bayar";
																								$notif = " sisa pelunasannya " . formatRupiah($tsemua);
																							} ?></td>
									<td align="right"><?php echo formatRupiah(abs($tsemua)); ?></td>
								</tr>
							</tfoot>
						</table>
						<?php if ($data->STATUS_PENGERJAAN == 4) { ?>
							<a style="width:100%" class="btn btn-primary" href="https://wa.me/<?php echo $data->NO_TELP; ?>?text=Halo kak, orderan nomor *<?php echo sprintf("%06d", $data->ID); ?>* Sudah bisa diambil ya<?php echo $notif; ?>, terima kasih" target="_blank"><i class="mdi mdi-whatsapp mr-1"></i>Kirim WhatsApp Ke Customer</a>
						<?php } ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<div class="modal fade" id="modalRevisi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?= base_url('kasir/simpanRevisiDesain/' . base64_encode_fix($data->ID)) ?>" enctype="multipart/form-data" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Revisi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-row mb-2">
							<div class="col-md-3">
								<label for="">Keterangan</label>
							</div>
							<div class="col-md-9">
								<textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-3">
								<label for="">File Dari Customer</label>
							</div>
							<div class="col-md-9">
								<input type="file" name="file_customer" id="file_customer" class="form-control" accept="image/*">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?= base_url('kasir/simpanEdit/' . base64_encode_fix($data->ID)) ?>" enctype="multipart/form-data" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-row mb-2">
							<div class="col-md-3">
								<label for="">Produk</label>
							</div>
							<div class="col-md-9">
								<select name="produk" id="produk" class="selectize">
									<?php
									$produk=$this->db->get("view_produk_detail");
									if($produk->num_rows()>0){
										foreach ($produk->result() as $key) {
											if($key->TANPA_STOK==1){
												$tampil=true;
											}
											else{
												if($key->STOK>0){
													$tampil=true;
												}
												else{
													$tampil=false;
												}
											}
											if($tampil){
											?>
											<option value='<?php echo $key->ID; ?>'><?php echo $key->NAMA." (".$key->UKURAN.")"; ?></option>
											<?php
											}
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-row mb-2">
							<div class="col-md-3">
								<label for="">Qty</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="qty" id="qty" class="form-control">
								<input type="hidden" name="id" id="id" class="form-control">
								<input type="hidden" name="id_transaksi" id="id_transaksi" class="form-control">
								
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="<?= base_url('kasir/simpanTambah/' . base64_encode_fix($data->ID)) ?>" enctype="multipart/form-data" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-row mb-2">
							<div class="col-md-3">
								<label for="">Produk</label>
							</div>
							<div class="col-md-9">
								<select name="produk" id="produk" class="selectize">
									<?php
									$produk=$this->db->get("view_produk_detail");
									if($produk->num_rows()>0){
										foreach ($produk->result() as $key) {
											if($key->TANPA_STOK==1){
												$tampil=true;
											}
											else{
												if($key->STOK>0){
													$tampil=true;
												}
												else{
													$tampil=false;
												}
											}
											if($tampil){
											?>
											<option value='<?php echo $key->ID; ?>'><?php echo $key->NAMA." (".$key->UKURAN.")"; ?></option>
											<?php
											}
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-row mb-2">
							<div class="col-md-3">
								<label for="">Qty</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="qty" id="qty" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalReq" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Request Edit Produk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-row mb-2">
							<div class="col-md-3">
								<label for="">Request</label>
							</div>
							<div class="col-md-9">
								<div id="req_request"></div>
							</div>
						</div>
						<div class="form-row mb-2">
							<div class="col-md-3">
								<label for="">Produk</label>
							</div>
							<div class="col-md-9">
								<div id="req_produk"></div>
							</div>
						</div>
						<div class="form-row mb-2">
							<div class="col-md-3">
								<label for="">Qty</label>
							</div>
							<div class="col-md-9">
								<div id="req_qty"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<span id="batalkan"></span>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
		</div>
	</div>
</div>

<script>
	$('#exampleModal').on('show.bs.modal', event => {
		var button = $(event.relatedTarget);
		var modal = $(this);
		// Use above variables to manipulate the DOM

	});
</script>

<div class="modal fade" id="modalHistoriRevisi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
					window.setTimeout(function() {
						window.location.reload();
					}, 5000);

				}
			});
		}
	}
	let waitModal = 0;
	$("#btnHistoriRevisi").click(function() {
		if (waitModal == 1) return;
		waitModal = 1;
		$(this).html('Harap tunggu....');
		$.ajax({
			type: "post",
			url: "<?= base_url('kasir/modalHistoriRevisi/' . base64_encode_fix($data->ID)) ?>",
			cache: false,
			success: function(msg) {
				waitModal = 0;
				$("#btnHistoriRevisi").html('Histori Revisi');
				$("#modalHistoriRevisi").html(msg);
				$("#modalHistoriRevisi").modal("show");
			}
		})
	});
	function modalEdit(id){
		$.ajax({
			type: "post",
			url: "<?= base_url('kasir/modalEditProduk') ?>",
			data: "id="+id,
			cache: false,
			dataType : "json",
			success: function(msg) {
				//$("#produk").val(msg["ID_PRODUK_DETAIL"]);
				$('.selectize')[0].selectize.setValue(msg["ID_PRODUK_DETAIL"]);
				$("#qty").val(msg["QTY"]);
				$("#id").val(msg["ID"]);
				$("#id_transaksi").val(msg["ID_TRANSAKSI_PENJUALAN"]);
				$("#modalEdit").modal("show");
			}
		})
	}
	function modalTambah(){
		$("#modalTambah").modal("show");
	}
	function modalRequest(id){
		$.ajax({
			type: "post",
			url: "<?= base_url('kasir/modalEditReq') ?>",
			data: "id="+id,
			cache: false,
			dataType : "json",
			success: function(msg) {
				$("#req_produk").html(msg["NAMA"]+" ("+msg["UKURAN"]+")");
				$("#req_qty").html(msg["QTY"]);
				$("#req_request").html(msg["ACTION"]);
				$("#batalkan").html('<a class="btn btn-danger" href="javascript:void(0)" onclick="batalkanRequest('+msg["ID"]+')">Batalkan</a>');
				$("#modalReq").modal("show");
			}
		})
	}
	function batalkanRequest(id){
		$.ajax({
			type: "post",
			url: "<?= base_url('kasir/batalkanRequest') ?>",
			data: "id="+id,
			cache: false,
			success: function(msg) {
				Swal.fire({
					title: 'Berhasil',
					text: "Request Telah Dibatalkan",
					type: 'success'
				}).then((result) => {
					location.reload();
				});
			}
		})
	}
</script>