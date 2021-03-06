<?php

header('Access-Control-Allow-Origin: *');

class PaymentController extends CI_Controller {
    public $strUrl = "";
    public function __construct(){
        parent::__construct();

        $this->keyword  = $this->config->config['keyword'];
        $this->api_url  = $this->config->config['api_url'];
        $this->des_key  = $this->config->config['des_key'];
        $this->arr_sent = array("time_now" => date("Y-m-d H:i:s"));
    }

    public function payment_list(){ 
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = $this->lang->line('payment_list');
        $data['status_payment'] = $this->search_payment_status("");
        $data['bank']           = $this->search_bank("");
        $data['bank_list']      = $this->search_bank_list("");
        $data['payment_type']   = $this->search_payment_type("");

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('payment_list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function sent_to_api( $path, $aData){
        $aData["hotel_id"]  = $_COOKIE[$this->keyword."hotel_id"];
        $aData["user"]      = $_COOKIE[$this->keyword."user"];
        $aData["lang"]      = $_COOKIE[$this->keyword."Lang"];
        $aData      = ($aData == "") ?  $this->arr_sent : $aData;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url.$path;
        $json_data  = cUrl($apiUrl,"post",$param);
        return $json_data;
    }

    public function search_payment( $aData = "" ){
        // debug($_GET, true);
    	$aData      = ( isset($_GET['payment_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/payment/search_payment', $aData );
       	echo $json_data;
    }

    public function search_payment_status( $aData = "" ){
        $aData      = ( isset($_GET['payment_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/payment/search_payment_status', $aData );
        return json_decode($json_data);
    }

    public function search_bank( $aData = "" ){
        $aData      = ( isset($_GET['bank_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/bank/search_bank', $aData );
        return json_decode($json_data);
    }

    public function search_bank_list( $aData = "" ){
        $aData      = ( isset($_GET['bank_id']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/bank/search_bank_list', $aData );
        return json_decode($json_data);
    }

    public function search_payment_type( $aData = "" ){
        $json_data  = $this->sent_to_api( '/payment/search_payment_type', $aData );
        return json_decode($json_data);
    }

     public function chang_status(){
        $json_data     = $this->sent_to_api( '/payment/chang_status', $_POST );
        echo $json_data;
    }

    public function search_booking(){
        $json_data  = $this->sent_to_api( '/payment/search_booking', $_GET );
        echo $json_data;
    }

    public function search_booking_cusprofile(){
        $json_data  = $this->sent_to_api( '/payment/search_booking_cusprofile', $_GET );
        echo $json_data;
    }

    public function search_booking_cusprofile_notin(){
        $json_data  = $this->sent_to_api( '/payment/search_booking_cusprofile_notin', $_GET );
        echo $json_data;
    }

    public function search_promotion_codeanddate(){
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];
        $promotion_data = array(
            'check_in' => $_GET['check_in'],
            'check_out' => $_GET['check_out'],
            'promotion_code' => $_GET['promotion_code'],
            'room_type' => $_GET['room_type']
        );

        $booking_data = array(
            'booking_id' => $_GET['booking_id'],
            'is_waitpayment' => $_GET['is_waitpayment']
        );

        $array_promotion  = json_decode($this->sent_to_api( '/promotion/search_promotion_codeanddate', $promotion_data ), true);
        $array_booking  = json_decode($this->sent_to_api( '/payment/search_booking', $booking_data ), true);

        if (count($array_promotion) == 0) {
            $data = "";
        } else {
            for ($j=0; $j < count($array_promotion); $j++) { 
                for ($i=0; $i < count($array_booking); $i++) {
                    $b_typeid = isset($array_booking[$i]['room_typeid']) ? $array_booking[$i]['room_typeid'] : 0;
                    $p_typeid = isset($array_promotion[$j]['m_room_type_id']) ? $array_promotion[$j]['m_room_type_id'] : 0;
                    if($b_typeid == $p_typeid){
                        // $pormotion_id = isset($array_promotion[$j]['id']) ? $array_promotion[$j]['id'] : "";
                        $discount = isset($array_promotion[$j]['discount']) ? $array_promotion[$j]['discount'] : 0;
                    }else{
                        // $pormotion_id = 0;
                        $discount = 0;
                    }
                    $data[$i] = array(
                        'room_code' => isset($array_booking[$i]['room_code']) ? $array_booking[$i]['room_code'] : "",
                        'room_name' => isset($array_booking[$i]['room_name']) ? $array_booking[$i]['room_name'] : "",
                        'room_typeid' => isset($array_booking[$i]['room_typeid']) ? $array_booking[$i]['room_typeid'] : "",
                        'room_type' => isset($array_booking[$i]['room_type']) ? $array_booking[$i]['room_type'] : "",
                        'room_price' => isset($array_booking[$i]['room_price']) ? $array_booking[$i]['room_price'] : "",
                        'promotion_id' => isset($array_promotion[$j]['id']) ? $array_promotion[$j]['id'] : "",
                        'discount'  => $discount,
                        'sum' => (isset($array_booking[$i]['room_price']) ? $array_booking[$i]['room_price'] : 0) - $discount
                    );
                }   
            }
        }
        
        $json_data = json_encode($data);
        echo $json_data;
    }

    public function save_data(){
        // debug($_POST, true);
        $_POST["user"] = $_COOKIE[$this->keyword."user"];
        $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];      
        $json_data  = $this->sent_to_api( '/payment/save_data', $_POST );  
        $aData      = json_decode($json_data);
       // debug($_POST["txtImages"], true);
        if ($aData->flag) {
            $fodel    = "assets/upload/payment_images/";
            $aFN      = explode(".", $_POST["txtImages"]);            
            $n_name   = $aFN[count($aFN)-1];            
            $n_path   = $fodel.$aData->code.".".$n_name;
            
            if ( count( explode("temp", $_POST["txtImages"]) ) > 1 ) {
                $this->copy_img($_POST["txtImages"], $n_path, $fodel);
            }
        }      
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