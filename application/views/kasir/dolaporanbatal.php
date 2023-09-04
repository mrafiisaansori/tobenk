 <table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>No</th>
        <th>Customer</th>
        <th>Tanggal</th>
        <th>Transaksi</th>
        <th>Tagihan</th>
        <th>Terbayar</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $total=0;
        $jumlah=0;
        $diskon=0;
        $pendapatan=0;
        $terbayar=0;
        if($data->num_rows()>0)
        {
            foreach ($data->result() as $key) 
            {
                $jumlah++;
                ?>
                <tr>
                    <td>TO-<?php echo sprintf("%06d",$key->ID); ?></td>
                    <td><?php echo "<b>".($key->NAMA_CUSTOMER)."</b><br><span style='font-size:9pt'>".$key->ALAMAT."<br>".$key->NO_TELP."</span>"; ?></td>
                    <td><?php echo "<b>".tgl_indo_lengkap($key->TANGGAL)."</b><br><span style='font-size:9pt'>".$key->JAM."</span>"; ?></td>
                    <td><?php echo $key->JENIS_BAYAR; if($key->ID_METODE_BAYAR==1) echo "<br><span class='badge badge-soft-success'>Full Payment</span>"; else  echo "<br><span class='badge badge-soft-danger'>Down Payment</span>"; ?></td>
                    <?php   $total+=$key->TOTAL; ?>
                    <?php  $diskon+=$key->DISKON; ?>
                    <td style='font-size:10pt'><?php  echo formatRupiah($key->TOTAL-$key->DISKON); $pendapatan+=($key->TOTAL-$key->DISKON); ?></td>
                    <td style='font-size:10pt'><?php if($key->ID_METODE_BAYAR==1) { echo formatRupiah($key->TOTAL-$key->DISKON); $terbayar+=$key->TOTAL-$key->DISKON; }  else  { echo formatRupiah($key->BAYAR); $terbayar+=$key->BAYAR; } ?></td>
                    
                    <td>
                        <a target="_blank" href="<?php echo site_url('kasir/detail/'.base64_encode_fix($key->ID)); ?>" class="btn btn-primary mr-1"><i class="mdi mdi-eye"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
    <br>
</div>
<script type="text/javascript">
    $('#datatable').DataTable({
        responsive: true
    });
    function hapus(id){
        if(confirm("Anda yakin menghapus transaksi ini?")){
			$("#loading").show();
			$.ajax({
				url: "<?php echo site_url('kasir/delete_transaksi'); ?>",
				type: "POST",
				data: "id="+id, 
				success: function(result){
                    if(result=="1"){
                        Swal.fire(
                            'Berhasil',
                            'Transkasi Telah Dibatalkan',
                            'success'
                        );
                    }
                    else if(result=="0"){
                        Swal.fire(
                            'Gagal',
                            'Transkasi Gagal Dibatalkan',
                            'error'
                        );
                    }
                    $("#form-beli").submit();
			    	$("#loading").hide();
			 	}
			});
		}
    }
</script>