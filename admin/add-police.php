<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['crmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


$pid=$_POST['pid'];
$name=$_POST['name'];
$mobnum=$_POST['mobnum'];
$email=$_POST['email'];
$address=$_POST['address'];
$password=md5($_POST['password']);
$pstation=$_POST['policestation'];
$pdata=explode(",",$pstation);
$psid=$pdata[0];
$psname=$pdata[1];
$ret="select PID from tblpolice where PID=:pid";
 $query= $dbh -> prepare($ret);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{

$sql="insert into tblpolice(PoliceStationId,PoliceStationName,PID,Name,MobileNumber,Email,Address,Password)values(:psid,:psname,:pid,:name,:mobnum,:email,:address,:password)";
$query=$dbh->prepare($sql);
$query->bindParam(':psid',$psid,PDO::PARAM_STR);
$query->bindParam(':psname',$psname,PDO::PARAM_STR);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Police detail has been added.")</script>';
echo "<script>window.location.href ='add-police.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
else
{

echo "<script>alert('Police Id  already exist. Please try again');</script>";
}
}

?>
<!doctype html>
<html class="fixed">
	<head>
		<title>Crime Record Management System | Add Police</title>
		
		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
		<?php include_once('includes/header.php');?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include_once('includes/sidebar.php');?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Add Police</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Add</span></li>
								<li><span>Police</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" method="post">
								 
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Add Police Detail</h2>
									
									</header>
									<div class="panel-body">
										<div class="validation-message">
											<ul></ul>
										</div>

<div class="form-group">
											<label class="col-sm-3 control-label">Police Station <span class="required">*</span></label>
											<div class="col-sm-9">
												<select type="text" class="form-control" name="policestation" value="" required="true">
													<option value="">Select Police Station</option>
							 	<?php 

$sql2 = "SELECT * from  tblpolicestation";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->id.','.$row->PoliceStationName);?>"><?php echo htmlentities($row->PoliceStationName);?>-(<?php echo htmlentities($row->PoliceStationCode);?>)</option>
 <?php } ?>
			

 												</select>
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-3 control-label">Police ID <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="pid" value="" required='true'>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="name" value="" required="true">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Email</label>
											<div class="col-sm-9">
												<input type="email" class="form-control" name="email" value="" required='true'>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Mobile Number <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="mobnum" value="" required='true' maxlength='10'>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Address<span class="required">*</span></label>
											<div class="col-sm-9">
												<textarea type="text" class="form-control" id="email2" name="address" value="" required='true'></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Password<span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="password" class="form-control" name="password" value="" required='true'>
											</div>
										</div>
									</div>
									<footer class="panel-footer">
										<div class="row">
											<div class="col-sm-9 col-sm-offset-3">
												<button class="btn btn-sm btn-primary login-submit-cs" type="submit"name="submit">Add</button>
											
											</div>
										</div>
									</footer>
								</section>
							</form>
						</div>
					
					</div>
					<!-- end: page -->
				</section>
			</div>

		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/forms/examples.validation.js"></script>
	</body>
</html><?php }  ?>