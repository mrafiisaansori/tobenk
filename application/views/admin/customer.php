<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Data Customer</h4>
                <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Data Customer</li>
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
                        <table id="example" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Total Transaksi</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                $customer = $this->db->get_where("m_customer",["STATUS"=>1]);
                                if($customer->num_rows()>0){
                                    foreach ($customer->result() as $key) {
                                        $transaksi=$this->db->get_where("t_penjualan",["ID_CUSTOMER"=>$key->ID]);
                                        $warna="";
                                        $delete="";
                                        if($key->STATUS==0){
                                            $warna="style='background-color:#ae4646;color:white;'";
                                            $delete="<span class='badge badge-secondary ml-1' style='font-size:10pt'>Dihapus</span>";
                                        }
                                        ?>
                                        <tr <?php echo $warna; ?>>
                                            <td><?php echo sprintf("%05d", $key->ID); ?></td>
                                            <td><?php echo $key->NAMA.$delete; ?></td>
                                            <td><?php echo $key->ALAMAT; ?></td>
                                            <td><?php echo $key->NO_TELP; ?></td>
                                            <td><?php echo $transaksi->num_rows(); ?></td>
                                            <td>
                                                <?php echo '<a href="'.site_url("admin/detailCustomer/".base64_encode_fix($key->ID)).'" class="btn btn-primary mr-1"><i class="mdi mdi-file mr-1"></i>Lihat</a>'; ?>
                                                <a href="<?php echo site_url('admin/hapusCustomer/'.base64_encode_fix($key->ID)); ?>" onclick="return confirm('Yakin menghapus data customer ini?')" class="btn btn-danger"><i class="mdi mdi-trash-can mr-1"> </i> Hapus</a>
                                            
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        
    </div>
</div>
<script>
    // $(document).ready(function(){
    //     $("#tableAjax").dataTable({
    //         responsive: true,
    //         "iDisplayLength": 10, 
    //         "aLengthMenu": [10,25,50,100],
    //         "bProcessing": true,
    //         "bServerSide": true,
    //         "sAjaxSource": "<?php //echo base_url('admin/getTabelJsonCustomer')?>" , 
    //         "sPaginationType": "full_numbers"
    //     });
    // })
    $('#example').DataTable({
        order: [[4, 'desc']],
    });
</script>