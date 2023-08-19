<?php 
if($this->cart->contents()):
foreach ($this->cart->contents() as $items): ?>
    <tr>
    <td>
    <div class="row">
        <div class="col-md-8">
        <?php echo base64_decode_fix($items['name']); ?><br><b><?php echo $this->cart->format_number($items['price']); ?></b>
        </div>
        <div class="col-md-4">
        <input type="text" class="form-control filterme" name="qty" id="qty<?php echo $items['id'] ?>" value="<?php echo $items['qty']; ?>" onblur="gantiqty(<?php echo $items['id'] ?>,'<?php echo $items["rowid"] ?>');">
        </div>
    </div>
    </td>
    <td><a href="javascript:void(0)" onclick="batal('<?php echo $items['rowid'] ?>')" class="btn btn-danger"><i class="  mdi mdi-trash-can  "></i></a></td>
    </tr>
<?php endforeach; ?>
<?php 
else:
	echo "<tr><td colspan='4' align='center'>Data Kosong</td></tr>";
endif; ?>
