<h1>Chi tiết sản phẩm: <?php echo $data['sp_name'] ?></h1>
<div class="image_panel" style="float: left;">
	<img src="<?php echo $data['sp_img'] ?>" width="200" height="300">

</div>

<div style="float: right;">
	<h5>Cardset: <?php echo $data['sp_id'] ?> </h5>
	<h5>Rarity: <?php echo $data['rarity_id'] ?> </h5>
	<h5>Giá: <?php echo number_format($data['sp_price']) ?> VNĐ</h5>
	<h6>Mô tả: <?php echo $data['sp_des'] ?></h6>
</div>


<div class="cleaner_with_height">&nbsp;</div>
