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
   
    $status=$_POST['status'];
   $remark=$_POST['remark'];
  $sol=$_POST['sol'];
$noio=$_POST['noio'];
   $invdetail=$_POST['invdetail'];
$sql= "update tblfir set Status=:status,Remark=:remark,SectionofLaw=:sol,InvestigationOfficer=:noio,InvestigationDetail=:invdetail where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':sol',$sol,PDO::PARAM_STR);
$query->bindParam(':noio',$noio,PDO::PARAM_STR);
$query->bindParam(':invdetail',$invdetail,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);

 $query->execute();

  echo '<script>alert("Remark has been updated")</script>';
 echo "<script>window.location.href ='all-fir.php'</script>";
}

?>
<!doctype html>
<html class="fixed">
	<head>
		<title>Crime Record Management System | View Chargesheet Details</title>
		
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
								<li><span>View</span></li>
								<li><span>FIR Details</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					
					<div class="row">
						<div class="col-md-12">
							                          <?php
                  $eid=$_GET['editid'];

$sql="SELECT tbluser.*,tblfir.* from tblfir join tbluser on tblfir.UserID=tbluser.ID where tblfir.ID=:eid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $eid, PDO::PARAM_STR);
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
 FIR Number: <?php  echo $row->FIRNo;?></td></tr>
 <tr>
<td colspan="6" style="font-size:18px;color:blue">
 Complainer Details</td></tr>
                                            <tr>
    <th>Name</th>
    <td><?php  echo $row->FullName;?></td>
     <th>Mobile Number</th>
    <td><?php  echo $row->MobileNumber;?></td>
    <th>Email</th>
    <td><?php  echo $row->Email;?></td>
  </tr>
  <tr>
    <tr>
<td colspan="6" style="font-size:18px;color:blue">
 FIR Details</td></tr>
    <th>Police Station</th>
    <td><?php  echo $row->PoliceStation;?></td>
    <th>Crime Type</th>
    <td><?php  echo $row->CrimeType;?></td>
    <th>Name of Accused</th>
    <td><?php  echo $row->NameAccused;?></td>
  </tr>
   <tr>
    
    <th>Name of Applicants</th>
    <td><?php  echo $row->NameApplicants;?></td>
    <th>Parentage of Applicant</th>
    <td><?php  echo $row->ParentageApplicant;?></td>
     <th>Contact Number</th>
    <td><?php  echo $row->ContactNumber;?></td>
  </tr>
  <tr>
    
    <th>Address</th>
    <td colspan="2"><?php  echo $row->Address;?></td>
    <th>Purpose of FIR</th>
    <td colspan="2"><?php  echo $row->PurposeofFIR;?></td>
  </tr>
  <tr>
    <th>Relation with Accused</th>
    <td><?php  echo $row->RelationAccused;?></td>
    <th>Purpose of FIR</th>
    <td><?php  echo $row->PurposeofFIR;?></td>
    <th>Date of FIR</th>
    <td><?php  echo $row->DateofFIR;?></td>
  </tr>
  

  <tr>
    
     <th>Order Final Status</th>

    <td> <?php  $status=$row->Status;
    
if($row->Status=="Approved")
{
  echo "Your FIR has been ready for making chargesheet";
}

if($row->Status=="Charge Sheet Completed")
{
 echo "Your Charge Sheet has been Completed";
}


if($row->Status=="")
{
  echo "Not Response Yet";
}


     ;?></td>
     <th >Police Remark</th>
    <?php if($row->Status==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Status);?>
                  </td>
                  <?php } ?>
                  <th >Police Remark Date</th>
    <?php if($row->Status==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->RemarkDate);?>
                  </td>
                  <?php } ?>
  </tr>
  
 
<?php $cnt=$cnt+1;}} ?>

</table> 

<?php 

if ($row->Status=="Approved"){
?> 

<p style="text-align: center;color: red;font-size: 20px">Fill Chargesheet Detail(Only for officer)</p>
     
                                                
                                                <table class="table table-bordered table-hover data-tables">

                                <form method="post" name="submit">

           <tr>
    <th>Section of Law :</th>
    <td>
    <input name="sol" placeholder="Section of Law" class="form-control wd-450" required="true"></td>
  </tr>                      
      <tr>
    <th>Name of Investigation Officer :</th>
    <td>
    <input name="noio" placeholder="Name of Investigation Officer" class="form-control wd-450" required="true"></td>
  </tr>                             
     <tr>
    <th>Investigation Detail :</th>
    <td>
    <textarea name="invdetail" placeholder="Investigation Detail" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr> 
   <tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="Remark" rows="4" cols="4" class="form-control wd-450" required="true"></textarea></td>
  </tr>
 
  <tr>
    <th>Status :</th>
    <td>

   <select name="status" class="form-control wd-450" required="true" >
     <option value="Charge Sheet Completed" selected="true">Charge Sheet Completed</option>
    
   </select></td>
  </tr>
</table>
</div>
 <p style="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Update</button></p>
  
  </form>
		<?php }
    else { ?> 
   <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
   <tr>
<td colspan="6" style="font-size:18px;color:blue">
 Charge Sheet Details</td></tr>
                                            <tr>
    <th>Section of Law</th>
    <td><?php  echo $row->SectionofLaw;?></td>
     <th>Name of Investigation Officer</th>
    <td><?php  echo $row->InvestigationOfficer;?></td>
    
    <th>Charge Sheet Date</th>
    <td><?php  echo $row->ChargesheetDate;?></td>
  </tr>

  <tr>
    <th>Investigation Detail</th>
    <td colspan="5"><?php  echo $row->InvestigationDetail;?></td>

  </tr>
   </table> <?php } ?>	


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