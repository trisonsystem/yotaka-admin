<?php
header('Access-Control-Allow-Origin: *');

class LoginController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
    }

    public function index(){

        $chkCookie  = true;
        $arrCookie  = array('token','lang');

        foreach ($arrCookie as $value) {
            if(isset($_COOKIE[$this->keyword.$value])){
                $chkCookie = false;
            }else{
                $chkCookie  = true;
            }
        }

        if($chkCookie == false){
            redirect('main', 'refresh');
        }else{
            $this->load->view('login/login');
        }
    }

    public function chkLogin(){

        $usr   = (!empty($_POST['usr']))? $_POST['usr'] : '';
        $pwd   = (!empty($_POST['pwd']))? $_POST['pwd'] : '';
        $lang  = (!empty($_POST['lang']))? $_POST['lang'] : 'en';
        $ip    = (isset($_SERVER['HTTP_CF_CONNECTING_IP']))? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];

        if($usr == '' || $pwd == ''){
            setcookie($this->keyword."error",'No Username Or Password');
            redirect('login', 'refresh');
        }

        $vdata  = array("u_username"=>$usr,"u_password"=>$pwd,"u_ip"=>$ip);
        // $code   = encode(json_encode($vdata));
        // $json   = cUrl($this->apiUrl.'/admin/admin_login',"post","vdata=".$code);
        // $data   = json_decode($json,true);

        // $param = http_build_query(array('data' => $dataInfo));
        // echo cUrl(CASH_API_URL.'/bank',"post",$param);

        // debug($vdata,true);
        $data['status'] = 1;

        if($data['status'] == 1){
          
            $arrToken = array( 
                    'user'    => 'chate',
                    'date'    => date('Y-m-d H:i:s'),
                    'ip'      => $ip,
                    'lang'    => 'en',
                    'rndkey'  => 'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4',
                );

            $token = encode($arrToken);

            setcookie($this->keyword."token",'');
            setcookie($this->keyword."lang",'');
            
            setcookie($this->keyword."token",$token);
            setcookie($this->keyword."lang",$lang);

            redirect('main', 'refresh');
          
        }else{
            setcookie($this->keyword."error",$data['msg']);
            redirect('login', 'refresh');
        }
    }

    
    public function logout(){

        // setcookie($this->keyword."user",'');
        setcookie($this->keyword."token",'');
        setcookie($this->keyword."lang",'');
        // setcookie($this->keyword."authorization",'');

        redirect('login', 'refresh');
    }
}//end class

