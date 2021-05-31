<?php // echo "Sinh vien so: ". rand(1, 80); exit ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yugioh Shop Admin</title>
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
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<div id="templatemo_container">

    <div id="templatemo_header"></div> <!-- end of header -->

    <div id="templatemo_content">
        <div id="templatemo_content_left">
        	<div class="templatemo_content_left_section">
            	<h1>Quản lý sản phẩm</h1>
                <ul>
                    <li><a href="index.php?controller=C_Admin&action=addProduct">Thêm sản phẩm</a></li>
                    <li><a href="index.php?controller=C_Admin&action=index">Danh sách sản phẩm</a></li>
                </ul>
            </div>
            <div class="templatemo_content_left_section">
                <h1>Quản lý Set sản phẩm</h1>
                <ul>
                    <li><a href="#">Thêm Set sản phẩm</a></li>
                    <li><a href="#">Danh sách Set sản phẩm</a></li>
                </ul>
            </div>
			<div class="templatemo_content_left_section">
                <h1>Quản lý đơn hàng</h1>
                <ul>
                    <li><a href="#">Đơn chưa xác nhận</a></li>
                    <li><a href="#">Đơn đang chuyển</a></li>
                    <li><a href="#">Đơn hoàn thành</a></li>
                    <li><a href="#">Đơn bị hủy</a></li>
                </ul>
            </div>

            <div class="templatemo_content_left_section">
                <h1>Quản lý tin tức</h1>
                <ul>
                    <li><a href="#">Thêm tin tức</a></li>
                    <li><a href="#">Danh sách tin tức</a></li>
                </ul>
            </div>
            <div class="templatemo_content_left_section">
                <h1><a href="index.php?controller=C_Home&action=logout">Đăng xuất khỏi <?php echo $_SESSION['user_id']; ?> </a></h1>
            </div>
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
            <?php 
                include $subview;
            ?>
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