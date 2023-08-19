<div class="page-title-box"> 
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Laporan Penjualan</h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Laporan Penjualan</li>
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
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>Filter</b></h6>
			            <div class="card-body">
			                <form action="<?php echo site_url('kasir/dolaporan'); ?>" method="post" id="form-beli">
			               		<div>
		                            <div class="form-group form-group-custom mb-4">
		                            	<h5 class="font-size-14">Tanggal</h5>
		                                <input type="text" class="form-control datepicker2" name="tanggal_awal" data-language="en" value="<?php echo date('Y-m-d'); ?>">
		                            </div>
		                            <div class="form-group form-group-custom mb-1">
		                            	<h5 class="font-size-14">s/d</h5>
		                                <input type="text" class="form-control datepicker2" name="tanggal_akhir" data-language="en" value="<?php echo date('Y-m-d'); ?>">
		                            </div>
																<!-- <div class="form-group form-group-custom mt-4">
		                            	<h5 class="font-size-14">Transaksi</h5>
		                                <select name="transaksi" id="" class="form-control">
																			<option value=1>Lunas</option>
																			<option value=0>Belum Lunas</option>
																		</select>
		                            </div> -->
				                    <div class="mt-4" style="float: right;">
				                        <button class="btn btn-primary waves-effect waves-light" type="submit">Lihat</button>
				                    </div>
			                	</div>
			                </form>
			            </div>
			        </div>
			    </div>
			    <div class="col-xl-9">
			        <div class="card">
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>History Transaksi</b></h6>
			            <div class="card-body">
			            	<span id="laporan"></span>
			            </div>
			        </div>
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

</script>