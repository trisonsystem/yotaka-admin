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
        $data['title']          = "จัดการข้อมูลตำแหน่ง";
        // $data["division"]       = $this->search_division("");
        // $data["department"]     = $this->search_department("");
        
// debug($data);
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Mposition/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }
}