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

		<title>Crime Record Management System | View Criminals</title>
		
		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

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
						<h2>View Criminals</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>View</span></li>
								<li><span>Criminals</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">View Criminals</h2>
							</header>
							<div class="panel-body">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-editable">
									<thead>
										<tr>
											<th>S.No</th>
											<th>Police Station</th>
											<th>Criminals ID</th>
											<th>Name(s)</th>
											<th>Mobile Number</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
$sql="SELECT * from tblcriminal";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php  echo htmlentities($row->PoliceStation);?>
											</td>
											<td><?php  echo htmlentities($row->CriminalID);?>
											</td>
											<td><?php  echo htmlentities($row->Name);?></td>
											<td>
												<?php  echo htmlentities($row->ContactNumber);?>
											</td>
											
											<td>
												<a href="view-criminal-detail.php?viewid=<?php echo htmlentities ($row->ID);?>"><i class="fa fa-eye"></i></a>
												
											</td>
										</tr>
									
									<?php $cnt=$cnt+1;}} ?>	
									</tbody>
								</table>
							</div>
						</section>
					<!-- end: page -->
				</section>
			</div>

		</section>

		<div id="dialog" class="modal-block mfp-hide">
			<section class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">Are you sure?</h2>
				</header>
				<div class="panel-body">
					<div class="modal-wrapper">
						<div class="modal-text">
							<p>Are you sure that you want to delete this row?</p>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button id="dialogConfirm" class="btn btn-primary">Confirm</button>
							<button id="dialogCancel" class="btn btn-default">Cancel</button>
						</div>
					</div>
				</footer>
			</section>
		</div>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.editable.js"></script>
	</body>
</html><?php }  ?>