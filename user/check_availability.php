<?php 
require_once("includes/dbconnection.php");
// code consumer email availablity
if(!empty($_POST["emailid"])) {
	 $email= $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "<span style='color:red'>error : You did not enter a valid email.</span>";
	}
	else {
		$sql ="Select ID from tbluser where Email=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Email already exists .</span>";
echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}




?>