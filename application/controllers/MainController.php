<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

  	public function __construct(){
	    parent::__construct();

	    $this->keyword = $this->config->config['keyword'];
    	$this->apiUrl  = $this->config->config['api_url'];
        $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
    	// $this->token   = '4ddfdgghrdfyjhtuoookgftyu';
        $this->des_key  = $this->config->config['des_key'];
        
  	}

	public function index(){

        $chkCookie  = true;
        $arrCookie  = array('token','lang');
        foreach ($arrCookie as $value) {
          if(isset($_COOKIE[$this->keyword.$value])){
            $chkCookie = false;
          }else{
            $chkCookie  = true;
          }
        }

        // // debug(444,true);

        if($chkCookie == false){
            $data                   = array();
            // $data['messageShow']    = messageRunning($this->token);
            // $data['senior']         = seniorMessage($this->token);
            $data['title']          = $this->lang->line('main_menu');
            $data["hotel"]          = $this->search_hotel("");
            $this->load->view('layout/app',$data);
        }else{
            redirect('login','refresh');
        }
        $data                   = array();

	}

    public function sent_to_api( $path, $aData){
        $aData      = ($aData == "") ?  $this->arr_sent : $aData;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->apiUrl.$path;
        $json_data  = cUrl($apiUrl,"post",$param);
        return $json_data;
    }

    public function search_hotel( $aData = "" ){
        $_GET["user"]  = $_COOKIE[$this->keyword."user"];
        $aData["user"] = $_COOKIE[$this->keyword."user"];
        $aData      = ( isset($_GET['hotel_code']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/master/search_hotel_use', $aData );
        return $json_data;
    }

	public function adminList(){

        $data = array();


        $vdata      = json_encode(array(1,3));
        $arrData    =  cUrl($this->apiUrl."adminList","post","token=".$this->token."&vdata=".$vdata);
        $arrData    = json_decode($arrData);

        // echo $arrData; exit();

        $data['adminlist'] = $arrData;

        $dataInfo['title']      = 'admin';
        $dataInfo['sub_title']  = 'administ';
        $dataInfo['temp']       = $this->load->view('admin/mainList',$data,true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function autoc($type){

        $com = '';

        $this->load->model('MMaster');

        if($type == 'product'){
            $com = $this->MMaster->autocProduct();
        }else if($type == 'distributor'){
            $com = $this->MMaster->autocDistributor();
        }
        echo json_encode($com);
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
    

}
