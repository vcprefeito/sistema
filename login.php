<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage : Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body class="hold-transition login-page">
	<div class="login-box">
	<div class="login-logo">
   	 <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

	<div class="login-box-body">
     
        
       <form class="form-signin" method="post" id="login-form">        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
       	 	<input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
        	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
      	  	<input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
       	 	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Entrar
            </button>
        </div>  
      	<br />
            <label>Não possui uma conta?<a href="sign-up.php">Registrar-se</a></label>
      </form>

    </div>
    
</div>
	<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>

	<script src="../../bootstrap/js/bootstrap.min.js"></script>

	<script src="../../plugins/iCheck/icheck.min.js"></script>
	<script>
  		$(function () {
	    	$('input').iCheck({
      		checkboxClass: 'icheckbox_square-blue',
     		 radioClass: 'iradio_square-blue',
      		increaseArea: '20%' // optional
   		 });
 	 });
	</script>
</body>
</html>