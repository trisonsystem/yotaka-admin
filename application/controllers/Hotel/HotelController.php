<?php
header('Access-Control-Allow-Origin: *');

class HotelController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->load->model('MMaster');
    }

    public function index(){ 
        $this->load->model('MQuotation');
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = 'จัดการข้อมูลโรงแรม';
        $data["quarter"]        = $this->search_quarter("");
        $data["province"]       = $this->search_province("");
        $data["amphur"]     	= $this->search_amphur("");
        $data["district"]     	= $this->search_district("");
        $data["status_hotel"]   = $this->search_status_hotel("");
        
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Hotel/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function search_hotel(){
        $this->load->model("MHotel");
    	$pd = $this->MHotel->search_hotel( $_GET );
        print_r( json_encode($pd) );
    }

     public function search_quarter( $aData = "" ){
        $aData    = ( isset($_GET['quarter_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MMaster->search_quarter( $aData );
        return $arr_data;
    }

     public function search_quarters( $aData = "" ){
        $aData = $this->search_quarter( $_GET );
        print_r( json_encode($aData) );
    }

    public function search_province( $aData = "" ){
        $aData    = ( isset($_GET['quarter_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MMaster->search_province( $aData );
        return $arr_data;
    }

     public function search_provinces( $aData = "" ){
        $aData = $this->search_province( $_GET );
        print_r( json_encode($aData) );
    }


    public function search_amphur( $aData = "" ){
        $aData    = ( isset($_GET['amphur_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MMaster->search_amphur( $aData );
        return $arr_data;
    }

     public function search_amphurs( $aData = "" ){
        $aData = $this->search_amphur( $_GET );
        print_r( json_encode($aData) );
    }

     public function search_district( $aData = "" ){
        $aData    = ( isset($_GET['amphur_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MMaster->search_district( $aData );
        return $arr_data;
    }

     public function search_districts( $aData = "" ){
        $aData = $this->search_district( $_GET );
        print_r( json_encode($aData) );
    }
    
    public function search_status_hotel( $aData = "" ){
        $this->load->model("MHotel");
        $aData    = ( isset($_GET['status_hotel_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MHotel->search_status_hotel( $aData );
        return $arr_data;
    }

    public function save_data(){
        $this->load->model("MHotel");
        $res = $this->MHotel->save_data( $_POST );
        print_r( json_encode($res) );
    }

}