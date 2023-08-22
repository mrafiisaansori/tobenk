<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo base_url('admin/selesaikanPembelian/' . $id_pembelian) ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selesaikan Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td width="100px" align="left">No Nota</td>
                            <td width="50px" align="center">:</td>
                            <td width="" align="left"> <?php echo $pembelian->NO_NOTA; ?></td>
                        </tr>
                        <tr>
                            <td align="left">Tanggal</td>
                            <td align="center">:</td>
                            <td align="left"> <?php echo tgl_indo_lengkap($pembelian->TANGGAL); ?></td>
                        </tr>
                    </table><br>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Produk</td>
                                <td>Qty</td>
                                <td>Harga Beli Baru</td>
                                <td>Harga Beli Lama</td>
                                <td>Harga Beli Disarankan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($detailPembelian) { ?>
                                <?php $seq_num = 1; ?>
                                <?php foreach ($detailPembelian as $dp) { ?>
                                    <tr>
                                        <td><?php echo $seq_num; ?></td>
                                        <td><?php echo $dp->NAMA_PRODUK; ?></td>
                                        <td><?php echo $dp->QTY; ?></td>
                                        <td><?php echo formatRupiah($dp->HARGA_BELI); ?></td><?php $nominalBaru = $dp->QTY * $dp->HARGA_BELI; ?>
                                        <?php $produkDetail = $this->Admin_model->getProdukDetailById($dp->ID_PRODUK_DETAIL); ?>
                                        <td><?php echo formatRupiah($produkDetail->HARGA_BELI); ?></td><?php $nominalLama = $produkDetail->STOK * $produkDetail->HARGA_BELI; ?>
                                        <?php $harga_saran = ($nominalBaru + $nominalLama) / ($dp->QTY + $produkDetail->STOK); ?>
                                        <td><input type="text" class="form-control" name="harga_produk_<?php echo $dp->ID_DETAIL_PEMBELIAN; ?>" value="<?php echo (int)$harga_saran ?>" required></td>
                                    </tr>
                                    <?php $seq_num++; ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="alert alert-warning" role="alert">
                        Note : Setelah klik simpan maka harga beli produk otomatis berubah sesuai harga beli disarankan
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" style="color:white" onclick="return confirm('Yakin menyelesaikan Transaksi?')" value="Simpan">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
</script>