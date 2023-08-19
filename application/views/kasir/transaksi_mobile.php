<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
				<div class="col-md-12" >
						<div class="card fixed-top" style="margin-top:68px;z-index:800!important;">
							<div class="card-body" >
								<ul class="nav nav-tabs nav-justified nav-tabs-custom mb-3" role="tablist">
										<li class="nav-item waves-effect waves-light">
												<a class="nav-link active" id="produk-li" data-toggle="tab" href="javascript:void(0)" role="tab" onclick="ganti(1)">
														<i class="mdi mdi-format-list-bulleted-type mr-1"></i>Produk
												</a>
										</li>
										<li class="nav-item waves-effect waves-light">
												<a class="nav-link" id="belanja-li" data-toggle="tab" href="javascript:void(0)" role="tab" onclick="ganti(2)">
													<span id="isi"><i class="mdi mdi-cart mr-1"></i></span>Belanja
												</a>
										</li>
										<li class="nav-item waves-effect waves-light">
												<a class="nav-link" id="bayar-li" data-toggle="tab" href="javascript:void(0)" role="tab" onclick="ganti(3)">
													<i class="mdi mdi-paypal mr-1"></i>	Bayar
												</a>
										</li>
								</ul>
								<div class="form-group m-0">
									<div class="input-group">
											<input type="hidden" id="kategori_aktif" value="0">
											<input type="text" class="form-control" id="pencarian"  placeholder="Pencarian..." onkeyup="cari_produk()" autofocus>
											<div class="input-group-append">
													<button class="btn btn-primary" type="submit" onclick="cari_produk()"><i class="mdi mdi-magnify"></i></button>
											</div>
									</div>
								</div>
							</div>
							</div>
						</div>
        </div>
        
    </div>
</div>
<div class="page-content-wrapper">
    <div class="container-fluid">
			<div class="row">
					<div class="col-md-12" id="produk">
					<div class="row"  id="produk_show" style="margin-top:120px;">
					</div>
					</div>
					<div class="col-md-12" style="display:none;" id="belanja">
						<div class="card mb-12" style="margin-top:120px;">
								<div class="card-body">
										<table class="table table-striped">
											<tbody id="barang">
											</tbody>
										</table>
								</div>
					</div>
					<div class="card text-white bg-primary">
							<div class="card-body">
									<blockquote class="card-bodyquote mb-0">
											<p><span id="ttl"></span></p>
											<footer class="blockquote-footer text-white">
													Total Belanja
											</footer>
									</blockquote>
							</div>
					</div>
			</div>
			<div class="col-md-12" style="display:none;" id="co">
			<div class="card" style="margin-top:120px;">
			            <div class="card-body"> 
			                <form action="<?php echo site_url('kasir/bayar') ?>" method="post">
			                <div>
															<div class="form-row form-group-custom mb-4">
																<div class="col-10">
	                            	<h5 class="font-size-14">Customer</h5>
	                                <select name="customer" id="customer"  class="selectize" onchange="lama()">
																		<option value="">Pilih Nama - Alamat (No Telp)</option>
																		<?php
																		$cust = $this->db->query("SELECT * FROM m_customer ORDER BY NAMA ASC");
																		if($cust->num_rows()>0){
																			foreach($cust->result() as $cs){
																				echo "<option value='".$cs->ID."'>".$cs->NAMA." - ".$cs->ALAMAT." (".$cs->NO_TELP.")</option>";
																			}
																		}
																		?>
																	</select>
																	</div>
																	<div class="col">
																		<h5 class="font-size-14"></h5>
																		<a data-toggle="modal" data-target="#myModal" class="btn btn-primary mt-3" style="height:37px;width:100%" href="javascript:void(0)"><i class="mdi mdi-plus-thick"></i></a>
																	</div>
	                            </div>
	                            <div class="form-group form-group-custom mb-4" style="display:none">
	                            	<h5 class="font-size-14">Keterangan</h5>
	                                <textarea class="form-control" name="keterangan"></textarea>
	                            </div>
															<div class="form-group form-group-custom mb-4">
																		<table class="table table-striped table-bordered table-responsive">
																			<tr>
																				<td>#</td>
																				<td>OD</td>
																				<td>OS</td>
																			</tr>
																			<tr>
																				<td>SPH</td>
																				<td><input type="text" class="form-control" name="od-sph" id="od-sph"></td>
																				<td><input type="text" class="form-control" name="os-sph" id="os-sph"></td>
																			</tr>
																			<tr>
																				<td>CYL</td>
																				<td><input type="text" class="form-control" name="od-cyl" id="od-cyl"></td>
																				<td><input type="text" class="form-control" name="os-cyl" id="os-cyl"></td>
																			</tr>
																			<tr>
																				<td>AXIS</td>
																				<td><input type="text" class="form-control" name="od-axis" id="od-axis"></td>
																				<td><input type="text" class="form-control" name="os-axis" id="os-axis"></td>
																			</tr>
																			<tr>
																				<td>ADD</td>
																				<td><input type="text" class="form-control" name="od-add" id="od-add"></td>
																				<td><input type="text" class="form-control" name="os-add" id="os-add"></td>
																			</tr>
																			<tr>
																				<td>PD</td>
																				<td><input type="text" class="form-control" name="od-pd" id="od-pd"></td>
																				<td><input type="text" class="form-control" name="os-pd" id="os-pd"></td>
																			</tr>
																		</table>
	                            </div>
	                            <div class="form-group form-group-custom mb-4">
	                                <h5 class="font-size-14">Jenis Pembayaran</h5>
	                                <select class="form-control" name="jenis">
	                                	<?php
																			$jenis = $this->db->query("SELECT * FROM m_jenis_bayar");
																			if ($jenis->num_rows() > 0)
																			{
																					foreach ($jenis->result() as $key)
																					{
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
	                            		<h5 class="font-size-14">Resep</h5>
																	<input type="text" class="form-control" id="resep" name="resep">
	                            </div>
															<div class="form-group form-group-custom mb-4">
	                            		<h5 class="font-size-14">Estimasi Selesai</h5>
																	<input type="text" class="form-control datepicker2" data-language="en" id="estimasi" name="estimasi" readonly>
	                            </div>
															<div class="form-group form-group-custom mb-4">
	                            		<h5 class="font-size-14">Status Pengerjaan</h5>
																	<select class="form-control" name="status">
																		<option value="0">Dalam Proses</option>
																		<option value="1">Selesai</option>
																	</select>
	                            </div>
															<div class="form-group form-group-custom mb-4">
	                            	<h5 class="font-size-14">Diskon</h5>
	                                <input class="form-control" id="diskon" name="diskon" value=0 onblur="total()"  type="number" pattern="[0-9]*">
	                            </div>
															<input type="hidden" name="nominal_belanja" id="nominal_belanja">
	                            <div class="form-group form-group-custom mb-1" id="tampil_bayar" style="display:none;">
	                            	<h5 class="font-size-14">Bayar DP</h5>
	                                <input class="form-control" id="bayar" name="bayar" required=""  type="number" pattern="[0-9]*">
	                            </div>
			                    <div class="mt-4">
			                        <button class="btn btn-primary waves-effect waves-light" style="width:100%;" type="submit"><span id='total_belanja'></span></button>
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
<script type="text/javascript">
	function metode_bayar(){
		if($("#metode").val()==1){
			$('#tampil_bayar').css('display','none');
			total();
		}else if($("#metode").val()==2){
			$("#bayar").val("");
			$('#tampil_bayar').css('display','block');
		}
	}
	tabel();
	produk(0);
	function total()
	{
		$.ajax({
			url: "<?php echo site_url('kasir/total'); ?>", 
			type:"post",
			data:"diskon="+$("#diskon").val(),
			success: function(result){
				var fields = result.split('#');
		    	$("#total_belanja").html("<b>Bayar "+fields[1]+"</b>");
		    	$("#nominal_belanja").val(fields[0]);
		    	$("#ttl").html(fields[1]);
					if(fields[2]>0){
						$("#isi").html('<span class="badge badge-primary mr-1">'+fields[2]+'</span>');
					}
					else{
						$("#isi").html('<i class="mdi mdi-cart mr-1"></i>');
					}
					if($("#metode").val()==1){
		    		$("#bayar").val(fields[3]);
					}
		 	}
		});
	}
	function tabel()
	{
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/tabel'); ?>", 
			success: function(result){
		    	$("#barang").html(result);
		    	total();
		    	$("#loading").hide();
		 	}
		});
	}
	function batal(id)
	{
		if(confirm("Anda yakin menghapus data ini?")){
			$("#loading").show();
			$.ajax({
				url: "<?php echo site_url('kasir/batal'); ?>",
				type: "POST",
				data: "id="+id, 
				success: function(result){
			    	tabel();
			    	$("#loading").hide();
			 	}
			});
		}
	}
	function gantiqty(id,rowid)
	{
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/gantiqty'); ?>",
			type: "POST",
			data: "produk="+id+"&rowid="+rowid+"&qty="+$("#qty"+id).val(), 
			success: function(result){
				if(result==99)
				{
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
	function cari()
	{
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/cari'); ?>",
			type: "POST",
			data: "nama="+$("#caribarang").val(), 
			success: function(result){
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
	       success: function(data)
	       {
	       		$("#barcode").val('');
	       		$("#barcode").focus();
	       	  if(data==1)
	       	  {
	       	  	
	       	  }
	       	  else if(data==0)
	       	  {
	       	  	Swal.fire(
                  'Terjadi Kesalahan',
                  'Stok tidak mencukupi.',
                  'error'
                )
	       	  }
	       	  else
	       	  {
	       	  	Swal.fire(
                  'Terjadi Kesalahan',
                  'Barang tidak ditemukan.',
                  'error'
                )
	       	  }
	       	  tabel();
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

 function beli(id) {
		$("#loading").show();
	    var form = $(this);
	    var url = "<?php echo site_url('kasir/beli') ?>";
	    $.ajax({
	       type: "POST",
	       url: url,
	       data: "barang="+id,
	       success: function(data)
	       {
	       	  if(data==1)
	       	  {
	       	  	
	       	  }
	       	  else if(data==0)
	       	  {
	       	  	Swal.fire(
                  'Terjadi Kesalahan',
                  'Stok tidak mencukupi.',
                  'error'
                )
	       	  }
	       	  else
	       	  {
	       	  	Swal.fire(
                  'Terjadi Kesalahan',
                  'Barang tidak ditemukan.',
                  'error'
                )
	       	  }
	       	  tabel();
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
	}

	//BARU//
	function produk(kategori)
	{
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/showProdukMobile'); ?>", 
			type: "POST",
			data: "id_kategori="+kategori+"&pencarian="+$("#pencarian").val(),
			success: function(result){
				$("#kategori_aktif").val(kategori);
				$("#produk_show").html(result);
				$("#loading").hide();
			}
		});
	}
	function cari_produk()
	{
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/showProdukMobile'); ?>", 
			type: "POST",
			data: "id_kategori="+$("#kategori_aktif").val()+"&pencarian="+$("#pencarian").val(),
			success: function(result){
				$("#produk_show").html(result);
				$("#produk-li").addClass("active");
        $('#belanja-li').removeClass("active");
        $('#bayar-li').removeClass("active");
				ganti(1);
				
				$("#loading").hide();
			}
		});
	}
	function ganti(id){
		if(id==1){
			$("#produk").show();
			$("#belanja").hide();
			$("#co").hide();
		}
		else if(id==2){
			$("#produk").hide();
			$("#belanja").show();
			$("#co").hide();
		}
		else if(id==3){
			$("#produk").hide();
			$("#belanja").hide();
			$("#co").show();
		}
	}

	$("#form-customer").submit(function(e) {
		$("#loading").show();
	    var form = $(this);
	    var url = form.attr('action');
	    $.ajax({
	       type: "POST",
	       url: url,
	       data: form.serialize(),
	       success: function(data)
	       {
					$('#myModal').modal('hide');
						Swal.fire(
							'Berhasil',
							'Data Customer Telah Ditambahkan.',
							'success'
						);

						var $select = $(document.getElementById('customer'));        
						var selectize = $select[0].selectize;
						selectize.addOption({ value: data, text: $("#nama").val()+' - '+$("#alamat").val()+' ('+$("#no_hp").val()+')' });
						selectize.addItem(data);

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

	function lama(){
		$("#loading").show();
		$.ajax({
			url: "<?php echo site_url('kasir/historyTerakhir'); ?>", 
			type: "POST",
			data: "id_customer="+$("#customer").val(),
			dataType:"json",
			success: function(result){
				$("#od-sph").val(null);
				$("#od-cyl").val(null);
				$("#od-axis").val(null);
				$("#od-add").val(null);
				$("#od-pd").val(null);
				$("#os-sph").val(null);
				$("#os-cyl").val(null);
				$("#os-axis").val(null);
				$("#os-add").val(null);
				$("#os-pd").val(null);

				$("#od-sph").val(result['OD_SPH']);
				$("#od-cyl").val(result['OD_CYL']);
				$("#od-axis").val(result['OD_AXIS']);
				$("#od-add").val(result['OD_ADD']);
				$("#od-pd").val(result['OD_PD']);
				$("#os-sph").val(result['OS_SPH']);
				$("#os-cyl").val(result['OS_CYL']);
				$("#os-axis").val(result['OS_AXIS']);
				$("#os-add").val(result['OS_ADD']);
				$("#os-pd").val(result['OS_PD']);
				$("#loading").hide();
			}
		});
	}

</script>
