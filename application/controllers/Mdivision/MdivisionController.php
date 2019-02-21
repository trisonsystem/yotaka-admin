<?php
header('Access-Control-Allow-Origin: *');

class MdivisionController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->load->model('MMdivision');
    }

    public function index(){
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = 'จัดการข้อมูลแผนก';
        $data['divcode']        = $this->search_divcode("");
        $data['divname']        = $this->search_divname("");
        // $data['divstatus']        = '';

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Mdivision/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function search_divcode( $aData = "" ){
        $aData    = ( isset($_GET['division_code']) ) ? $_GET : $aData ;
        $arr_data = $this->MMdivision->search_divcode( $aData );
        return $arr_data;
    }

    public function search_divname( $aData = "" ){
        $aData    = ( isset($_GET['division_name']) ) ? $_GET : $aData ;
        $arr_data = $this->MMdivision->search_divname( $aData );
        return $arr_data;
    }

    public function search_division(){
        $pd = $this->MMdivision->search_division( $_GET );
        print_r( json_encode($pd) );
    }

    public function search_division_code(){
        $pd = $this->MMdivision->search_divcode( "" );
        print_r( json_encode($pd) );
    }

    public function search_division_name(){
        $pd = $this->MMdivision->search_divname( "" );
        print_r( json_encode($pd) );
    }

    public function save_data(){
        $res = $this->MMdivision->save_data( $_POST );
        print_r( json_encode($res) );
    }
}