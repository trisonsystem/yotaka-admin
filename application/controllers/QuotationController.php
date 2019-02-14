<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuotationController extends CI_Controller {

  	public function __construct(){
	    parent::__construct();

	    $this->keyword = $this->config->config['keyword'];
    	$this->apiUrl  = $this->config->config['api_url'];
        $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
    	// $this->token   = '4ddfdgghrdfyjhtuoookgftyu';

  	}

	public function index(){ 
		 $this->create_quotation( );
	}

    public function edit_quotation( $quotation_id ){
        $this->create_quotation( $quotation_id );
    }

    public function create_quotation( $quotation_id = "" ){
        $this->load->model('MQuotation');
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = 'สร้างใบเสนอสินค้า';
        $data['product']        = $this->get_product();
        $data['address']        = $this->get_address( 1 );
        $data['quotation']      = $this->MQuotation->get_data_quotation( $quotation_id );
        $data['quotation_list'] = $this->MQuotation->get_data_quotation_list( $quotation_id );
        
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Quotation/index',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function get_product(){
        $this->load->model('MProduct');
        $pd = $this->MProduct->getProduct_all();
        return $pd;
    }

    public function save(){
        $this->load->model('MQuotation');
        $res = $this->MQuotation->save_data( $_POST );

        print_r( json_encode($res) );
    }

    public function quotation_list(){
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = 'ใบเสนอสินค้า';

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Quotation/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function get_quotation_list(){
        $this->load->model('MQuotation');
        $res = $this->MQuotation->getQuotaion( $_GET );
        print_r( json_encode($res) );
    }

    public function get_address( $id = "" ){
        $id = (isset($_GET['pd_id'])) ? $_GET['pd_id'] : $id;
        $this->load->model('MAddress');
        $pd = $this->MAddress->get_data( $id );
        return $pd;
    }

    public function get_quotation_pd_list(){
        $this->load->model('MQuotation');
        $res = $this->MQuotation->getQuotaion_pd_list( $_GET );
        print_r( json_encode($res) );
    }

    public function delete(){
        $this->load->model('MQuotation');
        $res = $this->MQuotation->delete_data( $_POST );
        print_r( json_encode($res) );
    }

    public function approve(){
        $this->load->model('MQuotation');
        $res = $this->MQuotation->approve_data( $_POST );
        print_r( json_encode($res) );
    }

    public function no_approve(){
        $this->load->model('MQuotation');
        $res = $this->MQuotation->no_approve_data( $_POST );
        print_r( json_encode($res) );
    }


}