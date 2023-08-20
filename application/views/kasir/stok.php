<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Data Stok</h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Data Stok Barang</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
                    <div class="dropdown">
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Daftar Produk</h4>
                        <table id="tableAjax" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Ukuran</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga Jual</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#tableAjax").dataTable({
            responsive: true,
            "iDisplayLength": 10, 
            "aLengthMenu": [10,25,50,100],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo base_url('kasir/getTabelJsonProduk')?>" , 
            "sPaginationType": "full_numbers"
        });
    })
        
</script>