<?php 
require '../main.php';
if(isset($_GET['lang'])){
	$_SESSION['countryCode']=$_GET['lang'];
 header("location: ".createPage($_GET['page']));
}
?>