<?php

function debug($model,$exit=null){

    echo '<pre>'; print_r($model); echo '</pre>';

    if($exit==true){
        exit;
    }
}

function cUrl($url, $method = "get", $data = "", $ssl = false){
    if ($method == "post"){
        if ($data == "") return false;
    }
    $ch = curl_init();
    if ($method == "get") curl_setopt($ch, CURLOPT_URL, $url.($data != "" ? "?".$data : ""));
    else if ($method == "post") curl_setopt($ch, CURLOPT_URL, $url);
    if ($method == "post"){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
    //curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200); //Added in cURL 7.16.2. Available since PHP 5.2.3.
    curl_setopt($ch, CURLOPT_TIMEOUT, 200); //20 second (X * 10 second)
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}


function encode($string =''){

    $ci         = get_instance();
    $arrData    = json_encode($string);
    $dataInfo   = TripleDES::encryptText($arrData,$ci->config->config['des_key']);
    $dataInfo   = base64_encode($dataInfo);

    return $dataInfo;
}

function decode($string) {

    $ci          = get_instance();
    $p_data      = base64_decode($string);
    $dataInfo    = TripleDES::decryptText($p_data,$ci->config->config['des_key']);
    $dataInfo    = json_decode($dataInfo,true);

    return $dataInfo;
    
}