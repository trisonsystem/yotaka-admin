<?php

header('Access-Control-Allow-Origin: *');

class BookController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->arr_sent = array("time_now" => date("Y-m-d H:i:s"));
    }

    public function book_now(){ 
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = $this->lang->line('book_now');
        
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Book/book_now',$data,true);
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

    public function search_room_forbook(){
        $json_data  = $this->sent_to_api( '/book/search_room_forbook', $_GET );
        print_r($json_data);
    }

    public function search_customer(){
        $json_data  = $this->sent_to_api( '/customer/search_customer', $_GET );
        echo $json_data;
    }

    public function save(){
        $json_data  = $this->sent_to_api( '/book/save_data', $_GET );
        echo $json_data;
    }

    public function book_list(){
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = $this->lang->line('book_data');
        $data['status_book']    = $this->search_status_book("");
// debug($data, true);
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Book/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function search_status_book( $aData = "" ){
        $aData      = ( isset($_GET['status_book_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/book/search_status_book', $aData );
        return json_decode($json_data);
    }

    public function search_book_list(){
        $json_data  = $this->sent_to_api( '/book/search_book_list', $_GET );
        echo $json_data;
    }

    public function chang_status(){
        $json_data     = $this->sent_to_api( '/book/chang_status', $_POST );
        echo $json_data;
    }

    public function get_form_payment(){
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = $this->lang->line('payment');
        $data['bank']           = $this->search_bank("");
        
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Book/payment',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function search_bank( $aData = "" ){
        $aData      = ( isset($_GET['bank_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/bank/search_bank', $aData );
        return json_decode($json_data);
    }
}//end class
?>