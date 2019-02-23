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
        $this->load->model('MMaster');
    }

    public function index(){
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = 'จัดการข้อมูลแผนก';
        $data["department"]     = $this->search_department("");
        $data["division"]       = $this->search_division("");

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Mdepartment/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function search_department( $aData = "" ){
        $aData    = ( isset($_GET['department_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MDepartment->search_department( $aData );
        return $arr_data;
    }

    public function search_division( $aData = "" ){
        $aData    = ( isset($_GET['division_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MMaster->search_division( $aData );
        return $arr_data;
    }

    public function search_departments( $aData = "" ){
        $aData = $this->search_department( $_GET );
        print_r( json_encode($aData) );
    }

}