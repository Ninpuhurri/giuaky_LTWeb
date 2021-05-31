<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yugioh Shop</title>
<meta name="keywords" content="Book Store Template, Free CSS Template, CSS Website Layout, CSS, HTML" />
<meta name="description" content="Book Store Template, Free CSS Template, Download CSS Website" />
<link href="public/css/templatemo_style.css" rel="stylesheet" type="text/css" />
<style>
    div.templatemo_product_box img.book {
        width:100px;
        height:120px;
    }
</style>
</head>
<body>
<!--  Free CSS Templates from www.templatemo.com -->
<div id="templatemo_container">
	<div id="templatemo_menu">
    	<ul>
            <li><a href="index.php">Home</a></li>
            <!-- <li><a href="">Books</a></li>             -->
            <li><a href="index.php?controller=C_Home&action=news">News</a></li>  
            <li><a href="index.php?controller=C_Home&action=contact">Contact</a></li>
            <?php if($_SESSION['status_login']==true):?>
                <li><a href="index.php?controller=C_Home&action=logout">Đăng xuất khỏi <?php echo $_SESSION['user_id']; ?> </a></li>
            <?php endif ?>
            <?php if($_SESSION['status_login']==false):?>
                <li><a href="index.php?controller=C_Home&action=loadlogin">Đăng nhập</a></li>
            <?php endif ?>
    	</ul>
        <form style="float: right;" method="post" action="index.php?controller=C_Home&action=search&keywords">

            <input type="text" name="keywords" placeholder="Nhập từ khóa" value="">
            <button type="submit">Tìm kiếm</button>
        </form>
        
    </div> <!-- end of menu -->
    
    <div id="templatemo_header"></div> <!-- end of header -->
    

    <div id="templatemo_content">
        <div id="templatemo_content_left">
        	<div class="templatemo_content_left_section">
            	<h1>Set sản phẩm</h1>
                <ul>
                 <?php 
                    foreach($dataSet as $row)
                    {
                        ?>
                         <li><a href="index.php?controller=C_Home&action=filter&set_id=<?php echo $row['set_id'] ?>"><?php echo $row['set_name'] ?>a</a></li>
                        <?php
                    }
                 ?>
                </ul>
            </div>

			<div class="templatemo_content_left_section">
            	<h1>Loại Rarity</h1>
                <ul>
                    <?php foreach ($dataR as $key => $value):?>
                        <li><a href="index.php?controller=C_Home&action=filter&rarity_id=<?php echo $value['rarity_id'] ?>"><?php echo $value['rarity_name'] ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
            <?php include $subview; ?>
            <a href="subpage.html"><img src="public/image/templatemo_ads.jpg" alt="ads" /></a>
        </div> <!-- end of content right -->
    
    	<div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->

    <div id="templatemo_footer">
	   <a href="subpage.html">Home</a> | <a href="subpage.html">Search</a> | <a href="subpage.html">Books</a> | <a href="#">New Releases</a> | <a href="#">FAQs</a> | <a href="#">Contact Us</a><br/>
        Copyright © 2024 <a href="#"><strong>Your Company Name</strong></a> | Designed by <a href="http://www.templatemo.com" target="_parent" title="free css templates">Free CSS Templates</a>	
    </div> 
    <!-- end of footer -->
<!--  Free CSS Template www.templatemo.com -->
</div> <!-- end of container -->
</body>
</html>