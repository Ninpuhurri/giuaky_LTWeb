<h1>Cập nhật sản phẩm</h1>

<form id="target" action="index.php?controller=C_Admin&action=update_Product" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td> 
				<h6>Mã sản phẩm:</h6> 
			</td>
			<td> 
				<input readonly id="sp_id" type="text" placeholder="Mã sản phẩm" name="sp_id" value="<?php echo $data['sp_id'] ?>">
				<span id="sp_ids"></span>
			</td>
		</tr>
		<tr>
			<td> 
				<h6>Tên sản phẩm:</h6> 
			</td>
			<td> 
				<input id="sp_name" type="text" placeholder="Tên sản phẩm" name="sp_name" value="<?php echo $data['sp_name'] ?>">
				<span id="sp_names"></span>
			</td>
		</tr>
		<tr>
			<td> 
				<h6>Mô tả sản phẩm:</h6> 
			</td>
			<td>
				<textarea placeholder="Mô tả sản phẩm" rows="5" cols="70" style="float: right;" name="sp_des"><?php echo $data['sp_des'] ?></textarea>
			</td>
		</tr>
		<tr>
			<td><h6>Hình ảnh sản phẩm:</h6></td>
			<td><input type="file" name="sp_img" id="sp_img"> <br> <span id="sp_imgs"></span> </td>
		</tr>
		<tr><img src="<?php echo $data['sp_img'] ?>" style="height: 350px !important;"></tr>
		<tr>
			<td> <h6>Rarity sản phẩm:</h6> </td>
			<td> 
				<select name="rarity_id">
					<option value="<?php echo $data['rarity_id'] ?>">
						<?php echo $data['rarity_name'] ?>
					</option>
				</select> 
			</td>
		</tr>
		<tr>
			<td> <h6>Set sản phẩm:</h6> </td>
			<td> 
				<select name="set_id">
					<?php 
						foreach ($dataS as $key => $value) {
						    ?>
						    <option value="<?php echo $value['set_id'] ?>"
						    	<?php if($value['set_id'] == $data['set_id']): ?>
						    		selected
						    	<?php endif ?>
						    >
						    	<?php echo $value['set_name'] ?>
						    </option>
						    <?php
						}
					?>
				</select> 
			</td>
		</tr>
		<tr>
			<td> <h6>Số lượng sản phẩm:</h6> </td>
			<td> 
				<input type="text" placeholder="Số lượng sản phẩm" name="sp_quantity" id="sp_quantity" value="<?php echo $data['sp_quantity'] ?>">
				<span id="sp_quantitys"></span>
			</td>
		</tr>
		<tr>
			<td> <h6>Giá sản phẩm:</h6> </td>
			<td> 
				<input type="text" placeholder="Giá sản phẩm" name="sp_price" id="sp_price" value="<?php echo $data['sp_price'] ?>">
				<span id="sp_prices"></span>
			</td>
		</tr>
	</table>
	<input type="submit" style="float: right;" value="Cập nhật sản phẩm" >
</form>

<script>
$( "form" ).submit(function( event ) {
	if ( $( "#sp_id" ).first().val() == "") {
		$( "#sp_ids" ).text( "Mã sản phẩm không hợp lệ!" ).show().fadeOut(2000);
		event.preventDefault();
	}
	if ( $( "#sp_name" ).first().val() == "") {
		$( "#sp_names" ).text( "Tên sản phẩm không hợp lệ!" ).show().fadeOut(2000);
		event.preventDefault();
	}
	if ($("#sp_img" ).val() != '') {
		var img_formats = ['jpg', 'png', 'gif', 'bmp', 'jfif' ,'jpeg'];
		if ($.inArray($("#sp_img" ).val().split('.').pop().toLowerCase(), img_formats) == -1) {
			$( "#sp_imgs" ).text( "Chỉ chấp nhận các định dạng: "+img_formats.join(', ')).show().fadeOut(5000);
            // alert("Only formats are allowed : "+img_formats.join(', '));
            event.preventDefault();
        }
	}
	if ($( "#sp_quantity" ).first().val() == "" || !$.isNumeric($( "#sp_quantity" ).first().val())) {
		$( "#sp_quantitys" ).text( "Số lượng không hợp lệ!" ).show().fadeOut(2000);
		event.preventDefault();
	}
	if ($( "#sp_price" ).first().val() == "" || !$.isNumeric($( "#sp_price" ).first().val())) {
		$( "#sp_prices" ).text( "Giá không hợp lệ!" ).show().fadeOut(2000);
		event.preventDefault();
	}
});
</script>