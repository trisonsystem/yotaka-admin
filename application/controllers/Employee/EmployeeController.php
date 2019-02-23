<?php
header('Access-Control-Allow-Origin: *');

class EmployeeController extends CI_Controller {
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
        $data['title']          = $this->lang->line('manage_employee_data');
        $data["division"]       = $this->search_division("");
        $data["department"]     = $this->search_department("");
        $data["position"]       = $this->search_position("");
        $data["status_employee"]= $this->search_status_employee("");
        $data["hotel"]          = $this->search_hotel("");
// debug($data);
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Employee/list',$data,true);
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

    public function search_employee(){
        $_GET["user"]  = $_COOKIE[$this->keyword."user"];
        $aData["user"] = $_COOKIE[$this->keyword."user"];
        $json_data  = $this->sent_to_api( '/employee/search_employee', $_GET );
        echo $json_data;
    }

    public function search_division( $aData = "" ){
        $aData      = ( isset($_GET['division_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/employee/search_division', $aData );
        return json_decode($json_data);
    }

    public function search_department( $aData = "" ){
        $aData    = ( isset($_GET['department_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/employee/search_department', $aData );
        return json_decode($json_data);
    }

     public function search_departments( $aData = "" ){
        $aData = $this->search_department( $_GET );
        print_r( json_encode($aData) );
    }

    public function search_position( $aData = "" ){
        $aData      = ( isset($_GET['position_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/employee/search_position', $aData );
        return json_decode($json_data);
    }

    public function search_positions( $aData = "" ){
        $aData = $this->search_position( $_GET );
        print_r( json_encode($aData) );
    }

    public function search_status_employee( $aData = "" ){
        $_GET["user"]  = $_COOKIE[$this->keyword."user"];
        $aData["user"] = $_COOKIE[$this->keyword."user"];
        $aData    = ( isset($_GET['status_employee_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/employee/search_status_employee', $aData );
       return json_decode($json_data);
    }

    public function search_hotel( $aData = "" ){
        $_GET["user"]  = $_COOKIE[$this->keyword."user"];
        $aData["user"] = $_COOKIE[$this->keyword."user"];
        $aData      = ( isset($_GET['hotel_code']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/master/search_hotel_use', $aData );
        return json_decode($json_data);
    }

    public function save_data(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];
        $json_data  = $this->sent_to_api( '/employee/save_data', $_POST );
        $aData      = json_decode($json_data);
        if ($aData->flag) {
            $fodel    = "assets/upload/employee_profile/";
            $aFN      = explode(".", $_POST["txtEmployeeProfile"]);
            $n_name   = $aFN[count($aFN)-1];
            $n_path   = $fodel.$aData->code.".".$n_name;
            if ( count( explode("temp", $_POST["txtEmployeeProfile"]) ) > 1 ) {
            $this->copy_img($_POST["txtEmployeeProfile"], $n_path, $fodel);
        }
        }
        echo $json_data;
    }

    public function chang_status(){
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];
        $json_data  = $this->sent_to_api( '/employee/chang_status', $_POST );
        echo $json_data;
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