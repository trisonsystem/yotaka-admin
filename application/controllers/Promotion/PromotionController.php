<?php
header('Access-Control-Allow-Origin: *');

class PromotionController extends CI_Controller {
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
        $data['title']          = $this->lang->line('manage_pomotion_data');
        $data["room_type"]       = $this->search_roomtype("");
// debug($data);
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Promotion/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function sent_to_api( $path, $aData ){
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


    public function search_roomtype( $aData = "" ){
        $aData      = ( isset($_GET['roomtype_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/roomtype/search_roomtype', $_GET );
        return json_decode($json_data);
    }

    public function search_promotion(){
        $json_data  = $this->sent_to_api( '/promotion/search_promotion', $_GET );
        echo $json_data;
    }

    public function save_data(){
        // debug($_POST,true);
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];     
        $json_data  = $this->sent_to_api( '/promotion/save_data', $_POST );        
        // echo $json_data;

        $aData      = json_decode($json_data);

        if ($aData->flag) {
            $fodel    = "assets/upload/promotion_images/";
            $aFN      = explode(".", $_POST["txtPromotionImages"]);            
            $n_name   = $aFN[count($aFN)-1];            
            $n_path   = $fodel.$aData->code.".".$n_name;
            // debug($n_path, true);
            if ( count( explode("temp", $_POST["txtPromotionImages"]) ) > 1 ) {
                $this->copy_img($_POST["txtPromotionImages"], $n_path, $fodel);
            }
        }
        echo $json_data;
    }

    public function chang_status(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];        
        $json_data     = $this->sent_to_api( '/promotion/chang_status', $_POST );
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
}