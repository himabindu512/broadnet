<?php
include ("cms/common.php");
if( isset($_SESSION['user_id'])){
	header("Location:../home/");
	exit();
}
$pageid=1;
?>
<base href="<?php echo ROOT_PATH; ?>" />

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale = 1.0" />
        <?                
    $pages_query=$db->select("select * from pages where id='$pageid'");
    $pages=$db->get_row($pages_query,'MYSQL_BOTH');
?>
<title>Register | Friday Prayers Evaluation</title>
<meta name="description" content=" <?=$pages['metadesc']?>"/>
<meta name="keywords" content="<?=$pages['keywords']?>"/>

<style type="text/css">.fancybox-margin{margin-right:17px;}</style></head>

<?php include("includes/header.php");?>	

<?= _getPageDescNav('تسجيل بيانات مشترك جديد'); ?>

<div class="content-wrapper"><div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<div class="gdlr-lms-content">
			<div class="gdlr-lms-container gdlr-lms-container">
				<div class="gdlr-lms-item">
					<form  class="gdlr-lms-form" name="myForm" method="post" id="validate-2" enctype="multipart/form-data"  action="">
						<div class="clear"></div>
						
						<!--<p class="gdlr-lms-half-left">
							<label>تاريخ الميلاد  *</label>
							<input type="text" name="dob" id="dob" class="input-large datepick" placeholder="yyyy-mm-dd" required>
							<span style="color:#f00;" class="error_dob"></span>
						</p>
                        
                        <p class="gdlr-lms-half-left">
                            <label>الهاتف </label>
                            <input type="text" name="mobile" id="mobile" required>
                            <span style="color:#f00;" class="error_phone"></span> 
                        </p>
						<div class="clear"></div>-->
						
                        
                        <p class="gdlr-lms-half-right">
                            <label>الإسم الكامل *</label>
                            <input type="text" name="name" id="name" required>
                            <span style="color:#f00;" class="error_name"></span>
                        </p>
						<p class="gdlr-lms-half-right">
							<label>بلد الإقامة *</label>
							<select name="country" id="country" style="width: 100%;height: 44px;" required>
								<option value=""> إختيار البلد </option>
								<option value="Lebanon"> Lebanon </option>
								<!--<? foreach( _getCountriesDetails() as $country ): ?>
									<option value="<?= $country['short_name'] ?>"><?= $country['short_name'] ?></option>
								<? endforeach ?> -->
							</select>					
							<span style="color:#f00;" class="error_country"></span>
						</p>
						<div class="clear"></div>
						
						<p class="gdlr-lms-half-left">
							<label>كلمة المرور *</label>
							<input type="password" name="password" id="password" required="">
							<span style="color:#f00;" class="error_password"></span>
						</p>	
						<p class="gdlr-lms-half-right">
							<label>البريد الإلكتروني*</label>
							<input type="text" name="email" id="email" required>
							<span style="color:#f00;" class="error_email"></span>
						</p>
						<div class="clear"></div>
                        <?if(!isset($_SESSION['user_id'])){?>
    <a href="javascript:void(0)" class="btn btn-default" onclick="fb_login();"><img style="float: left;" src="img/fb_login.png"/></a>
<div class="clear"></div><div class="clear"></div></br></br>
	<a class="login" href="http://fridayprayersevaluation.com/login_with_google/"><img src="img/google-login-button.png" /></a>


    <?}?>
						<span style="color:#f00;" class="failure_message"></span>
						<span style="color:green;" class="success_message"></span>
						<p>
							<input type="hidden" name="action" value="create-new-user">
							<input type="submit" name="submit" class="gdlr-lms-button" value="تسجيل ">
						</p>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include("includes/footer.php");?>
<? //include("includes/reg-profile-footer.php"); ?>

<script>
function IsEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}
$("form#validate-2").submit(function(){
	var errorCount = 0;
	$('.error_email').html('');
	$('.failure_message').html('');
	
	var email = $('#email').val();
	if( !IsEmail( email ) ){
		$('.error_email').html('Enter Valid Email  Address');
		errorCount++;
	}else{
		$('.error_email').html('');
	}
	
	if( errorCount > 0 ){
		return false;
	}
	
	var formData = new FormData($(this)[0]);
	$.ajax({
		url: 'ajax/register.php',
		type: 'POST',
		data: formData,
		async: false,
		success: function (data){
			if( data.trim() == 'email-exist' ){
				$('.error_email').html('This Email has been used before please try another one');
			}else if( data.trim() == 'fail' ){
				$('.failure_message').html('Something Went Wrong.. ');
			}else if( data.trim() == 'ok' ){
				$('.success_message').html('Registered Successfully');
				setTimeout(function(){ 
					document.location = '';
				}, 4000);
			}
			
		},
		cache: false,
		contentType: false,
		processData: false
	});
	return false;
});


</script>