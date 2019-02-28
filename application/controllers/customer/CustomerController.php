<?php
header('Access-Control-Allow-Origin: *');

class CustomerController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->arr_sent = array("time_now" => date("Y-m-d H:i:s"));
    }

    public function index(){ 
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = $this->lang->line('manage_customer_data');
        $data['country'] 		= $this->search_country();
// debug($data);
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Customer/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function sent_to_api( $path, $aData){
        $aData["hotel_id"]  = $_COOKIE[$this->keyword."hotel_id"];
        $aData["user"]      = $_COOKIE[$this->keyword."user"];
        $aData      = ($aData == "") ?  $this->arr_sent : $aData;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url.$path;
        $json_data  = cUrl($apiUrl,"post",$param);
        return $json_data;
    }

    public function search_customer(){
        $json_data  = $this->sent_to_api( '/customer/search_customer', $_GET );
        echo $json_data;
    }

    public function save_data(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $json_data  = $this->sent_to_api( '/customer/save_data', $_POST );
        $aData      = json_decode($json_data);
        if ($aData->flag) {
            $fodel    = "assets/upload/customer_profile/";
            $aFN      = explode(".", $_POST["txtCustomerProfile"]);
            $n_name   = $aFN[count($aFN)-1];
            $n_path   = $fodel.$aData->code.".".$n_name;
            if ( count( explode("temp", $_POST["txtCustomerProfile"]) ) > 1 ) {
            $this->copy_img($_POST["txtCustomerProfile"], $n_path, $fodel);
        }
        }
        echo $json_data;
    }

    public function copy_img( $file_name,  $n_path , $n_foder){
        if ( !file_exists($n_foder) ) {
             mkdir ($n_foder, 0755);
        }
        
       if(copy($file_name, $n_path)){ 
          unlink($file_name);
          return 1;
       }else{
          return 0;
       }
      
    }


    public function search_country(){
    	$aLang = array("lang" => $_COOKIE[$this->keyword."Lang"]);
        $json_data =  $this->sent_to_api( '/master/search_country', $aLang );
        $json_data = json_decode($json_data);
        return $json_data;
    }


}