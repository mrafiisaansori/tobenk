
<div class="page-title-box"> 
    <div class="container-fluid">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h4 class="page-title mb-1">Pembatalan Penjualan Barang</h4>

                <ol class="breadcrumb m-0">

                <li class="breadcrumb-item active"></li>

                </ol>

            </div>


        </div>

    </div>

</div>

                    <!-- end page title end breadcrumb -->



<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Pembatalan Penjualan Barang</h4><br>
                        <form id="iniForm" action="<?php echo base_url('admin/lihatLaporanPenjualanHapus')?>" method="post">

                            <div class="form-row mb-2" style="display:none;">
                                <label class="col-md-2">Kasir</label>
                                <div class="col-md-10">
                                    <select name="kasir" id="" class="form-control">
                                        <option value="all">Semua</option>
                                        <!-- <?php //if($kasir){?>
                                            <?php// foreach($kasir as $k){?>
                                                <option value="<?php //echo $k->ID ?>"><?php //echo $k->NAMA?></option>
                                            <?php //} ?>
                                        <?php //} ?> -->
                                    </select>
                                </div>
                            </div><br>
                            <div class="form-row">
                                <label class="col-md-2">Tanggal</label>
                                <div class="col-md-4">
                                    <input type="text" name="tgl_awal" data-language="en" class="datepicker2 form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-1"><center>s/d</center> </div>
                                <div class="col-md-4">
                                    <input type="text" name="tgl_akhir" data-language="en" class="datepicker2 form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <input type="submit" value="Lihat" class="btn btn-primary" style="float:right;">
                                <div class="col-md-2">
                                    <img src="<?php echo site_url(); ?>/theme/loader.gif" width="40px" style="display: none;" id="loading">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="filter-content"></div>
    </div>
</div><br>
<script>
    $(document).ready(function(){
        $("#iniForm").submit(function(event){
            $("#loading").show();
            $.ajax({
                type: $("#iniForm").attr('method'),
                url: $("#iniForm").attr('action'),
                data: $("#iniForm").serialize(),
                cache :false,
                success :function(msg){
                    $("#loading").hide();
                    $("#filter-content").html(msg);
                },error: function(){
                    alert('error');
                }
            })
            event.preventDefault();
        });
    });
</script>