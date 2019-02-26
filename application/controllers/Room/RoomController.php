<?php
header('Access-Control-Allow-Origin: *');

class RoomController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->arr_sent = array("time_now" => date("Y-m-d H:i:s"));
    }

    public function index(){ 
        $this->load->model('MQuotation');
        $data = array();
        $data['title']          = $this->lang->line('manage_main_room');
        $data['status'] 		= $this->search_status_room("");
        $data['type_room'] 		= $this->search_type_room("");
        $data['item_room']  	= $this->search_room_item("");
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Room/list',$data,true);
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

    public function search_room( $aData = "" ){
        $aData      = ( isset($_GET['room_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/room/search_room', $aData );
        print_r($json_data);
    }

    public function search_room_edit(){
        $aData      = ( isset($_GET['room_id']) ) ? $_GET : $aData ;
        $json_data["room"]  = $this->sent_to_api( '/room/search_room', $aData );
        $json_data["item"]  = $this->sent_to_api( '/room/search_room_item_list', $aData );
        print_r( json_encode( $json_data) );
    }

    public function search_status_room(  ){
    	$arr = array();
    	$arr[0] 		= array( "id" => 'blank', "name" => $this->lang->line('blank') );
        $arr[1] 		= array( "id" => 'book', "name" => $this->lang->line('book') );
        $arr[2] 		= array( "id" => 'stay', "name" => $this->lang->line('stay') );
        $arr[3] 		= array( "id" => 'close_status', "name" => $this->lang->line('close_status') );
        $json_data = json_encode($arr);
        return json_decode($json_data);
    }


    public function search_type_room( $aData = "" ){
        $aData      = ( isset($_GET['type_room_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/room/search_type_room', $aData );
        return json_decode($json_data);
    }

    public function search_room_item( $aData = "" ){
        $aData      = ( isset($_GET['room_item_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/room/search_room_item', $aData );
        return json_decode($json_data);
    }

    public function search_room_item_list( $aData = "" ){
        $aData      = ( isset($_GET['room_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/room/search_room_item_list', $aData );
        return json_decode($json_data);
    }

    public function save_data(){
       echo $json_data  = $this->sent_to_api( '/room/save_data', $_POST );
    }
}
?>