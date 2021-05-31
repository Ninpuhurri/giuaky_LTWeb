<?php 
class C_Admin 
{
    function __construct()
    {
        session_start();
        if(isset($_SESSION['user_id'])){
            $_SESSION['status_login'] = true;
        }else{
            $_SESSION['status_login'] = false;
        }
       $action=getIndex('action', 'index'); 
       if ($action=='index')
            $this->index();
        if ($action=='addProduct')
            $this->addProduct();
        if ($action=='add_Product')
            $this->add_Product();
        if ($action=='delete')
            $this->delete();
        if ($action=='editDetail')
            $this->editDetail();
        if ($action=='update_Product')
            $this->update_Product();
    }

    function index()
    {
        if(isset($_SESSION['user_id'])){
            if ($_SESSION['user_type']==1) {
                $m= new M_SP();
                $data = $m->tatca();
                $dataR = $m->rarity();
                foreach ($data as $key => $value) {
                    foreach ($dataR as $key2 => $value2) {
                        if($value2['rarity_id'] == $data[$key]['rarity_id']){
                            $data[$key]['rarity_name'] = $value2['rarity_name'];
                        }
                    }
                }
               $subview ='View/admin/c_admin_listproduct.php';
               include 'View/index_admin.php';
            }else{
                echo "<script type='text/javascript'>alert('Chưa đăng nhập Admin');</script>";
                echo "<script>location.href='index.php?controller=C_Home&action=index';</script>";
            }
        }else{
            echo "<script type='text/javascript'>alert('Chưa đăng nhập Admin');</script>";
            echo "<script>location.href='index.php?controller=C_Home&action=index';</script>";
        }
        
    }

    function addProduct()
    {
        $m = new M_SP();
        $dataS = $m->SetSP();
        $dataR = $m->rarity();
        $subview ='View/admin/c_admin_addproduct.php';
        include 'View/index_admin.php';
    }
    function add_Product()
    {
        $sp_id= postIndex('sp_id');
        $sp_name= postIndex('sp_name');
        $sp_des= postIndex('sp_des');
        $sp_img= $_FILES['sp_img']['name'];
        $rarity_id= postIndex('rarity_id');
        $set_id= postIndex('set_id');
        $sp_quantity= postIndex('sp_quantity');
        $sp_price= postIndex('sp_price');

        $target_dir = "public/image/product/";
        $imageFileType = strtolower(pathinfo($sp_img,PATHINFO_EXTENSION));

        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $patch = $target_dir.$sp_id.$rarity_id.".".$imageFileType;
        $sp_img = $protocol.$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"])."/".$patch;
        

        $m = new M_SP();
        if ($m->add_Product($sp_id, $sp_name,$sp_des, $sp_img, $rarity_id, $set_id, $sp_quantity, $sp_price)) {
            if (!move_uploaded_file($_FILES["sp_img"]["tmp_name"], $patch)) {
                echo "<script type='text/javascript'>alert('Tải ảnh lên thất bại');</script>";
            }
            echo "<script type='text/javascript'>alert('Thêm sản phẩm thành công');</script>";
            echo "<script>location.href='index.php?controller=C_Admin&action=addProduct';</script>";
        }else{
            echo "<script type='text/javascript'>alert('Sản phẩm đã tồn tại');history.go(-1);</script>";     
        }
    }

    function delete()
    {
        $m = new M_SP();
        if ($m->delete('sp_id','rarity_id')) {
            echo "<script type='text/javascript'>alert('Xóa sản phẩm thành công');</script>";
            echo "<script>location.href='index.php?controller=C_Admin&action=index';</script>";
        }else{
            echo "<script type='text/javascript'>alert('Xóa sản phẩm thất bại');</script>";
            echo "<script>location.href='index.php?controller=C_Admin&action=index';</script>";
        }
    }

    function editDetail()
    {
        $m = new M_SP();
        $data = $m->detail('sp_id','rarity_id');
        $data['rarity_name'] = $m->getRarityName($data['rarity_id']);
        $data['rarity_name'] = $data['rarity_name'][0]['rarity_name'];
        $m = new M_SP();
        $dataS = $m->SetSP();
        $dataR = $m->rarity();
        $subview ='View/admin/c_admin_editproduct.php';
        include 'View/index_admin.php';
    }

    function update_Product()
    {
        $sp_id= postIndex('sp_id');
        $sp_name= postIndex('sp_name');
        $sp_des= postIndex('sp_des');
        $sp_img= $_FILES['sp_img']['name'];
        $rarity_id= postIndex('rarity_id');
        $set_id= postIndex('set_id');
        $sp_quantity= postIndex('sp_quantity');
        $sp_price= postIndex('sp_price');

        $m = new M_SP();
        if ($sp_img=="") {
            $sp_img = $m->getproduct($sp_id,$rarity_id);
            $sp_img = $sp_img['sp_img'];
            if ($m->update_Product($sp_id, $sp_name,$sp_des, $sp_img, $rarity_id, $set_id, $sp_quantity, $sp_price)) {
                echo "<script type='text/javascript'>alert('Cập nhật sản phẩm thành công');</script>";
                // $aaa = "index.php?controller=C_Admin&action=editDetail&sp_id='$sp_id'&rarity_id='$rarity_id'";
                echo "<script>location.href='index.php?controller=C_Admin&action=index';</script>";
            }else{
                echo "<script type='text/javascript'>alert('Cập nhật sản phẩm thất bại');history.go(-1);</script>";     
            }
        }else{
            $sp_img_old = $sp_img;
            $target_dir = "public/image/product/";
            $imageFileType = strtolower(pathinfo($sp_img,PATHINFO_EXTENSION));

            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

            $patch = $target_dir.$sp_id.$rarity_id.".".$imageFileType;
            $sp_img = $protocol.$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"])."/".$patch;
            
            if ($m->update_Product($sp_id, $sp_name,$sp_des, $sp_img, $rarity_id, $set_id, $sp_quantity, $sp_price)) {
                if (!move_uploaded_file($_FILES["sp_img"]["tmp_name"], $patch)) {
                    echo "<script type='text/javascript'>alert('Tải ảnh lên thất bại');</script>";
                }
                echo "<script type='text/javascript'>alert('Cập nhật sản phẩm thành công');</script>";
                echo "<script>location.href='index.php?controller=C_Admin&action=index';</script>";
            }else{
                echo "<script type='text/javascript'>alert('Cập nhật sản phẩm thất bại');history.go(-1);</script>";     
            }
        }
    }

}