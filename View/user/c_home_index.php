<h1>Trang chủ</h1>
<?php
    if(isset($data)){
        foreach($data as $k=>$v)
        {
            ?>
            <div class="templatemo_product_box">
                <h1><?php echo $v['sp_name'] . " - " .$v['rarity_name'] ?></span></h1>
                <img class='book' src="<?php echo $v['sp_img'] ?>" alt="image" />
                <div class="product_info">
                    <h4> <?php echo $v['sp_id'] ?> </h4>
                    <h3><?php echo number_format($v['sp_price']) ?> VND</h3>
                    <div class="buy_now_button"><a href="subpage.html">Buy Now</a></div>
                    <div class="detail_button"><a href="index.php?controller=C_Home&action=detail&sp_id=<?php echo $v['sp_id'] ?>&rarity_id=<?php echo $v['rarity_id']?>">Detail</a></div>
                </div>
                <div class="cleaner">&nbsp;</div>
            </div>
            <?php
            if ($k %2==0)
                echo '<div class="cleaner_with_width">&nbsp;</div>';
            else echo '<div class="cleaner_with_height">&nbsp;</div>';
        }      
    }else{
        ?>
            <p>Không có kết quả tìm kiếm</p>
        <?php
    }
?>