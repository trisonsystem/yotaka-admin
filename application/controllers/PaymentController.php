<?php

header('Access-Control-Allow-Origin: *');

class PaymentController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->arr_sent = array("time_now" => date("Y-m-d H:i:s"));
    }

    public function payment_list(){ 
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = $this->lang->line('payment_list');
        $data['status_payment'] = $this->search_payment_status("");
        $data['bank']           = $this->search_bank("");
        $data['bank_list']      = $this->search_bank_list("");
        $data['payment_type']   = $this->search_payment_type("");

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('payment_list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function sent_to_api( $path, $aData){
        $aData["hotel_id"]  = $_COOKIE[$this->keyword."hotel_id"];
        $aData["user"]      = $_COOKIE[$this->keyword."user"];
        $aData["lang"]      = $_COOKIE[$this->keyword."Lang"];
        $aData      = ($aData == "") ?  $this->arr_sent : $aData;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url.$path;
        $json_data  = cUrl($apiUrl,"post",$param);
        return $json_data;
    }

    public function search_payment( $aData = "" ){
    	$aData      = ( isset($_GET['bank_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/payment/search_payment', $aData );
       	echo $json_data;
    }

    public function search_payment_status( $aData = "" ){
        $aData      = ( isset($_GET['payment_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/payment/search_payment_status', $aData );
        return json_decode($json_data);
    }

    public function search_bank( $aData = "" ){
        $aData      = ( isset($_GET['bank_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/bank/search_bank', $aData );
        return json_decode($json_data);
    }

    public function search_bank_list( $aData = "" ){
        $aData      = ( isset($_GET['bank_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/bank/search_bank_list', $aData );
        return json_decode($json_data);
    }

    public function search_payment_type( $aData = "" ){
        $json_data  = $this->sent_to_api( '/payment/search_payment_type', $aData );
        return json_decode($json_data);
    }

     public function chang_status(){
        $json_data     = $this->sent_to_api( '/payment/chang_status', $_POST );
        echo $json_data;
    }
}