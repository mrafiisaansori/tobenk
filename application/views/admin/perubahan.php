<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">Request Perubahan Transaksi</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                <li class="breadcrumb-item active"></li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-right d-none d-md-block">
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
                        <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Tanggal</th>
                                    <th>Transaksi</th>
                                    <th>Diskon</th>
                                    <th>Tagihan</th>
                                    <th>Terbayar</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $penjualan=$this->db->query("SELECT * FROM view_detail_penjualan_edit WHERE STATUS=0 GROUP BY ID_TRANSAKSI_PENJUALAN");
                                if($penjualan->num_rows()>0)
                                {
                                    foreach ($penjualan->result() as $keys) 
                                    {
                                        $transaksi=$this->db->query("SELECT * FROM view_penjualan WHERE ID='$keys->ID_TRANSAKSI_PENJUALAN'");
                                        if($transaksi->num_rows()>0){
                                            $key=$transaksi->row();
                                            ?>
                                            <tr>
                                                <td><?php echo sprintf("%06d",$key->ID); ?></td>
                                                <td><?php if($key->ID_CUSTOMER) echo "<b>".($key->NAMA_CUSTOMER)."</b><br><span>".$key->ALAMAT."<br>".$key->NO_TELP."</span>"; else echo "<a href='javascript:void()' onclick='detail(".$key->ID.")' style='font-size:11pt'><b>Tidak Terdaftar</b></a>"; ?></td>
                                                <td><?php echo "<b>".tgl_indo_lengkap($key->TANGGAL)."</b><br><span>".$key->JAM."</span>"; ?></td>
                                                <td ><?php echo $key->JENIS_BAYAR; if($key->ID_METODE_BAYAR==1) echo "<br><span class='badge badge-soft-success' style='font-size:10pt'>Full</span>"; else  echo "<br><span class='badge badge-soft-danger' style='font-size:10pt'>DP</span>"; ?></td>
                                                <td>
                                                    <?php echo formatRupiah($key->DISKON); ?>
                                                </td>
                                                <td ><?php  $pnd=$key->TOTAL-$key->DISKON;  echo "<b>".formatRupiah($pnd)."</b>"; if($key->DISKON){ echo "<br><s>".formatRupiah($key->TOTAL)."</s>"; } ?></td>
                                                <td ><?php if($key->ID_METODE_BAYAR==1) { echo formatRupiah($pnd); $fa=0; }  else  { echo formatRupiah($key->BAYAR); $fa=$pnd-$key->BAYAR; } ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('admin/edit/'.base64_encode_fix($key->ID)); ?>" class="btn btn-primary mr-1"><i class="mdi mdi-eye"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
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
    function modalEditPembelian(id){
        $.ajax({
            type: "post",
            url: "<?php echo base_url('admin/modalEditPembelian')?>",
            data: "id="+id,
            dataType: "json",
            success: function(data){
                $("#e_id").val(data['ID_PEMBELIAN']);
                $("#e_no_nota").val(data['NO_NOTA']);
                $("#e_tanggal").val(data['TANGGAL']);
                $("#modalEdit").modal();
            }
        });
    }
    function deleteData(id){
        if(confirm('Yakin menghapus pembelian? Detail pembelian juga akan dihapus.')){
            window.location.href="<?php echo base_url('admin/hapusPembelian/')?>"+id;
        }
    }
</script>