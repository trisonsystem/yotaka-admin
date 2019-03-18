<?php
$ci = get_instance(); // CI_Loader instance
$api_url  = $ci->config->config['api_url'];
$des_key  = $ci->config->config['des_key'];
$keyword  = $ci->config->config['keyword'];

$ci->load->config('config');
$ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => 'lang_'));
if (!isset($_COOKIE[$keyword."Lang"])) { $_COOKIE[$keyword."Lang"] = "en"; }
$lang = $_COOKIE[$keyword."Lang"];
$cashName = "LangYotakaAdmin_".$lang;
// debug($_COOKIE, true);

// if (!$result = $ci->cache->get($cashName))
// {
  	$aData      = array("lang" => $lang);
    $arrData    = json_encode($aData);
    $dataInfo   = TripleDES::encryptText($arrData, $des_key);
    $param      = http_build_query(array('data' => $dataInfo));
    $apiUrl     = $api_url.'/language/getLang';
    $result  = cUrl($apiUrl,"post",$param);
    // debug(json_decode($result));
  	$ci->cache->save($cashName, $result, 1 * 1440 * 365); // 1 year
// }

$decode = json_decode($result);
$lang   = array();
if(!empty($decode)){
	foreach ($decode as $k => $v) {
		$lang[$k] = $v;			
	}
}


