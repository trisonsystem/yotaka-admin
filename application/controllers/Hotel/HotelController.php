<?php
header('Access-Control-Allow-Origin: *');

class HotelController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
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

    public function sent_to_api( $path, $aData){
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url;
        $json_data  = cUrl($apiUrl.$path,"post",$param);
        return $json_data;
    }

    public function search_hotel(){
        $aData      = ( isset($_GET['quarter_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/hotel/search_hotel', $aData );
        print_r($json_data);
    }

     public function search_quarter( $aData = array("xxxxx" => "xxxx") ){
        $aData      = ( isset($_GET['quarter_id']) ) ? $_GET : $aData ;
        debug($aData);
        $json_data  = $this->sent_to_api( '/hotel/search_quarter', $aData );
        return json_decode($json_data);
    }

     public function search_quarters( $aData = "" ){
        $aData = $this->search_quarter( $_GET );
        print_r( json_encode($aData) );
    }

    public function search_province( $aData = "" ){
        // $aData    = ( isset($_GET['quarter_id']) ) ? $_GET : $aData ;
        // $arr_data = $this->MMaster->search_province( $aData );
        $aData      = ( isset($_GET['quarter_id']) ) ? $_GET : $aData ;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url;
        $json_data  = cUrl($apiUrl.'/hotel/search_province',"post",$param);
        return json_decode($json_data);
    }

     public function search_provinces( $aData = "" ){
        $aData = $this->search_province( $_GET );
        print_r( json_encode($aData) );
    }


    public function search_amphur( $aData = "" ){
        // $aData    = ( isset($_GET['amphur_id']) ) ? $_GET : $aData ;
        // $arr_data = $this->MMaster->search_amphur( $aData );
        $aData      = ( isset($_GET['amphur_id']) ) ? $_GET : $aData ;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url;
        $json_data  = cUrl($apiUrl.'/hotel/search_amphur',"post",$param);
        return json_decode($json_data);
    }

     public function search_amphurs( $aData = "" ){
        $aData = $this->search_amphur( $_GET );
        print_r( json_encode($aData) );
    }

     public function search_district( $aData = "" ){
        // $aData    = ( isset($_GET['amphur_id']) ) ? $_GET : $aData ;
        // $arr_data = $this->MMaster->search_district( $aData );
        $aData      = ( isset($_GET['amphur_id']) ) ? $_GET : $aData ;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url;
        $json_data  = cUrl($apiUrl.'/hotel/search_district',"post",$param);
        return json_decode($json_data);
    }

     public function search_districts( $aData = "" ){
        $aData = $this->search_district( $_GET );
        print_r( json_encode($aData) );
    }
    
    public function search_status_hotel( $aData = "" ){
        // $aData    = ( isset($_GET['status_hotel_id']) ) ? $_GET : $aData ;
        // $arr_data = $this->MHotel->search_status_hotel( $aData );
        $aData      = ( isset($_GET['status_hotel_id']) ) ? $_GET : $aData ;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url;
        $json_data  = cUrl($apiUrl.'/hotel/search_status_hotel',"post",$param);
        return json_decode($json_data);
    }

    public function save_data(){
        $this->load->model("MHotel");
        $res = $this->MHotel->save_data( $_POST );
        print_r( json_encode($res) );
    }

    public function chang_status(){
        $this->load->model("MHotel");
        $res = $this->MHotel->chang_status( $_POST );
        print_r( json_encode($res) );
    }
}