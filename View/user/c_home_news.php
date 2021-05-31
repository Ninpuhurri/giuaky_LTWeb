<h1>Tin tức</h1>
<?php 
	if ($data == null) {
		?> <h6>Không có tin tức</h6> <?php
	}else{
		foreach ($data as $key => $value) {
			?>
				<div class="templatemo_news_box">
					<h1> <a href="index.php?controller=C_Home&action=newsdetail&tt_id=<?php echo $value['tt_id'] ?>"><?php echo $value['tt_title'] ?></a> </h1>
					<h6>Ngày đăng: <?php echo $value['tt_date'] ?> </h6>
					<p><?php echo $value['tt_des'] ?></p>
				</div>
			<?php
		}
	}
?>