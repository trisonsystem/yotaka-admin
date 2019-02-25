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
        $data['status'] 		= array();
        $data['status'][0] 		= array( "id" => 'blank', "name" => $this->lang->line('blank') );
        $data['status'][1] 		= array( "id" => 'book', "name" => $this->lang->line('book') );
        $data['status'][2] 		= array( "id" => 'stay', "name" => $this->lang->line('stay') );
        $data['status'][3] 		= array( "id" => 'close_status', "name" => $this->lang->line('close_status') );

        $data['item_room']  	= $data['status'];
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
}
?>