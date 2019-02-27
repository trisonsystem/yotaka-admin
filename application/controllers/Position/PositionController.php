<?php
header('Access-Control-Allow-Origin: *');

class PositionController extends CI_Controller {
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
        $data['title']          = "จัดการข้อมูลตำแหน่ง";
        $data["division"]       = $this->search_division("");
        $data["department"]     = $this->search_department("");
        
// debug($data);
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Position/list',$data,true);
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

    public function search_position(){
		$json_data  = $this->sent_to_api( '/position/search_position', $_GET );
        echo $json_data;
    }

    public function search_division( $aData = "" ){
    	$aData      = ( isset($_GET['division_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/position/search_division', $aData );
        return json_decode($json_data);
    }

    public function search_department( $aData = "" ){
        $aData    = ( isset($_GET['division_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/employee/search_department', $aData );
        return json_decode($json_data);
    }

    public function search_departments( $aData = "" ){
        $aData = $this->search_department( $_GET );
        print_r( json_encode($aData) );
    }

    public function save_data(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];        
        $json_data  = $this->sent_to_api( '/position/save_data', $_POST );        
        echo $json_data;
    }

    public function chang_status(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];        
        $json_data     = $this->sent_to_api( '/position/chang_status', $_POST );
        echo $json_data;
    }
}