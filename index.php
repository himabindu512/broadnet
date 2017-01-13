<?

include 'common.php'; 
// Reports

if(isset($_POST ['username'])){
	$userID = $db->select_one ( "select id from users where (email='" . $_POST ['username'] . "' or username='" . $_POST ['username'] . "') AND password='" . $_POST ['upw'] . "' and active=1 " );
	if ($userID > 0)
	{
			$sql = "select * from users where id= '".$userID."'";	
			$result = mysql_query($sql);
			$data = mysql_fetch_assoc($result);
			if($data['role']==1) { $role= "Admin"; }  
    else if($data['role']==2) { $role= "MedRep"; } 
    else if($data['role']==3) { $role= "Supervisor"; } 
    else if($data['role']==4) { $role= "Sales Man"; } 
    else if($data['role']==5) { $role= "Deal Manager"; } 

			
				 $_SESSION['CMSuserID'] = $data['id'];
				 $_SESSION['userEmail'] = $data['email'];
				 $_SESSION['userName'] = $data['name'];
				 $_SESSION['roleName'] = $role;
				 $_SESSION['role'] = $data['role'];    
                 if($data['role']==2||$data['role']==4){
                 $link="<script type=text/javascript>window.location='main.php?g=startyourday&p=45';</script>";
                 }else{
                 $link="<script type=text/javascript>window.location='main.php';</script>";
                 }
                 print($link);
			//header ( "Location: main.php" );
			exit();
	}
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>MedReps</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='login'>
	<div class="wrapper">
		<h1><a href="index.php"><img src="img/logo-big.png" alt="" class='retina-ready' width="59" height="49">MedReps</a></h1>
		<div class="login-body">
		 

			    <h2>SIGN IN</h2>
                <form action="" method='post' class='form-validate' id="test">
                <div class="control-group">
                <div class="email controls">
                <input type="text" name='username' placeholder="User Name" class='input-block-level' data-rule-required="true" >
                </div>
                </div>
                <div class="control-group">
                <div class="pw controls">
                <input type="password" name="upw" placeholder="Password" class='input-block-level' data-rule-required="true">
                </div>
                </div>
                <div class="submit">
                <input type="submit" value="Sign me in" class='btn btn-primary'>
                </div>
                </form>
                
                
			    <div class="operator" style="float:right; margin-left:50px"></div>
			<div>
               <?

					if (isset($userID) and @$userID == 0 ){
						echo "<p style='text-align:center;color:#B94A48;font-size: 14px;'>Incorrect username or password !</p>";
                }

				?>
</div>
			<div class="forget">
				<a href="#"><span>Forgot password?</span></a>
			</div>
		</div>
	</div>
	
</body>

</html>
