
<div class="page-title-box"> 
    <div class="container-fluid">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h4 class="page-title mb-1">Transaksi Keuangan</h4>

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
                        <h4>Transaksi Keuangan</h4><br>
                        <form id="iniForm" action="<?php echo base_url('admin/detail-transaksi-keuangan.html')?>" method="post">
                            <div class="form-row">
                                <label class="col-md-2">Tanggal</label>
                                <div class="col-md-6">
                                    <input type="text" name="tgl" data-language="en" class="datepicker2 form-control" readonly>
                                </div>
                                <div class="col-md-2">
                                <input type="submit" value="Lihat" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>