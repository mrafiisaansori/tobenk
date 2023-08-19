<div class="page-title-box"> 
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Transaksi Penjualan</h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Transaksi Penjualan</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                    <img src="<?php echo site_url('theme/loader.gif'); ?>" width="50px" style="display: none;" id="loading">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
			<div class="row">
			    <div class="col-xl-3">
			    	 <div class="col-xl-12">
			        <div class="card">
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>Scan Barcode</b></h6>
			        	<form id="form-barcode" action="<?php echo site_url('kasir/barcode'); ?>" method="post">
			            <div class="card-body">
			                <div>
			                    <div class="form-group form-group-custom mb-4">
			                    	<h5 class="font-size-14">Barcode</h5>
			                        <input type="text" class="form-control" id="barcode" name="barcode" required="" placeholder="Arahkan kursor disini" autofocus="">
			                    </div>
			                </div>
			                <input type="submit" name="" value="submit" style="display: none;">
			            </div>
			            </form>
			        </div>
			    	</div>
			        <div class="col-xl-12">
			        <div class="card">
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>Cari Barang</b></h6>
			            <div class="card-body">
			                <form action="<?php echo site_url('kasir/beli'); ?>" method="post" id="form-beli">
			               		<div>
		                            <div class="form-group form-group-custom mb-4">
		                            	<h5 class="font-size-14">Kata Kunci</h5>
		                                <input type="text" class="form-control" id="caribarang" placeholder="Masukkan kata kunci barang" onkeyup="cari()">
		                            </div>
		                            <div class="form-group form-group-custom mb-1">
		                                <h5 class="font-size-14">Pilih Barang</h5>
		                                <select class="form-control" name="barang" id="produk"></select>
		                            </div>
				                    <div class="mt-4" style="float: right;">
				                        <button class="btn btn-primary waves-effect waves-light" type="submit"><i class=" mdi mdi-cart-arrow-right "></i></button>
				                    </div>
			                	</div>
			                </form>
			            </div>
			        </div>
			    </div>

			    </div>
			    <div class="col-xl-5">
			        <div class="card">
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>Keranjang Belanja</b></h6>
			            <div class="card-body">
			                <table class="table table-striped table-bordered">
			                	<thead>
			                		<th width="120">Barang</th>
			                		<th >Qty</th>
			                		<th >Batal</th>
			                	</thead>
			                	<tbody id="barang">
			                	</tbody>
			                </table>
			            </div>
			        </div>
			    </div>
			    <div class="col-xl-4">
			        <div class="card">
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>Pembayaran</b></h6>
			            <div class="card-body"> 
			                <form action="<?php echo site_url('kasir/bayar') ?>" method="post">
			                <div>
	                            <div class="form-group form-group-custom mb-4">
	                            	<h5 class="font-size-14">Keterangan</h5>
	                                <textarea class="form-control" name="keterangan"></textarea>
	                            </div>
	                            <div class="form-group form-group-custom mb-4">
	                                <h5 class="font-size-14">Metode Pembayaran</h5>
	                                <select class="form-control" name="metode">
	                                	<?php
                                		$jenis = $this->db->query("SELECT * FROM m_jenis_bayar");
                                		if($jenis->num_rows()>0)
                                		{
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
	                            	<h5 class="font-size-14">Diskon</h5>
	                                <input type="text" class="form-control" id="diskon" name="diskon" required="" onblur="total()">
	                            </div>
															<div class="form-group form-group-custom mb-4">
	                            	<h5 class="font-size-14">Total Belanja</h5>
																<a href="javascript:void(0)" class="btn btn-primary btn-block" ><span id='total_belanja'></span></a>
																	<input type="hidden" name="nominal_belanja" id="nominal_belanja">
	                            </div>
	                            <div class="form-group form-group-custom mb-1">
	                            	<h5 class="font-size-14">Bayar</h5>
	                                <input type="text" class="form-control" id="bayar" name="bayar" required="">
	                            </div>
			                    <div class="mt-4" style="float: right;">
			                        <button class="btn btn-primary waves-effect waves-light" type="submit"><i class=" mdi mdi-file-document-box-check-outline "></i>&nbsp;Bayar</button>
			                    </div>
			                </div>
			                </form>
			            </div>
			        </div>
			    </div>
			    
			</div>
	</div>
</div>
<script type="text/javascript">
	tabel();
	function total()
	{
		$.ajax({
			url: "<?php echo site_url('kasir/total'); ?>", 
			type:"post",
			data:"diskon="+$("#diskon").val(),
			success: function(result){
				var fields = result.split('#');
		    	$("#total_belanja").html("<b>"+fields[1]+"</b>");
		    	$("#nominal_belanja").val(fields[0]);
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
	$("#bayar").maskMoney();
	$("#diskon").maskMoney();

</script>