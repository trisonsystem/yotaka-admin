<?php
header('Access-Control-Allow-Origin: *');

class LanguageController extends CI_Controller {
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
        $data['title']          = $this->lang->line('manage_language_data');

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Language/list',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function search_language(){
        $json_data  = $this->sent_to_api( '/language/search_language', $_GET );
        echo $json_data;
    }

    public function save_data(){
        // $_POST["user"] = $_COOKIE[$this->keyword."user"];
        // $_POST["hotel_id"] = $_COOKIE[$this->keyword."hotel_id"];        
        $json_data  = $this->sent_to_api( '/language/save_data', $_POST );        
        echo $json_data;
    }

    public function chang_status(){
        // debug($_POST);
        // $_POST["user"] = $_COOKIE[$this->keyword."user"];        
        $json_data     = $this->sent_to_api( '/language/chang_status', $_POST );
        echo $json_data;
    }

    // ********************************************************************************

    public function sent_to_api( $path, $aData){
        $aData      = ($aData == "") ?  $this->arr_sent : $aData;
        $arrData    = json_encode($aData);
        $dataInfo   = TripleDES::encryptText($arrData, $this->des_key);
        $param      = http_build_query(array('data' => $dataInfo));
        $apiUrl     = $this->api_url.$path;
        $json_data  = cUrl($apiUrl,"post",$param);
        return $json_data;
    }

    public function get_language( $aData = "" ){
        $aData      = ( isset($_GET['lang']) ) ? $_GET : $aData ;
        $json_data  = $this->sent_to_api( '/language/getLang', $aData );
        return $json_data;
    }

    public function getLang( ){ 
        $cashName = "LangYotakaAdmin_".$_GET["lang"];
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => 'cache_'));

        if (!$this->cache->get($cashName)){
            $json_data  =  $this->get_language();

            $this->cache->save($cashName, $json_data, 1440 * 365);
        }else{
            $json_data = $this->cache->get($cashName);
        }
     // debug($json_data);
        echo $json_data;
    }
    
    public function change_lang(){ 
        $json_data  =  $this->get_language();
        echo $json_data;
    }
}