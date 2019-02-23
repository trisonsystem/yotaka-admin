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

        // if($chkCookie == false){
        //     redirect('main', 'refresh');
        // }else{
            $this->load->view('login/login');
        // }
    }

    public function chkLogin(){

        $usr   = (!empty($_POST['usr']))? $_POST['usr'] : '';
        $pwd   = (!empty($_POST['pwd']))? $_POST['pwd'] : '';
        $lang  = (!empty($_POST['lang']))? $_POST['lang'] : 'en';
        $captcha        = (!empty($_POST['captcha']))? $_POST['captcha'] : '';
        $CaptchaCode    = (!empty($_POST['CaptchaCode']))? $_POST['CaptchaCode'] : '';

        $ip    = (isset($_SERVER['HTTP_CF_CONNECTING_IP']))? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];

        if($usr == '' || $pwd == ''){
            setcookie($this->keyword."error",'No Username Or Password');
            redirect('login', 'refresh');
        }else if($captcha != $CaptchaCode){
            setcookie($this->keyword."error",'Captcha Number Not Macth!');
            redirect('login', 'refresh');
        }

        $data  = array("u_username"=>$usr,"u_password"=>$pwd,"u_ip"=>$ip);
        // $code   = encode(json_encode($vdata));
        // $json   = cUrl($this->apiUrl.'/admin/admin_login',"post","vdata=".$code);
        // $data   = json_decode($json,true);

        // $param = http_build_query(array('data' => $dataInfo));
        // echo cUrl(CASH_API_URL.'/bank',"post",$param);

        $arrData    = json_encode($data);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url.'/login/admin_login';
        $result     = cUrl($apiUrl,"post",$param);
        $data       = json_decode($result,true);
       

        if($data['status_flag'] == 1){
          
            $arrToken = array( 
                    'user'    => $usr,
                    'date'    => date('Y-m-d H:i:s'),
                    'ip'      => $ip,
                    'lang'    => 'en',
                    'rndkey'  => $data['key_token'],
                );

            $token = encode($arrToken);

            setcookie($this->keyword."token",'');
            setcookie($this->keyword."user",$usr);
            setcookie($this->keyword."lang",'');
            setcookie($this->keyword."hotel_id", $data["hotel_id"]);
            setcookie($this->keyword."level", $data["level"]);

            setcookie($this->keyword."token",$token);
            setcookie($this->keyword."lang",$lang);

            redirect('main', 'refresh');
          
        }else{
            setcookie($this->keyword."error",$data['msg']);
            redirect('login', 'refresh');
        }
    }

    public function update_login(){
        $arr = array("status_flag" => "false", "msg"  => "log out" );
        if (isset($_COOKIE[$this->keyword."token"])) {
            $token = decode($_COOKIE[$this->keyword."token"]);

            // debug($token, 1);
            $data       = array("u_username"=>$token["user"],"key_token"=>$token["rndkey"]);
            $arrData    = json_encode($data);
            $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
            $param      = http_build_query(array('data' => $dataInfo));
            $apiUrl     = $this->api_url.'/login/update_login';
            $result     = cUrl($apiUrl,"post",$param);
            // $arr        = json_decode($result,true);
            echo $result;
            
        }else{
            ssetcookie($this->keyword."user",'');
            setcookie($this->keyword."token",'');
            setcookie($this->keyword."hotel_id", "");
            setcookie($this->keyword."level", "");
        }

        // print_r( json_encode($arr) );
    }
    
    public function logout(){
        if (isset($_COOKIE[$this->keyword."token"])) {
            setcookie($this->keyword."user",'');
            setcookie($this->keyword."token",'');
            setcookie($this->keyword."hotel_id", "");
            setcookie($this->keyword."level", "");
            // setcookie($this->keyword."Lang",'');
            // setcookie($this->keyword."authorization",'');
        }
        

        redirect('login', 'refresh');
    }
}//end class

