<?php
header('Access-Control-Allow-Origin: *');

class MdepartmentController extends CI_Controller {
    public $strUrl = "";
    public function __construct()
    {
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->load->model('MDepartment');
    }

    public function index(){
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = 'จัดการข้อมูลแผนก';

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Mdepartment/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }
}