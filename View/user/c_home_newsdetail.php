<?php 
	if ($data == null) {
		?> <h6>Không có tin tức</h6> <?php
	}else{
		?>
			<h1>Tin tức: <?php echo $data['tt_title'] ?> </h1>
			<p>Ngày đăng: <?php echo $data['tt_date'] ?> </p>
			<h6><?php echo $data['tt_des'] ?></h6>
			<h6><?php echo $data['tt_content'] ?></h6>
		<?php
	}
?>