<?php
header('Access-Control-Allow-Origin: *');

class LanguageController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->arr_sent = array("time_now" => date("Y-m-d H:i:s"));
    }

    public function sent_to_api( $path, $aData){
        $aData      = ($aData == "") ?  $this->arr_sent : $aData;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url.$path;
        $json_data  = cUrl($apiUrl,"post",$param);
        return $json_data;
    }

    public function get_language( $aData = "" ){
        $aData      = ( isset($_GET['lang']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/language/getLang', $aData );
        return $json_data;
    }
    public function getLang( ){ 
      $json_data  =  $this->get_language();
        echo $json_data;
    }
    
    public function change_lang(){ 
        $json_data  =  $this->get_language();
        echo $json_data;
    }
}