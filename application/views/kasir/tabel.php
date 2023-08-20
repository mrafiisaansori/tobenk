<?php 
if($this->cart->contents()):
foreach ($this->cart->contents() as $items): 
    $prod=$this->db->get_where("m_produk",["ID"=>$items['id']]);
    ?>
    <tr>
    <td>
        <?php echo base64_decode_fix($items['name']); ?> (<?php echo $prod->row()->UKURAN; ?>)<br><p style="font-size:9pt"><?php echo $prod->row()->KETERANGAN; ?></p><b><?php echo $this->cart->format_number($items['price']); ?></b>
    </td>
    <td width="150px">
        <!-- <input id="demo3_22" type="text" value="33" name="demo3_22"> -->
        <input style="text-align:center;" type="number" pattern="[0-9]*" class="tc" name="qty" id="qty<?php echo $items['id'] ?>" value="<?php echo $items['qty']; ?>" onchange="gantiqty(<?php echo $items['id'] ?>,'<?php echo $items["rowid"] ?>');">
    </td>
    <!-- <td style="vertical-align: middle;"><a href="javascript:void(0)" onclick="batal('<?php //echo $items['rowid'] ?>')" class="btn btn-danger"><i class="  mdi mdi-trash-can  "></i></a></td> -->
    </tr>
<?php endforeach; ?>
<?php 
else:
	echo "<tr><td colspan='4' align='center'>Data Kosong</td></tr>";
endif; ?>
<script>
    $(".tc").TouchSpin({
        initval: 40,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });
</script>