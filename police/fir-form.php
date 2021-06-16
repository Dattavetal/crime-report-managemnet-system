<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['crmsuid']==0)) {
  header('location:logout.php');
  } else{
      if(isset($_POST['submit']))
  {
  	$uid=$_SESSION['crmsuid'];
 $polsta=$_POST['polsta'];
  $crimetype=$_POST['crimetype'];
 $nofaccused=$_POST['nofaccused'];
 $name=$_POST['name'];
 $parentage=$_POST['parentage'];
  $connum=$_POST['connum'];
 $adress=$_POST['adress'];
 $relaccused=$_POST['relaccused'];
 $purpose=$_POST['purpose'];
 $firno=mt_rand(100000000, 999999999);
$sql="insert into tblfir(FIRNo,UserID,PoliceStation,CrimeType,NameAccused,NameApplicants,ParentageApplicant,ContactNumber,Address,RelationAccused,PurposeofFIR)values(:firno,:uid,:polsta,:crimetype,:nofaccused,:name,:parentage,:connum,:adress,:relaccused,:purpose)";
$query=$dbh->prepare($sql);
$query->bindParam(':firno',$firno,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->bindParam(':polsta',$polsta,PDO::PARAM_STR);
$query->bindParam(':crimetype',$crimetype,PDO::PARAM_STR);
$query->bindParam(':nofaccused',$nofaccused,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':parentage',$parentage,PDO::PARAM_STR);
$query->bindParam(':connum',$connum,PDO::PARAM_STR);
$query->bindParam(':adress',$adress,PDO::PARAM_STR);
$query->bindParam(':relaccused',$relaccused,PDO::PARAM_STR);
$query->bindParam(':purpose',$purpose,PDO::PARAM_STR);

 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Your FIR Request Has Been Send to us. We Will Contact You Soon")</script>';
echo "<script>window.location.href ='fir-form.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}

?>
<!doctype html>
<html class="fixed">
	<head>
		<title>Crime Record Management System | FIR Form</title>
		
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
						<h2>FIR Form</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Add</span></li>
								<li><span>FIR Form</span></li>
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

										<h2 class="panel-title">Criminals Details</h2>
									
									</header>
									<div class="panel-body">
										<div class="validation-message">
											<ul></ul>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Police Station <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="polsta" value="" required='true'>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Crime Type <span class="required">*</span></label>
											<div class="col-sm-9">
												<select type="text" class="form-control" name="crimetype" value="" required='true'>
													<option value="">Choose Crime Type</option>
							 	<?php 

$sql2 = "SELECT * from   tblcategory";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Crime Date <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="date" class="form-control" name="date" value="" required='true'>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Name of Accused <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="nofaccused" value="" required='true'>
											</div>
										</div>
										
										<p style="font-size: 18px;color: red;padding-left: 10px"> Applicant's Detail(Victim)</p>
										<div class="form-group">
											<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="name" value="" required='true'>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Parentage <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="parentage" value="" required='true'>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Contact Number <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="connum" value="" required='true' maxlength="10" pattern="[0-9]+">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Address<span class="required">*</span></label>
											<div class="col-sm-9">
												<textarea type="text" class="form-control"  name="adress" value="" required='true'></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Relation with accused person<span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="relaccused" value="" required='true'>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Purpose of applying copy of FIR<span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="purpose" value="" required='true'>
											</div>
										</div>
									</div>
									<footer class="panel-footer">
										<div class="row">
											<div class="col-sm-9 col-sm-offset-3">
												<button class="btn btn-sm btn-primary login-submit-cs" type="submit"name="submit">Submit</button>
											
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