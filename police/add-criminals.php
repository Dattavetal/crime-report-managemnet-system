<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['crmspid']==0)) {
  header('location:logout.php');
  } else{
      if(isset($_POST['submit']))
  {
  	$pid=$_SESSION['crmspid'];
 $polsta=$_POST['policestation'];
$pdata=explode(",",$polsta);
$psid=$pdata[0];
$psname=$pdata[1];
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
 $criminalid=mt_rand(100000000, 999999999);
 $cphoto=$_FILES["cphoto"]["name"];
 $extension = substr($cphoto,strlen($cphoto)-4,strlen($cphoto));
 $allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Criminals photo has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$cphoto=md5($cphoto).time().$extension;
 move_uploaded_file($_FILES["cphoto"]["tmp_name"],"images/".$cphoto);
$sql="insert into tblcriminal(CriminalID,PoliceID,PoliceStationId,PoliceStation,CatName,CrimeDate,CrimeTime,Prison,Court,Name,ContactNumber,Height,Weight,DateofBirth,Email,Address,City,State,Country,Zipcode,Photo)values(:cid,:pid,:psid,:polsta,:catname,:cdate,:ctime,:prison,:court,:name,:connum,:height,:weight,:dob,:email,:address,:city,:state,:country,:zipcode,:cphoto)";
$query=$dbh->prepare($sql);
$query->bindParam(':cid',$criminalid,PDO::PARAM_STR);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':psid',$psid,PDO::PARAM_STR);
$query->bindParam(':polsta',$psname,PDO::PARAM_STR);
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
$query->bindParam(':cphoto',$cphoto,PDO::PARAM_STR);

 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Criminal Record Has Been Save.")</script>';
echo "<script>window.location.href ='add-criminals.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}}

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
												<select type="text" class="form-control" name="policestation" value="" required="true">
							 	<?php 
$psid=$_SESSION['psid'];
$sql2 = "SELECT * from   tblpolicestation where id=:psid";
$query2 = $dbh -> prepare($sql2);
$query2->bindParam(':psid',$psid,PDO::PARAM_STR);
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
											<div class="col-sm-3">
												<input type="date" class="form-control" name="cdate" value="" required='true'>
											</div>
											<label class="col-sm-3 control-label">Crime Time <span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="time" class="form-control" name="ctime" value="" required='true'>
											</div>

										</div>
										
									
										<div class="form-group">
											<label class="col-sm-3 control-label">Select Prison <span class="required">*</span></label>
											<div class="col-sm-3">
												<select type="text" class="form-control" name="prison" value="" required='true'>
													<option value="">Select Prison</option>
							 	
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
													<option value="">Select Court</option>
							 	
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
												<input type="text" class="form-control" name="name" value="" required='true'>
											</div>
											<label class="col-sm-3 control-label">Contact Number <span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control" name="connum" value="" required='true' maxlength="10" pattern="[0-9]+">
											</div>
										</div>
										
									
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Height<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="height" value="" required='true'>
											</div>
											<label class="col-sm-3 control-label">Weight<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="weight" value="" required='true'>
											</div>
										</div>
									
										<div class="form-group">
											<label class="col-sm-3 control-label">Date of Birth<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="date" class="form-control"  name="dob" value="" required='true'>
											</div>
											<label class="col-sm-3 control-label">Email<span class="required">(if any)</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="email" value="" >
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Address<span class="required">*</span></label>
											<div class="col-sm-9">
												<textarea type="text" class="form-control"  name="address" value="" required='true'></textarea>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">City<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="city" value="" required='true'>
											</div>
											<label class="col-sm-3 control-label">State<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="state" value="" required='true'>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label">Country<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="country" value="" required='true'>
											</div>
											<label class="col-sm-3 control-label">Zipcode<span class="required">*</span></label>
											<div class="col-sm-3">
												<input type="text" class="form-control"  name="zipcode" value="" required='true' maxlength="6">
											</div>
										</div>
									
										<div class="form-group">
											<label class="col-sm-3 control-label">Photo<span class="required">*</span></label>
											<div class="col-sm-9">
												<input type="file" class="form-control"  name="cphoto" value="" required='true'>
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