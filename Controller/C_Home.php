<?php 
class C_Home 
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
        if ($action=='search')
            $this->search();
        if ($action=='filter')
            $this->filter();
        if ($action=='detail')
            $this->detail();
        if ($action=='contact')
            $this->contact();
        if ($action=='news')
            $this->news();
        if ($action=='newsdetail')
            $this->newsdetail();
        if ($action=='loadlogin')
            $this->loadlogin();
        if ($action=='login')
            $this->login();
        if ($action=='loaddangky')
            $this->loaddangky();
        if ($action=='dangky')
            $this->dangky();
        if ($action=='logout')
            $this->logout();
    }

    function index()
    {
        $m= new M_SP();
        $dataSet = $m->SetSP();

        $data = $m->rand4();
        $dataR = $m->rarity();
        foreach ($data as $key => $value) {
            foreach ($dataR as $key2 => $value2) {
                if($value2['rarity_id'] == $data[$key]['rarity_id']){
                    $data[$key]['rarity_name'] = $value2['rarity_name'];
                }
            }
        }
       $subview ='View/user/c_home_index.php';
       include 'View/index.php';
    }

    function search()
    {
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        $keywords= postIndex('keywords');
        $data=$m->search($keywords);
        $pagename ='Tìm kiếm: '.$keywords;
        foreach ($data as $key => $value) {
            foreach ($dataR as $key2 => $value2) {
                if($value2['rarity_id'] == $data[$key]['rarity_id']){
                    $data[$key]['rarity_name'] = $value2['rarity_name'];
                }
            }
        }
        $subview ='View/user/c_home_filter.php';
        include 'View/index.php';
    }
    function filter()
    {
        $set_id= getIndex('set_id');
        $rarity_id= getIndex('rarity_id');
        
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        if($set_id != null){
            $data=$m->filterSet($set_id);
            $pagename ='Set Product: '.$set_id;
        }
        if($rarity_id != null){
            $data=$m->filterRarity($rarity_id);
            $rarity = $m->getRarityName($rarity_id);
            $pagename ='Rarity: '.$rarity[0]['rarity_name'];
        }

        // var_dump($data);die();
        if(isset($data)){
            foreach ($data as $key => $value) {
                $rarity = $m->getRarityName($data[$key]['rarity_id']);
                $data[$key]['rarity_name'] = $rarity[0]['rarity_name'];
            }
        }else{
            $data = null;
        }

        $subview ='View/user/c_home_filter.php';
        include 'View/index.php';
    }

    function detail()
    {
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        $data=$m->detail('sp_id','rarity_id');
        foreach ($dataSet as $key => $value) {
            if($value['set_id'] == $data['set_id']){
                $data['set_id'] = $value['set_name'];
            }
        }
        foreach ($dataR as $key => $value) {
            if($value['rarity_id'] == $data['rarity_id']){
                $data['rarity_id'] = $value['rarity_name'];
            }
        }
        $subview ='View/user/c_home_detail.php';
        include 'View/index.php';
    }
    function contact()
    {
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        $subview ='View/user/c_home_contact.php';
        include 'View/index.php';
    }

    function news()
    {
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();

        $data=$m->allnews();

        $subview ='View/user/c_home_news.php';
        include 'View/index.php';
    }

    function newsdetail()
    {
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        
        $data=$m->newsdetail('tt_id');

        $subview ='View/user/c_home_newsdetail.php';
        include 'View/index.php';
    }

    function loadlogin(){
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        $subview ='View/user/c_login.php';
        include 'View/index.php';
    }

    function login()
    {
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        $users = $_POST['users'];
        $passwords=$_POST['passwords'];  
        if (empty($_POST['users']) or empty($_POST['passwords'])) {
           echo '<p style="color:red">vui long khong de trong</p>';
        }else{
            $m->login($users, $passwords);
        }
    }
    function loaddangky(){
        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        $subview ='View/user/c_dangky.php';
        include 'View/index.php';
    }
    function dangky(){

        $m = new M_SP();
        $dataSet = $m->SetSP();
        $dataR = $m->rarity();
        $user_name=$_POST['user_name'];
        $user_id = $_POST['user_id'];
        $user_phone=$_POST['user_phone'];
        $user_password=$_POST['user_password'];
        // $passwords = md5($passwords);
        // $repasswords=$_POST['repasswords'];
        // echo $user_name.' '.$user_id.' '.$user_phone. ' '.$user_password;
        if(strlen($user_id) <6 or strlen($user_password) <6 ){
            echo "<script type='text/javascript'>alert('User name và password phải nhiều hơn 6 ký tự');history.go(-1);</script>"; 
        }else{
            if($m->dangky($user_id,$user_password,$user_name,  $user_phone )){
              echo "<script type='text/javascript'>alert('Tạo tài khoản thành công');history.go(-1);</script>"; 


            }else{
                echo "<script type='text/javascript'>alert('a');history.go(-1);</script>"; 
                exit();
               
            }
        }
    }
    function logout()
    {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['status_login'] = false;
        $this->index();
    }

}