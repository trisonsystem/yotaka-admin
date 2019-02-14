<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImportOrderController extends CI_Controller {

  	public function __construct(){
	    parent::__construct();

	    $this->keyword = $this->config->config['keyword'];
    	$this->apiUrl  = $this->config->config['api_url'];
        $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
    	// $this->token   = '4ddfdgghrdfyjhtuoookgftyu';

  	}

	public function index(){

        $data = array();

        $arrMonth = array('01'=>'JAN','02'=>'FEB','03'=>'MAR','04'=>'APR','05'=>'MAY','06'=>'JUN','07'=>'JUL','08'=>'AUG','09'=>'SEP','10'=>'OCT','11'=>'NOV','12'=>'DEC');

        // echo (int)date('m');

        // echo $arrMonth[date('m')];
        $data['billNo'] = $arrMonth[date('m')]."-001";

        $dataInfo['title']      = 'admin';
        $dataInfo['sub_title']  = 'Import Order';
        $dataInfo['temp']       = $this->load->view('importOrder/mainImport',$data,true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function saveImportOrder(){
        debug($this->input->post());
    }

	public function adminList(){

        $data = array();


        // $vdata      = json_encode(array(1,3));
        // $arrData    =  cUrl($this->apiUrl."adminList","post","token=".$this->token."&vdata=".$vdata);
        // $arrData    = json_decode($arrData);

        // echo $arrData; exit();

        // $data['adminlist'] = $arrData;

        // $dataInfo['title']      = 'admin';
        // $dataInfo['sub_title']  = 'Import Order';
        // $dataInfo['temp']       = $this->load->view('importOrder/mainImport',$data,true);

        // $this->output->set_output(json_encode($dataInfo));
    }


}
