<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

  	public function __construct(){
	    parent::__construct();

	    $this->keyword = $this->config->config['keyword'];
    	$this->apiUrl  = $this->config->config['api_url'];
        $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
    	// $this->token   = '4ddfdgghrdfyjhtuoookgftyu';

  	}

	public function index(){

        // $chkCookie  = true;
        // $arrCookie  = array('token','lang');

        // foreach ($arrCookie as $value) {
        //   if(isset($_COOKIE[$this->keyword.$value])){
        //     $chkCookie = false;
        //   }else{
        //     $chkCookie  = true;
        //   }
        // }

        // // debug(444,true);

        // if($chkCookie == false){
        //     $data                   = array();
        //     // $data['messageShow']    = messageRunning($this->token);
        //     // $data['senior']         = seniorMessage($this->token);
        //     $data['title']          = $this->lang->line('main_menu');

        //     $this->load->view('layout/app',$data);
        // }else{
        //     redirect('login','refresh');
        // }
        $data                   = array();
        $this->load->view('layout/app',$data);

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


}
