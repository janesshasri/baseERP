<?php
$status = session_status();
if($status == PHP_SESSION_NONE){
    session_start();
}
ob_start();
//echo $_SESSION['aid'];
if($_SESSION['aid']!='')
{
	header('location:home.php');
}
include("./includes/connection.php");
include("./class/functions.php");
include("./class/login.php");
$PgeNme = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
$DomainName = explode('/',$PgeNme);

$Login = new Login();
if(isset($_POST['FgtPwdSubmit']))
{
	$Result = $Login->ForgotPassword($_POST);	
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>e-schoolz ERP</title>
<link rel="stylesheet" type="text/css" href="css/style_index.css" />
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#FgtPwdSubmit").click(function(){
		var fgtpwdemail = $("#fgtpwdemail").val();
		if(fgtpwdemail.length == 0){
			$("#user-result").html('Please enter Email');
			$("#user-result").css({ 'color': 'red'});
			return false;
		}
		return true;
	})
	$("#fgtpwdemail").change(function (e) {
		$(this).val($(this).val().replace(/\s/g, ''));
		var fgtpwdemail = $(this).val();
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if (filter.test(fgtpwdemail)) {
			//$("#user-result").html('<img src="images/c-ajax-loader.gif" />');
			$.post('check_password.php', {'fgtpwdemail':fgtpwdemail}, function(data) {
				if(data == 1){ $("#fgtpwdemail").val( '' ); $("#user-result").html('Enter Correct Email ');$("#user-result").css({ 'color': 'red'}); }else{ $("#user-result").html(''); }
			});
		}else {
			$("#fgtpwdemail").val( '' ); $("#user-result").html('Enter Correct Email ');
			$("#user-result").css({ 'color': 'red'});
		}
	});	
	
	var res = '<?=$Result?>';
	if(res == 2){ $("#user-result").html('Login details has been send to your registered email.'); $("#user-result").css({ 'color': 'green'}); }
});

</script>
<style>
.btn_red { border-radius: 10px;
    height: 50px;
    width: 150px;
	 /* IE10 Consumer Preview */ 
background-image: -ms-linear-gradient(top, #099FBC 0%, #007D8B 100%);
/* Mozilla Firefox */ 
background-image: -moz-linear-gradient(top, #099FBC 0%, #007D8B 100%);
/* Opera */ 
background-image: -o-linear-gradient(top, #099FBC 0%, #007D8B 100%);
/* Webkit (Safari/Chrome 10) */ 
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #099FBC), color-stop(1, #007D8B));
/* Webkit (Chrome 11+) */ 
background-image: -webkit-linear-gradient(top, #099FBC 0%, #007D8B 100%);
/* W3C Markup, IE10 Release Preview */ 
background-image: linear-gradient(to bottom, #099FBC 0%, #007D8B 100%);	}

.btn_red:hover {
	 border-radius: 10px;
    height: 50px;
    width: 150px;
	/* IE10 Consumer Preview */ 
background-image: -ms-linear-gradient(top, #099FBC 0%, #007D8B 100%);
/* Mozilla Firefox */ 
background-image: -moz-linear-gradient(top, #099FBC 0%, #007D8B 100%);
/* Opera */ 
background-image: -o-linear-gradient(top, #099FBC 0%, #007D8B 100%);
/* Webkit (Safari/Chrome 10) */ 
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #099FBC), color-stop(1, #007D8B));
/* Webkit (Chrome 11+) */ 
background-image: -webkit-linear-gradient(top, #099FBC 0%, #007D8B 100%);
/* W3C Markup, IE10 Release Preview */ 
background-image: linear-gradient(to bottom, #099FBC 0%, #007D8B 100%);	}
</style>
</head>
<body>
  <div id="main">
    <div id="header">
      <div id="logo">
      <div id="logo_top"></div>
          <ul id="logo_text">
          	<li style="text-align:right; width:696px;"><a href="index.php"><img src="resetImages/eSchoolzLogo.png" width="200" height="50"></a></li>
            <li style="text-align:left; width:239px; color:#999; padding:10px;">Call us: +91 9677573737<br>
            		Email: eschoolz.support@gmail.com
            </li>
          </ul>
          
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <!--<div id="banner"></div>-->
      <div id="content">
      <div id="content_left" style="padding:25px 0 0 20px;">
        <!-- insert the page content here -->
        
        <span style="font-size:20px; color:#FFF;"><b style="background-color:#00ABCB; padding:5px;">Highlighted</b> Features</span><br><br><br>
        <span style="font-size:16px; padding:0 0 0 20px;"><img src="images/tick.png" width="22" height="22"> &nbsp;Web Based School Management School Software service integrated with</span><br>
        <span style="font-size:16px; padding:0 0 0 52px;"> SMS alerts.</span><br><br>
        <span style="font-size:16px; padding:0 0 0 20px;"><img src="images/tick.png" width="22" height="22"> &nbsp;Student Management</span><br><br>
        <span style="font-size:16px; padding:0 0 0 20px;"><img src="images/tick.png" width="22" height="22"> &nbsp;Fees Management</span><br><br>
        <span style="font-size:16px; padding:0 0 0 20px;"><img src="images/tick.png" width="22" height="22"> &nbsp;Transport Management</span><br><br>
        <span style="font-size:16px; padding:0 0 0 20px;"><img src="images/tick.png" width="22" height="22"> &nbsp;Bulk SMS with Multi Lingual Support</span><br><br><br><br>        
       <!-- <p style="color:#00ABCB; font-size:24px;" align="center">and more..</p>-->
       <br><br><br>
      </div>
	  <div id="content_right">
        <div class="sidebar">
          <div class="sidebar_top"></div>
          <form name="FgtPwdForm" id="FgtPwdForm" method="post">
          <input type="hidden" name="SubDmnName" value="<?=$DomainName[1]?>">
          <input type="hidden" name="DmnName" value="<?=$DomainName[0]?>">
          <div class="sidebar_item">
            <h3>Forgot Password</h3>
            <span><input type="text" name="fgtpwdemail" id="fgtpwdemail" placeholder="Enter Email" class="login_input" /></span><br><br>
            <div><span id="user-result"></span></div><br>
            <span style="margin:0 0 0 20px;"><input type="submit" class="btn_red" id="FgtPwdSubmit" style="width: 100px; height:35px;" name="FgtPwdSubmit" value="Submit"/></span> &nbsp; &nbsp;<span style="color:#C00;"><a id="modal_trigger" href="index.php" class="btn">Sign In</a></span>
          </div>
          </form>
          <div class="sidebar_base"></div>
        </div>
        
      </div>
      </div>
      <div id="content">
      	<p align="center" style="font-size:24px; color:#FFF; padding:0 0 20px 0;">---- More Benefits ----</p>
        <div style="padding:0 0 10px 0; width:980px;">
        <ul>
        	<li id="content_li"><img src="images/bullet-points.png" width="10" height="10"> Online Education Management System</li>
            <li id="content_li"><img src="images/bullet-points.png" width="10" height="10"> One Stop Education Management System</li>
            <li id="content_li"><img src="images/bullet-points.png" width="10" height="10"> Zero Manual Errors</li>
        </ul>
        </div>
        <div style="padding:0 0 10px 0; width:980px;">
        <ul>
        	<li id="content_li"><img src="images/bullet-points.png" width="10" height="10"> Cloud Based Technology</li>
            <li id="content_li"><img src="images/bullet-points.png" width="10" height="10"> End - End Auotmation Process</li>
            <li id="content_li"><img src="images/bullet-points.png" width="10" height="10"> Easy - Easy User Interface</li>
        </ul>
        </div>
      </div>
    </div>
    
  </div>
<div id="footer">
      <p>Copyright &copy; <?=date('Y')?> e-Schoolz. All rights reserved.</p>
</div>
</body>
</html>
