<?
include 'common.php';
//check if loggedIn
loggedIn ("index.php");
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
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- Tagsinput -->
	<link rel="stylesheet" href="css/plugins/tagsinput/jquery.tagsinput.css">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
    <!-- colorbox -->
    <link rel="stylesheet" href="css/plugins/colorbox/colorbox.css">
	<!-- multi select -->
	<link rel="stylesheet" href="css/plugins/multiselect/multi-select.css">
	<!-- timepicker -->
	<link rel="stylesheet" href="css/plugins/timepicker/bootstrap-timepicker.min.css">
	<!-- colorpicker -->
	<link rel="stylesheet" href="css/plugins/colorpicker/colorpicker.css">
	<!-- Datepicker -->
	<link rel="stylesheet" href="css/plugins/datepicker/datepicker.css">
	<!-- Plupload -->
	<link rel="stylesheet" href="css/plugins/plupload/jquery.plupload.queue.css">
	<!-- select2 -->
	<link rel="stylesheet" href="css/plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">
<!-- dataTables -->
	<link rel="stylesheet" href="css/plugins/datatable/TableTools.css">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.slider.js"></script>
    <!-- Touch enable for jquery UI -->
    <script src="js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
    <!-- slimScroll -->
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    

    <!-- imagesLoaded -->
    <script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Masked inputs -->
	<script src="js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
	<!-- TagsInput -->
	<script src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Datepicker -->
	<script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Timepicker -->
	<script src="js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- Colorpicker -->
	<script src="js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.min.js"></script>
    <!-- colorbox -->
    <script src="js/plugins/colorbox/jquery.colorbox-min.js"></script>
	<!-- MultiSelect -->
	<script src="js/plugins/multiselect/jquery.multi-select.js"></script>
	<!-- CKEditor -->
	<script src="js/plugins/ckeditor/ckeditor.js"></script>
	<!-- PLUpload -->
	<script src="js/plugins/plupload/plupload.full.js"></script>
	<script src="js/plugins/plupload/jquery.plupload.queue.js"></script>
	<!-- Custom file upload -->
	<script src="js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<script src="js/plugins/mockjax/jquery.mockjax.js"></script>
	<!-- select2 -->
	<script src="js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- complexify -->
	<script src="js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
	<script src="js/plugins/complexify/jquery.complexify.min.js"></script>



	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
	<script src="js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="js/plugins/datatable/TableTools.min.js"></script>
	<script src="js/plugins/datatable/ColReorder.min.js"></script>
	<script src="js/plugins/datatable/ColVis.min.js"></script>
	<script src="js/plugins/datatable/jquery.dataTables.columnFilter.js"></script>
    <!-- Wizard -->
    <script src="js/plugins/wizard/jquery.form.wizard.min.js"></script>
    <script src="js/plugins/mockjax/jquery.mockjax.js"></script>
    <!-- Validation -->
    <script src="js/plugins/validation/jquery.validate.min.js"></script>
    <script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body>

	<div id="navigation">
		<div class="container-fluid">
			<a href="main.php" id="brand">MedReps</a>
			<a href="#" style="display: none;" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<ul class='main-nav'>
            
                <li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="reports")) echo "class='active'";?>>
                    <a href="main.php?g=reports&p=4" >Reports</a>
                </li>
                <li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="routing")) echo "class='active'";?>>
                    <a href="main.php?g=routing&p=5" >Routing</a>
                </li>
                <?if($_SESSION['role']!=4){?> <li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="deals")) echo "class='active'";?>>
                    <a href="main.php?g=deals&p=25" >Deals</a>
                </li><?}?>
                <!--<li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="pendingdeals")) echo "class='active'";?>>
                    <a href="main.php?g=pendingdeals&p=26" >Pending Deals</a>
                </li>-->
                <!--<li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="medReps")) echo "class='active'";?>>
                    <a href="main.php?g=medReps&p=3" >Medreps</a>
                </li>-->
                <!--<li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="institutions")) echo "class='active'";?>>
                    <a href="main.php?g=institutions&p=1" >Institutions</a>
                </li>--><?if($_SESSION['role']!=2 and $_SESSION['role']!=4){?> 
                <li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="INAreas")) echo "class='active'";?>>
                    <a href="main.php?g=INAreas&p=13" >Review Areas</a>
                </li>
                <li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="INinstitutions")) echo "class='active'";?>>
                    <a href="main.php?g=INinstitutions&p=2" >Review Institutions</a>
                </li><?}?><?if($_SESSION['role']!=1){?> 
                <li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="change")) echo "class='active'";?>>
                    <a href="main.php?g=change&p=22" >Change Password</a>
                </li><?}?>
                <?if($_SESSION['role']==1){?>  <li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="products")) echo "class='active'";?>>
                    <a href="main.php?g=products&p=19" >Products</a>
                </li>              
 				<? }?>
                <li <? if ( (isset($_GET ['g'])) && ($_GET ['g']=="admin")) echo "class='active'";?>>
                
                     <a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
                    <?if($_SESSION['role']==2 or $_SESSION['role']==4){?> 
                        <li><a href="main.php?g=admin&p=16">Areas</a></li>
                        <li><a href="main.php?g=admin&p=1">Institutions</a></li>
                        <?}else{if($_SESSION['role']==3){?>
                        <li><a href="main.php?g=admin&p=16">Areas</a></li>
                        <li><a href="main.php?g=admin&p=1">Institutions</a></li>
                        <li><a href="main.php?g=admin&p=17">Specialties</a></li>
                        <li><a href="main.php?g=admin&p=18">InstitutionsTypes</a></li>
                        <li><a href="main.php?g=admin&p=23">Paying Intervals</a></li>
                        <li><a href="main.php?g=admin&p=24">Deals Follow up Intervals</a></li>
                        <!--<li><a href="main.php?g=admin&p=21">TimeVisit</a></li>-->
                        <?}elseif($_SESSION['role']==1){?>
                        <li><a href="main.php?g=admin&p=15">Users</a></li>
                        <li><a href="main.php?g=admin&p=16">Areas</a></li>
                        <li><a href="main.php?g=admin&p=1">Institutions</a></li>
                        <li><a href="main.php?g=admin&p=17">Specialties</a></li>
                        <li><a href="main.php?g=admin&p=18">InstitutionsTypes</a></li>
                        <li><a href="main.php?g=admin&p=23">Paying Intervals</a></li>
                        <li><a href="main.php?g=admin&p=24">Deals Follow up Intervals</a></li>
                        <!--<li><a href="main.php?g=admin&p=21">TimeVisit</a></li>-->
                        <?}}?>
					</ul>
				</li>
			</ul>
			<div class="user">
            <?
                        if(@$_GET['notID']){$db->update_sql ( " update notifications set active=0 where id='".$_GET['notID']."'"); }
                          $where=" where receiverId=".$_SESSION['CMSuserID']; 
                          $wherenot=" where active=1 and receiverId=".$_SESSION['CMSuserID']; 
                         $selectnotifications="select * from notifications $where order by id desc limit 5"; 
                         $selectnotificationsnot="select * from notifications $wherenot order by id desc limit 5"; 
            $notificationscount = mysql_num_rows(mysql_query($selectnotificationsnot));
            
            ?>
            
                <ul class="icon-nav">
                    <li class='dropdown'>
                        <a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope-alt"></i>
                        <?if($notificationscount>0){?><span class="label label-lightred"><?=$notificationscount?></span><?}?></a>
                        <ul class="dropdown-menu pull-right message-ul">
                        <? $querynotifications=mysql_query($selectnotifications);
                           while($notifications=mysql_fetch_assoc($querynotifications)) {?>
                            <li>
                                <a href="main.php?g=deals&p=25&edit=<?=$notifications['dealId']?>&notID=<?=$notifications['id']?>">
                                    <!--<img src="img/demo/user-1.jpg" alt="">-->
                                    <div class="details" style="max-width: 250px;">
                                        <div class="message" <?if($notifications['active']==1){?> style="background: #368ee0;color:white;"<?}?>><?=$notifications['title'].'<br>'.$notifications['brief']?></div>
                                    </div>
                                </a>
                            </li><?}?>
                        </ul>
                    </li>
                    
                </ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">
					<?=$_SESSION ['userName']; ?>|<?=$_SESSION ['roleName']; ?>
	                </a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="includes/logout.php">Sign out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="content">
		<div id="left" class="ui-sortable ui-resizable forced-hide" style="display: none;">
			
		</div>
        
		<div id="main" style="margin-left: 0px;">
        <?
			if (isset($_GET['p'])){
					
                    if($_GET['p']== 1)include "includes/institutions_list.php";    
                    if($_GET['p']== 2)include "includes/inactive_institutions_list.php";    
                    /*if($_GET['p']== 3)include "includes/medReps_list.php";    */
                    if($_GET['p']== 4)include "includes/reports_list.php";    
                    if($_GET['p']== 5)include "includes/routing_list.php";      
                    if($_GET['p']== 19)include "includes/products_list.php"; 
                    if($_GET['p']== 25 and $_SESSION['role']==4){include "includes/deals_salesman.php"; }elseif($_GET['p']== 25){include "includes/deals_list.php"; }
                    //if($_GET['p']== 26)include "includes/pending_deals_list.php";   
                    if($_GET['p']== 30)include "salesman_dashboard.php";
                    if($_GET['p']== 22)include "includes/changepassword.php";  
                    if($_SESSION['role']==2 or $_SESSION['role']==4){       
                    
                    if($_GET['p']== 16)include "includes/areaslist.php";    
                      
                    
                    }
                    elseif($_SESSION['role']==3){
                    if($_GET['p']== 16)include "includes/areaslist.php";    
                    if($_GET['p']== 13)include "includes/areas_list.php";    
                    if($_GET['p']== 17)include "includes/Specialties_list.php";    
                    if($_GET['p']== 18)include "includes/institutionTypes_list.php";
                    if($_GET['p']== 21)include "includes/TimeVisit_list.php";
                    if($_GET['p']== 23)include "includes/payingintervals_list.php";
                    if($_GET['p']== 24)include "includes/dealsfollowupIntervals_list.php";
                    
                    }elseif($_SESSION['role']==1){                              
                    if($_GET['p']== 15)include "includes/user_list.php";    
                    if($_GET['p']== 16)include "includes/areaslist.php";    
                    if($_GET['p']== 13)include "includes/areas_list.php";    
                    if($_GET['p']== 17)include "includes/Specialties_list.php";    
                    if($_GET['p']== 18)include "includes/institutionTypes_list.php";
                    if($_GET['p']== 21)include "includes/TimeVisit_list.php";
                    if($_GET['p']== 23)include "includes/payingintervals_list.php";
                    if($_GET['p']== 24)include "includes/dealsfollowupintervals_list.php";
                    
                    
                    }
                    
			}else{
                if($_SESSION['role']==2){
                include "medrep_dashboard.php";    
                }elseif($_SESSION['role']==4){
                include "salesman_dashboard.php";    
                }else{
                include "main_dashboard.php";
                }
            }
		?>
        
        </div>
       </div>
		
	</body>

	</html>

<style type="text/css">
.form-vertical.form-bordered .control-group {
    border-bottom: 0px solid #ddd;
    padding: 10px 20px;
}
.pickers{
 float: right;
 margin-top: -35px; 
 position: relative;
 margin-right: 5px;  
}
</style>