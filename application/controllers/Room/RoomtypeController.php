<?php
header('Access-Control-Allow-Origin: *');

class RoomtypeController extends CI_Controller {
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
        $data['title']          = "จัดการข้อมูลประเภทห้อง";

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Room/listtype',$data,true);
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

    public function search_roomtype(){
        $json_data  = $this->sent_to_api( '/roomtype/search_roomtype', $_GET );
        echo $json_data;
    }

    public function save_data(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];        
        $json_data  = $this->sent_to_api( '/roomtype/save_data', $_POST );        
        echo $json_data;
    }
}