<table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:9pt">
                    <thead>
                        <tr style="font-size:11pt!important">
                            <th>No</th>
                            <th>Customer</th>
                            <th>Tanggal</th>
                            <th>Pembayaran</th>
                            <th>Diskon</th>
                            <th width="300">Tagihan</th>
                            <th width="300">Terbayar</th>
                            <th>Status Pengerjaan</th>
                            <th>Status Pembayaran</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $total=0;
                        $jumlah=0;
                        $diskon=0;
                        $pendapatan=0;
                        $terbayar=0;
                        $laba_total=0;
                        $belum_bayar=0;
                        if($data->num_rows()>0)
                        {
                            foreach ($data->result() as $key) 
                            {
                                $jumlah++;
                                ?>
                                <tr>
                                    <td><?php echo sprintf("%06d",$key->ID); ?></td>
                                    <td><?php if($key->ID_CUSTOMER) echo "<b>".($key->NAMA_CUSTOMER)."</b><br><span>".$key->ALAMAT."<br>".$key->NO_TELP."</span>"; else echo "<b>Tidak Terdaftar</b>"; ?></td>
                                    <td><?php echo "<b>".tgl_indo_lengkap($key->TANGGAL)."</b><br><span>".$key->JAM."</span>"; ?></td>
                                    <td ><?php echo $key->JENIS_BAYAR; if($key->ID_METODE_BAYAR==1) echo "<br><span class='badge badge-soft-success' style='font-size:10pt'>Full</span>"; else  echo "<br><span class='badge badge-soft-danger' style='font-size:10pt'>DP</span>"; ?></td>
                                    <?php   $total+=$key->TOTAL; ?>
                                    <?php  $diskon+=$key->DISKON; ?>
                                    <td>
                                        <?php echo formatRupiah($key->DISKON); ?>
                                    </td>
                                    <td ><?php  $pnd=$key->TOTAL;  echo formatRupiah($pnd); $pendapatan+=$pnd;  ?></td>
                                    <td ><?php if($key->ID_METODE_BAYAR==1) { echo formatRupiah($key->BAYAR); $terbayar+=$key->BAYAR; $fa=0; }  else  { echo formatRupiah($key->BAYAR); $terbayar+=$key->BAYAR; $fa=$pnd-$key->BAYAR-$key->DISKON; }  if($fa>0){ $belum_bayar+=$fa; } ?></td>
                                    <td>
                                        <?php
                                       if ($key->STATUS_PENGERJAAN == 0) echo "<span class='badge badge-secondary' style='font-size:10pt;'>Diproses</span>";
                                       else if ($key->STATUS_PENGERJAAN == 1) echo "<span class='badge badge-warning' style='font-size:10pt;'>Desain Diupload</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($key->SP_1) . "</span>";
                                       else if ($key->STATUS_PENGERJAAN == 2) echo "<span class='badge badge-danger' style='font-size:10pt;'>Revisi Desain</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($key->SP_2) . "</span>";
                                       else if ($key->STATUS_PENGERJAAN == 3) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Desain</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($key->SP_3) . "</span>";
                                       else if ($key->STATUS_PENGERJAAN == 4) echo "<span class='badge badge-info' style='font-size:10pt;'>Selesai Produksi</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($key->SP_4) . "</span>";
                                       else if ($key->STATUS_PENGERJAAN == 5) echo "<span class='badge badge-dark' style='font-size:10pt;'>Diambil</span><br><span style='font-size:9pt'>" . tgl_jam_indo_lengkap($key->SP_5) . "</span>";
                                        ?>
                                    </td>
                                    <td ><?php if($key->LUNAS==1) echo "<span class='badge badge-primary' style='font-size:10pt'>Lunas</span>"; else echo "<span class='badge badge-danger' style='font-size:10pt'>Belum Lunas</span><br><span style='font-size:9pt'>Kurang ".formatRupiah($fa)."</span>"; ?></td>
                                    <td>
                                    <a target="_blank" href="<?php echo site_url('kasir/detail/'.base64_encode_fix($key->ID)); ?>" class="btn btn-primary mr-1"><i class="mdi mdi-eye"></i></a>
                                    <?php if ($key->STATUS_PENGERJAAN == 0){ ?><a target="_blank" href="<?php echo site_url('kasir/edit/'.base64_encode_fix($key->ID)); ?>" class="btn btn-success mt-1"><i class="mdi mdi-pencil"></i></a><?php } else { ?><a href="javascript:void(0)" onclick="gabisa()" class="btn btn-secondary mt-1"><i class="mdi mdi-pencil"></i></a><?php } ?>
                                    </td>
                                    
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                <div class="col-xl-3 mt-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <p><?php echo formatRupiah($diskon);?></p>
                                <footer class="blockquote-footer text-white">
                                    Total Diskon
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mt-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <p><?php echo formatRupiah($pendapatan);?></p>
                                <footer class="blockquote-footer text-white">
                                    Total Tagihan
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mt-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <p><?php echo formatRupiah($terbayar);?></p>
                                <footer class="blockquote-footer text-white">
                                    Total Terbayar
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mt-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <p><?php echo formatRupiah($belum_bayar);?></p>
                                <footer class="blockquote-footer text-white">
                                    Total Belum Terbayar
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
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
    function gabisa(){
        Swal.fire(
            'Tidak Dapat Merubah Data',
            'Pesanan sudah masuk di tahapan pengerjaan',
            'error'
        );
    }
</script>