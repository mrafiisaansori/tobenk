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
			<div class="col-xl-12">
				<div class="card">
					<h6 class="card-header bg-transparent border-bottom mt-0"><b>History Transaksi</b></h6>
					<div class="card-body">
						<div class="row">
							<div class="col-xl-12">
								<table class="table table-bordered" style="font-size:10pt">
									<tbody>
										<tr>
											<th style="background-color:#f8f9fa"><b>No Nota</b></th>
											<th style=""><?php echo sprintf("%06d", $data->ID); ?></th>
                                            <th style="background-color:#f8f9fa"><b>Tanggal Deadline</b></th>
											<th><?php echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?></th>
										</tr>
										<tr>
											<th style="background-color:#f8f9fa"><b>Nama</b></th>
											<th style=""><?php echo $data->NAMA_CUSTOMER ?></th>
                                            <th style="background-color:#f8f9fa"><b>Jenis Bayar</b></th>
											<th><?php echo $data->JENIS_BAYAR ?></th>
										</tr>
										<tr>
											<th style="background-color:#f8f9fa"><b>Alamat</b></th>
											<th style=""><?php echo $data->ALAMAT ?></th>
                                            <th style="background-color:#f8f9fa"><b>Metode Bayar</b></th>
											<th><?php if ($data->ID_METODE_BAYAR == 1) echo "Full Payment";
												else echo "Down Payment"; ?></th>
										</tr>
										<tr>
											<th style="background-color:#f8f9fa"><b>No Telp</b></th>
											<th style=""><?php echo $data->NO_TELP ?></th>
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
											<th style="background-color:#f8f9fa"><b>Tanggal Transaksi</b></th>
											<th><?php echo tgl_indo_lengkap($data->TANGGAL) . " (" . $data->JAM . ")"; ?></th>
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
			<div class="col-xl-12">
				<div class="card">
					<h6 class="card-header bg-transparent border-bottom mt-0"><b>Produk</b></h6>
					<div class="card-body">
						<table class="table table-bordered table-striped" style="font-size:10pt">
                            <tr>
								<td bgcolor="#ff8370" style="font-weight:bold;font-size:12pt" align="center" colspan=5><b>Transaksi Lama</b></td>
								<td bgcolor="#70ff7e" style="font-weight:bold;font-size:12pt" align="center" colspan=7><b>Perubahan Transaksi</b></td>
							</tr>
							<tr>
								<td bgcolor="#ff8370" style="font-weight:bold;" align="center">No</td>
								<td bgcolor="#ff8370" style="font-weight:bold;" align="center">Produk</td>
								<td bgcolor="#ff8370" style="font-weight:bold;" align="center">Qty</td>
								<td bgcolor="#ff8370" style="font-weight:bold;" align="center">Harga</td>
								<td bgcolor="#ff8370" style="font-weight:bold;" align="center">Total</td>
								<td bgcolor="#70ff7e" style="font-weight:bold;" align="center">Produk</td>
								<td bgcolor="#70ff7e" style="font-weight:bold;" align="center">Qty</td>
								<td bgcolor="#70ff7e" style="font-weight:bold;" align="center">Harga</td>
								<td bgcolor="#70ff7e" style="font-weight:bold;" align="center">Total</td>
								<td bgcolor="#70ff7e" style="font-weight:bold;" align="center">Stok Saat Ini</td>
							</tr>
							<?php
							$tot = 0;
                            $tot_edit = 0;
							$no = 1;
							if ($produk->num_rows() > 0) {
								foreach ($produk->result() as $dat) {
                                $edit=$this->db->get_where("view_detail_penjualan_edit",["ID_DETAIL_TRANSAKSI_PENJUALAN"=>$dat->ID,"STATUS"=>0]); 
							?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td>
										<B><?php echo $dat->NAMA_PRODUK; ?> (<?php echo $dat->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $dat->KETERANGAN; ?></span>
									</td>
									<td align="center"><?php echo $dat->QTY; ?></td>
									<td align="right"><?php echo formatRupiah($dat->HARGA_JUAL); ?></td>
									<td align="right"><?php echo formatRupiah($dat->QTY * $dat->HARGA_JUAL); $tot += $dat->QTY * $dat->HARGA_JUAL; ?></td>
									
                                    <?php if($edit->num_rows()>0){
                                        $edit=$edit->row();
                                        ?>
                                        <td>
                                        <B><?php echo $edit->NAMA; ?> (<?php echo $edit->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $edit->KETERANGAN; ?></span><br><?php if($edit->ACTION=="EDIT") echo "<span style='font-size:9pt' class='badge badge-success'>Edit Data</span>"; else echo "<span style='font-size:9pt' class='badge badge-danger'>Hapus Data</span>"; ?>
                                        </td>
                                        <td align="center"><?php echo $edit->QTY; ?></td>
                                        <td align="right"><?php echo formatRupiah($edit->HARGA_JUAL); ?></td>
									    <td align="right"><?php if($edit->ACTION=="HAPUS"){ echo " - "; } echo formatRupiah($edit->QTY * $edit->HARGA_JUAL); 
                                        if($edit->ACTION=="EDIT") $tot_edit += $edit->QTY * $edit->HARGA_JUAL; ?></td>
                                        <td align="center"><?php $stok=$this->db->get_where("view_produk_detail",["ID"=>$edit->ID_PRODUK_DETAIL]); if($stok->num_rows()>0) if($stok->row()->TANPA_STOK==1) echo "Tanpa Stok"; else echo $stok->row()->STOK; ?></td>

                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <td>
                                            <B><?php echo $dat->NAMA_PRODUK; ?> (<?php echo $dat->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $dat->KETERANGAN; ?></span>
                                        </td>
                                        <td align="center"><?php echo $dat->QTY; ?></td>
                                        <td align="right"><?php echo formatRupiah($dat->HARGA_JUAL); ?></td>
                                        <td align="right"><?php echo formatRupiah($dat->QTY * $dat->HARGA_JUAL); $tot_edit += $dat->QTY * $dat->HARGA_JUAL; ?></td>
                                        <td align="center"><?php $stok=$this->db->get_where("view_produk_detail",["ID"=>$dat->ID_PRODUK_DETAIL]); if($stok->num_rows()>0) if($stok->row()->TANPA_STOK==1) echo "Tanpa Stok"; else echo $stok->row()->STOK; ?></td>
                                        <?php
                                    } 
                                    
                                    ?>
								</tr>
							<?php
								}
							}
							$tambahan = $this->db->get_where("view_detail_penjualan_edit",["ACTION"=>"TAMBAH","ID_TRANSAKSI_PENJUALAN"=>$data->ID,"STATUS"=>0]);
							if ($tambahan->num_rows() > 0) {
								foreach ($tambahan->result() as $tambah) {
							?>
								<tr>
									<td colspan=5></td>
									<td>
									<B><?php echo $tambah->NAMA; ?> (<?php echo $tambah->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $tambah->KETERANGAN; ?></span><br><?php echo "<span style='font-size:9pt' class='badge badge-primary'>Tambah Data</span>"; ?>
									</td>
									<td align="center"><?php echo $tambah->QTY; ?></td>
									<td align="right"><?php echo formatRupiah($tambah->HARGA_JUAL); ?></td>
									<td align="right"><?php 
									echo formatRupiah($tambah->QTY * $tambah->HARGA_JUAL); 
									if($tambah->ACTION=="TAMBAH") $tot_edit += $tambah->QTY * $tambah->HARGA_JUAL; ?></td>
								</tr>
							<?php
								}
							}
							?>


								<tr>
									<td colspan="4" align="right" style="font-weight:bold;">Grand Total</td>
									<td align="right"><?php echo formatRupiah($tot); ?></td>
                                    <td colspan="3" align="right" style="font-weight:bold;">Grand Total</td>
									<td align="right"><?php echo formatRupiah($tot_edit); ?></td>
								</tr>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;">Diskon</td>
									<td align="right"><?php echo formatRupiah($data->DISKON); ?></td>
                                    <td colspan="3" align="right" style="font-weight:bold;">Diskon</td>
									<td align="right"><?php echo formatRupiah($data->DISKON); ?></td>
								</tr>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;">Tagihan</td>
									<td align="right"><?php echo formatRupiah($tot - $data->DISKON); $hd = $tot - $data->DISKON; ?></td>
                                    <td colspan="3" align="right" style="font-weight:bold;">Tagihan</td>
									<td align="right"><?php echo formatRupiah($tot_edit - $data->DISKON); $hd_edit = $tot_edit - $data->DISKON; ?></td>
								</tr>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;">Dibayar</td>
									<td align="right"><?php echo formatRupiah($data->BAYAR); ?></td>
                                    <td colspan="3" align="right" style="font-weight:bold;">Dibayar</td>
									<td align="right"><?php echo formatRupiah($data->BAYAR); ?></td>
								</tr>
								<tr>
									<td colspan="4" align="right" style="font-weight:bold;"><?php 
                                        $tsemua = $data->BAYAR - $hd;
                                        $notif = "";
                                        if ($data->ID_METODE_BAYAR == 1) {
                                            echo "Kembalian";
                                        } else {
                                            echo "Kurang Bayar";
                                            $notif = " sisa pelunasannya " . formatRupiah($tsemua);
                                        } ?></td>
									<td align="right"><?php echo formatRupiah(abs($tsemua)); ?></td>

                                    <td colspan="3" align="right" style="font-weight:bold;"><?php 
                                        if ($data->BAYAR>$hd_edit) {
                                            echo "Kembalian";
                                            $tsemua_edit = $data->BAYAR - $hd_edit;
                                            $notes="Perubahan data (Kembalian : ".formatRupiah($tsemua_edit).")";
                                        } else {
                                            echo "Kurang Bayar";
                                            $tsemua_edit = $hd_edit-$data->BAYAR;
                                            $notes="Perubahan data (Kurang Bayar : ".formatRupiah($tsemua_edit).")";
                                        } ?></td>
									<td align="right"><?php echo formatRupiah(abs($tsemua_edit)); ?></td>
								</tr>
						</table>
					</div>
				</div>
                <a href="<?php echo site_url('admin/perubahan.html'); ?>" class="btn btn-danger mb-4">Kembali</a>
                <a href="<?php echo site_url('admin/doPerubahan/'.base64_encode_fix($id).'/'.$data->LUNAS.'/'.base64_encode_fix($notes).'/'.$data->BAYAR); ?>" onclick="return confirm('Yakin setuju dengan perubahan data ini?')" class="btn btn-primary mb-4" style="float:right">Setuju</a>
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