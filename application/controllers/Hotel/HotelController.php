<?php
header('Access-Control-Allow-Origin: *');

class HotelController extends CI_Controller {
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
        $data['adminlist']      = array();
        $data['title']          = $this->lang->line('manage_hotel_data');
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
        $aData      = ($aData == "") ?  $this->arr_sent : $aData;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url.$path;
        $json_data  = cUrl($apiUrl,"post",$param);
        return $json_data;
    }

    public function search_hotel( $aData = "" ){
        $aData      = ( isset($_GET['hotel_code']) ) ? $_GET : $aData ;
        $aData      = ( isset($_GET['hotel_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/hotel/search_hotel', $aData );
        print_r($json_data);
    }

     public function search_quarter( $aData = "" ){
        $aData      = ( isset($_GET['quarter_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/hotel/search_quarter', $aData );
        return json_decode($json_data);
    }

     public function search_quarters( $aData = "" ){
        $aData = $this->search_quarter( $_GET );
        print_r( json_encode($aData) );
    }

    public function search_province( $aData = "" ){
        $aData      = ( isset($_GET['quarter_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/hotel/search_province', $aData );
        return json_decode($json_data);
    }

     public function search_provinces( $aData = "" ){
        $aData = $this->search_province( $_GET );
        print_r( json_encode($aData) );
    }


    public function search_amphur( $aData = "" ){
        $aData      = ( isset($_GET['amphur_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/hotel/search_amphur', $aData );
        return json_decode($json_data);
    }

     public function search_amphurs( $aData = "" ){
        $aData = $this->search_amphur( $_GET );
        print_r( json_encode($aData) );
    }

     public function search_district( $aData = "" ){
        $aData      = ( isset($_GET['amphur_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/hotel/search_district', $aData );
        return json_decode($json_data);
    }

     public function search_districts( $aData = "" ){
        $aData = $this->search_district( $_GET );
        print_r( json_encode($aData) );
    }
    
    public function search_status_hotel( $aData = "" ){
        $aData      = ( isset($_GET['status_hotel_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/hotel/search_status_hotel', $aData );
        return json_decode($json_data);
    }

    public function save_data(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];
        $json_data  = $this->sent_to_api( '/hotel/save_data', $_POST );
        $aData      = json_decode($json_data);
        if ($aData->flag) {
            $fodel    = "assets/upload/hotel_profile/";
            $aFN      = explode(".", $_POST["txtHotelProfile"]);
            $n_name   = $aFN[count($aFN)-1];
            $n_path   = $fodel.$aData->code.".".$n_name;
            if ( count( explode("temp", $_POST["txtHotelProfile"]) ) > 1 ) {
                $this->copy_img($_POST["txtHotelProfile"], $n_path, $fodel);
            }
        }
        echo $json_data;
    }

    public function chang_status(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];
        echo $json_data  = $this->sent_to_api( '/hotel/chang_status', $_POST );
    }

    public function copy_img( $file_name,  $n_path , $n_foder){
        if ( !file_exists($n_foder) ) {
             mkdir ($n_foder, 0755);
        }
        
       if(copy($file_name, $n_path)){ 
          unlink($file_name);
          return 1;
       }else{
          return 0;
       }
      
    }
}