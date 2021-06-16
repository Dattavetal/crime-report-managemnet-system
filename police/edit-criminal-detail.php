<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['crmspid']==0)) {
  header('location:logout.php');
  } else{
      if(isset($_POST['submit']))
  {
  	$eid=$_GET['editid'];
  	$pid=$_SESSION['crmspid'];
  $crimetype=$_POST['crimetype'];
 $cdate=$_POST['cdate'];
 $ctime=$_POST['ctime'];
 $prison=$_POST['prison'];
  $court=$_POST['court'];
 $name=$_POST['name'];
 $connum=$_POST['connum'];
 $height=$_POST['height'];
 $weight=$_POST['weight'];
 $dob=$_POST['dob'];
 $email=$_POST['email'];
 $address=$_POST['address'];
  $city=$_POST['city'];
 $state=$_POST['state'];
 $country=$_POST['country'];
 $height=$_POST['height'];
 $zipcode=$_POST['zipcode'];

 
$sql="update tblcriminal set CatName=:catname,CrimeDate=:cdate,CrimeTime=:ctime,Prison=:prison,Court=:court,Name=:name,ContactNumber=:connum,Height=:height,Weight=:weight,DateofBirth=:dob,Email=:email,Address=:address,City=:city,State=:state,Country=:country,Zipcode=:zipcode where ID=:eid";
$query=$dbh->prepare($sql);


$query->bindParam(':catname',$crimetype,PDO::PARAM_STR);
$query->bindParam(':cdate',$cdate,PDO::PARAM_STR);
$query->bindParam(':ctime',$ctime,PDO::PARAM_STR);
$query->bindParam(':prison',$prison,PDO::PARAM_STR);
$query->bindParam(':court',$court,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':connum',$connum,PDO::PARAM_STR);
$query->bindParam(':height',$height,PDO::PARAM_STR);
$query->bindParam(':weight',$weight,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':state',$state,PDO::PARAM_STR);
$query->bindParam(':country',$country,PDO::PARAM_STR);
$query->bindParam(':zipcode',$zipcode,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
    echo '<script>alert("Criminals detail has been updated")</script>';
  
echo "<script>window.location.href = 'manage-criminals.php'</script>";
}
?>
<!doctype html>
<html class="fixed">
	<head>
		<title>Crime Record Management System | Criminals Detail Form</title>
		
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
								<li><span>Add</span></li>
								<li><span>Criminal Detail</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal" method="post" enctype="multipart/form-data">
								<?php
                   $eid=$_GET['editid'];
                   $psid=$_SESSION['psid'];
$sql="SELECT * from tblcriminal where ID=:eid and PoliceStationId=:psid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->bindParam(':psid',$psid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>	  
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
										<p style="font-size: 18px;color: blue;padding-top: 10px;text-align: center;"> Criminal ID: <?php  echo htmlentities($row->CriminalID);?></p>
										<br />
										<div class="form-group">
											<label class="col-sm-3 control-label">Police Station <span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="polsta" value="<?php  echo htmlentities($row->PoliceStation);?>" required='true' readonly>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Crime Type <span class="required">*</span></label>
											<div class="col-sm-9">
												<select type="text" class="form-control" name="crimetype" value="" required='true'>
													<option value="<?php  echo htmlentities($row->CatName);?>"><?php  echo htmlentities($row->CatName);?></option>
							 	<?php 

$sql2 = "SELECT * from   tblcategory";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->CategoryName);?>"><?php echo htmlentities($row1->CategoryName);?></option>
 <?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Crime Date <span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="date" class="form-control" name="cdate" value="<?php echo htmlentities($row->CrimeDate);?>" required='true'>
											</div>
											<label class="col-sm-3 control-label">Crime Time <span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="time" class="form-control" name="ctime" value="<?php echo htmlentities($row->CrimeTime);?>" required='true'>
											</div>

										</div>
										
									
										<div class="form-group">
											<label class="col-sm-3 control-label">Select Prison <span class="required">*</span></label>
											<div class="col-sm-3">
												<select type="text" class="form-control" name="prison" value="" required='true'>
													<option value="<?php echo htmlentities($row->Prison);?>"><?php echo htmlentities($row->Prison);?></option>
							 	
<option value="Central Jail">Central Jail</option>
<option value="District Jail">District Jail</option>
<option value="Sub Jail">Sub Jail</option>
<option value="Women Jail">Women Jail</option>
<option value="Borstal Schools">Borstal Schools</option>
<option value="Open Jail">Open Jail</option>
<option value="Special Jail">Special Jail</option>
<option value="Other Jail">Other Jail</option>

												</select>
											</div>
											<label class="col-sm-3 control-label">Select Court <span class="required">*</span></label>
											<div class="col-sm-3">
												<select type="text" class="form-control" name="court" value="" required='true'>
													<option value="<?php echo htmlentities($row->Court);?>"><?php echo htmlentities($row->Court);?></option>
							 	
<option value="Supreme Court">Supreme Court</option>
<option value="High Court">High Court</option>
<option value="District Court">District Court</option>
<option value="Subordinate Court">Subordinate Court</option>


												</select>
											</div>

										</div>
									
										
										<p style="font-size: 18px;color: red;padding-left: 10px"> Criminals's Detail</p>
										<div class="form-group">
											<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control" name="name" value="<?php echo htmlentities($row->Name);?>" required='true'>
											</div>
											<label class="col-sm-3 control-label">Contact Number <span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control" name="connum" value="<?php echo htmlentities($row->ContactNumber);?>" required='true' maxlength="10" pattern="[0-9]+">
											</div>
										</div>
										
									
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Height<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="height" value="<?php echo htmlentities($row->Height);?>" required='true'>
											</div>
											<label class="col-sm-3 control-label">Weight<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="weight" value="<?php echo htmlentities($row->Weight);?>" required='true'>
											</div>
										</div>
									
										<div class="form-group">
											<label class="col-sm-3 control-label">Date of Birth<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="date" class="form-control"  name="dob" value="<?php echo htmlentities($row->DateofBirth);?>" required='true'>
											</div>
											<label class="col-sm-3 control-label">Email<span class="required">(if any)</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="email" value="<?php echo htmlentities($row->Email);?>" >
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Address<span class="required">*</span></label>
											<div class="col-sm-9">
												<textarea type="text" class="form-control"  name="address" value="" required='true'><?php echo htmlentities($row->Address);?></textarea>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">City<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="city" value="<?php echo htmlentities($row->City);?>" required='true'>
											</div>
											<label class="col-sm-3 control-label">State<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="state" value="<?php echo htmlentities($row->State);?>" required='true'>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Country<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="country" value="<?php echo htmlentities($row->Country);?>" required='true'>
											</div>
											<label class="col-sm-3 control-label">Zipcode<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="zipcode" value="<?php echo htmlentities($row->Zipcode);?>" required='true' maxlength="6">
											</div>
										</div>
									
										<div class="form-group">
											<label class="col-sm-3 control-label">Photo<span class="required">*</span></label>
											<div class="col-sm-9">
												<img src="images/<?php echo $row->Photo;?>" width="100" height="100" value="<?php  echo $row->Photo;?>">
<a href="changeimage.php?editid=<?php echo $row->ID;?>"> &nbsp; Edit Image</a>
											</div>
										</div>
									</div><?php $cnt=$cnt+1;}} ?>
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