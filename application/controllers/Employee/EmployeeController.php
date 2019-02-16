<?php
header('Access-Control-Allow-Origin: *');

class EmployeeController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->load->model('MEmployee');
    }

    public function index(){ 
        $this->load->model('MQuotation');
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = 'จัดการข้อมูลพนักงาน';
        $data["division"]       = $this->search_division("");
        $data["department"]     = $this->search_department("");
        $data["position"]       = $this->search_position("");
        $data["status_employee"]= $this->search_status_employee("");
        
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Employee/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function search_employee(){
        $pd = $this->MEmployee->search_employee( $_GET );
        print_r( json_encode($pd) );
    }

    public function search_division( $aData = "" ){
        $aData    = ( isset($_GET['division_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MEmployee->search_division( $aData );
        return $arr_data;
    }

    public function search_department( $aData = "" ){
        $aData    = ( isset($_GET['department_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MEmployee->search_department( $aData );
        return $arr_data;
    }

     public function search_departments( $aData = "" ){
        $aData = $this->search_department( $_GET );
        print_r( json_encode($aData) );
    }

    public function search_position( $aData = "" ){
        $aData    = ( isset($_GET['position_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MEmployee->search_position( $aData );
        return $arr_data;
    }

    public function search_positions( $aData = "" ){
        $aData = $this->search_position( $_GET );
        print_r( json_encode($aData) );
    }

    public function search_status_employee( $aData = "" ){
        $aData    = ( isset($_GET['status_employee_id']) ) ? $_GET : $aData ;
        $arr_data = $this->MEmployee->search_status_employee( $aData );
        return $arr_data;
    }

    public function save_data(){
        $res = $this->MEmployee->save_data( $_POST );
        print_r( json_encode($res) );
    }

    public function upload(){
        /* Getting file name */
        $filename = $_FILES['file']['name'];

        $fodel = "assets/upload/temp/";
        if ( !file_exists($fodel) ) {
             mkdir ($fodel, 0755);
        }
        /* Location */
        $location = $fodel.$filename;
        $FN = explode(".", $filename);
        $f_name   = date("Ymdhis").".".$FN[count($FN) -1];

    

        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

        /* Valid Extensions */
        $valid_extensions = array("jpg","jpeg","png");
        /* Check file extension */
        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
           $uploadOk = 0;
        }

        if($uploadOk == 0){
           echo 0;
        }else{
           /* Upload file */
           if(move_uploaded_file($_FILES['file']['tmp_name'],$fodel.$f_name)){
              echo $fodel.$f_name;
           }else{
              echo 0;
           }
        }
    }//endfunction

    public function chang_status(){
        $res = $this->MEmployee->chang_status( $_POST );
        print_r( json_encode($res) );
    }
}