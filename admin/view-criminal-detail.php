<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['crmsaid']==0)) {
  header('location:logout.php');
  } else{
     
?>
<!doctype html>
<html class="fixed">
	<head>
		<title>Crime Record Management System | Criminals Detail </title>
		
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
						<h2>Criminal Detail</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>View</span></li>
								<li><span>Criminal Detail</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					
					<div class="row">
						<div class="col-md-12">
							<?php
                   $vid=$_GET['viewid'];
$sql="SELECT * from tblcriminal where ID=:vid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vid',$vid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
							 <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
							<tr>
<td colspan="6" style="font-size:20px;color:red;text-align: center;">
 Criminal ID: <?php  echo $row->CriminalID;?></td>
</tr>

 <tr>
    <th>Police Station</th>
    <td><?php  echo htmlentities($row->PoliceStation);?></td>
     <th>Crime Type</th>
    <td><?php  echo htmlentities($row->CatName);?></td>
    <th>Crime Date</th>
    <td><?php  echo htmlentities($row->CrimeDate);?></td>
  </tr>
  <tr>
    <th>Crime Time</th>
    <td><?php  echo htmlentities($row->CrimeTime);?></td>
     <th>Criminal Jail</th>
    <td><?php  echo htmlentities($row->Prison);?></td>
    <th>Criminal Court</th>
    <td><?php  echo htmlentities($row->Court);?></td>
  </tr>
   <tr>
    <th>Crime Time</th>
    <td><?php  echo htmlentities($row->CrimeTime);?></td>
     <th>Criminal Jail</th>
    <td><?php  echo htmlentities($row->Prison);?></td>
    <th>Criminal Court</th>
    <td><?php  echo htmlentities($row->Court);?></td>
  </tr>
  <tr>
  <td colspan="6" style="font-size:20px;color:red;">
 Criminal Detail</td></tr>
  <tr>
    <th>Name</th>
    <td><?php  echo htmlentities($row->Name);?></td>
     <th>Contact Number</th>
    <td><?php  echo htmlentities($row->ContactNumber);?></td>
    <th>Height</th>
    <td><?php  echo htmlentities($row->Height);?></td>
  </tr>
  <tr>
    <th>Weight</th>
    <td><?php  echo htmlentities($row->Weight);?></td>
     <th>Date of Birth</th>
    <td><?php  echo htmlentities($row->DateofBirth);?></td>
    <th>Email(if any)</th>
    <td><?php  echo htmlentities($row->Email);?></td>
  </tr>
   <tr>
    <th>Address</th>
    <td><?php  echo htmlentities($row->Address);?></td>
     <th>City</th>
    <td><?php  echo htmlentities($row->City);?></td>
    <th>State</th>
    <td><?php  echo htmlentities($row->State);?></td>
  </tr>
  <tr>
    <th>Country</th>
    <td><?php  echo htmlentities($row->Country);?></td>
     <th>Zipcode</th>
    <td><?php  echo htmlentities($row->Zipcode);?></td>
    <th>Phote</th>
    <td><img src="../police/images/<?php echo $row->Photo;?>" width="100" height="100" value="<?php  echo $row->Photo;?>"></td>
  </tr>
  </table><?php $cnt=$cnt+1;}} ?>		  
							
							
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