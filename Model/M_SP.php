<?php 
class M_SP extends M_Db 
{
    function tatca()
    {
        return $this->querySelect("select * from sanpham");
    }

    function SetSP()                 //set
    {
        return $this->querySelect('select * from set_sp');
    }
    function search($keywords)
    {
        $data =["%$keywords%"];
        $sql="select * from sanpham where sp_name like ?";
        $arr1 = $this->querySelect($sql, $data);
        $sql="select * from sanpham where sp_id like ?";
        $arr2 = $this->querySelect($sql, $data);
        $data = array_merge($arr1,$arr2);
        $data = array_unique($data, SORT_REGULAR);
        return $data;
    }
    function rand4()
    {
        return $this->querySelect('select * from sanpham order by rand() limit 0, 4');
    }

    function filterSet($set_id)             //set
    {
        return $this->querySelect('select * from sanpham where set_id=?', [$set_id]);
    }

    function rarity()                    //rarity
    {
        return $this->querySelect('select * from rarity');
    }

    function filterRarity($rarity_id)             //rarity
    {
        return $this->querySelect('select * from sanpham where rarity_id=?', [$rarity_id]);
    }

    function getRarityName($rarity_id)             //set
    {
        return $this->querySelect('select * from rarity where rarity_id=?', [$rarity_id]);
    }

    function detail()
    {
        $sp_id = getIndex('sp_id');
        $rarity_id = getIndex('rarity_id');
        $sql = "select * from sanpham where sp_id='$sp_id' and rarity_id = '$rarity_id'";
        $data = $this->querySelect($sql);
        return $data[0];
    }

    function getproduct($sp_id,$rarity_id)
    {
        $sql = "select * from sanpham where sp_id='$sp_id' and rarity_id = '$rarity_id'";
        $data = $this->querySelect($sql);
        return $data[0];
    }

    function allnews()                    //news
    {
        return $this->querySelect('select * from tintuc');
    }

    function newsdetail()
    {
        $tt_id = getIndex('tt_id');
        $data =  $this->querySelect('select * from tintuc where tt_id=?', [$tt_id]);
        return $data[0];
    }

    function add_Product($sp_id, $sp_name, $sp_des, $sp_img, $rarity_id, $set_id, $sp_quantity, $sp_price)
    {
        $check = $this->querySelect("select * from sanpham where sp_id= '$sp_id' and rarity_id= '$rarity_id'");
        if(empty($check)){
            $sql = "INSERT INTO sanpham(sp_id, sp_name, sp_des, sp_img, rarity_id, set_id, sp_quantity, sp_price) VALUES ('$sp_id', '$sp_name', '$sp_des', '$sp_img', '$rarity_id', '$set_id', '$sp_quantity', '$sp_price')";
            $this->querySelect($sql);
            return true;
        }else{
            return false;
        }
    }

    function update_Product($sp_id, $sp_name,$sp_des, $sp_img, $rarity_id, $set_id, $sp_quantity, $sp_price)
    {
        $check = $this->querySelect("select * from sanpham where sp_id= '$sp_id' and rarity_id= '$rarity_id'");
        if(empty($check)){
            return false;
        }else{
            $sql = "update sanpham set sp_id = '$sp_id',
            sp_name = '$sp_name',
            sp_des = '$sp_des',
            sp_img = '$sp_img',
            rarity_id = '$rarity_id',
            set_id = '$set_id',
            sp_quantity = '$sp_quantity',
            sp_price = '$sp_price' where sp_id = '$sp_id' and rarity_id = '$rarity_id'";
            $this->querySelect($sql);
            return true;
        }
    }

    function delete()
    {
        $sp_id = getIndex('sp_id');
        $rarity_id = getIndex('rarity_id');
        $check = $this->querySelect("select * from sanpham where sp_id= '$sp_id' and rarity_id= '$rarity_id'");
        if(empty($check)){
            return false;
        }else{
            $sql = "delete from sanpham where sp_id='$sp_id' and rarity_id = '$rarity_id'";
            $this->querySelect($sql);
            return true;
        }
    }
    function dangky($user_id,$user_password,$user_name,  $user_phone)
    {
        $data = $this->querySelect("select * from nguoidung where user_id='$user_id'");
        // var_dump($data);
        if(empty($data)){
          
            $user_password = md5($user_password);
            $sql = "INSERT INTO nguoidung(
            user_id,
            user_password, 
            user_name, 
            user_add, 
            user_phone, 
            user_type) 
            VALUES ('$user_id', 
            '$user_password', 
            '$user_name', 
            ' ', 
            '$user_phone', 
            '0')";
            $this->querySelect($sql);
           
            return true;
        }else{
            echo "<script type='text/javascript'>alert('Tên tài khoản tồn tại');history.go(-1);</script>"; 
            return false;
            
        }

    }
    function login($users, $passwords){
        $data = $this->querySelect('select * from nguoidung where user_id=?', [$users]);
        // var_dump($data);die();
        if(empty($data)){
            echo "<script type='text/javascript'>alert('Tài khoản không tồn tại');history.go(-1);</script>"; 
        }else{
            if($data[0]['user_password']==md5($passwords)){
                
                $_SESSION['user_id'] = $data[0]['user_id'];
                $_SESSION['user_name'] = $data[0]['user_name'];
                $_SESSION['user_type'] = $data[0]['user_type'];
                header('Location: index.php');
                return true;
            }else{
                echo "<script type='text/javascript'>alert('Sai mật khẩu');history.go(-1);</script>"; 
            }
        }
    }
}