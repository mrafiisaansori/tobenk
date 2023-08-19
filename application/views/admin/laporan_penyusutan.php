<div class="page-title-box"> 
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Laporan Penyusutan</h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Laporan Penyusutan</li>
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
			        <div class="card">
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>Filter</b></h6>
			            <div class="card-body">
			                <form action="<?php echo site_url('urgent/dolaporanpenyusutan'); ?>" method="post" id="form-beli">
			               		<div>
		                            <div class="form-group form-group-custom mb-4">
		                            	<h5 class="font-size-14">Tanggal</h5>
		                                <input type="text" class="form-control datepicker2" name="tanggal_awal" data-language="en">
		                            </div>
		                            <div class="form-group form-group-custom mb-1">
		                            	<h5 class="font-size-14">s/d</h5>
		                                <input type="text" class="form-control datepicker2" name="tanggal_akhir" data-language="en">
		                            </div>
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
			        	<h6 class="card-header bg-transparent border-bottom mt-0"><b>Laporan Penyusutan</b></h6>
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