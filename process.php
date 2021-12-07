<?php
include_once 'database.php';
	/*
	$orgDate = "bdate"      "2019-09-15";  
    $newDate = date("d-m-Y", strtotime($orgDate));  
    echo "New date format is: ".$newDate. " (MM-DD-YYYY)";  
	Data save in DB:  2021-11-24 18:08:49
	2021-11-27 18:36:16
*/
if(isset($_POST['submit']))
{
	date_default_timezone_set('Asia/Kolkata');
	date('d-m-Y H:i');


	 $app_start_time = $_POST['currentDateTime'];
	 $app_submission_time = date("Y-m-d H:i:s");
	 $full_name = $_POST['full_name'];
	 $email = $_POST['email'];
	 $mobile_no = $_POST['mobile_no'];
	 $ssn = $_POST['ssn'];
	 $app_address = $_POST['app_address'];
	 $landlord_name = $_POST['landlord_name'];
	 $landlord_address = $_POST['landlord_address'];
	 $renter = $_POST['renter'];
	 $unit_type = $_POST['unit_type'];
	 $requested_amount = $_POST['requested_amount'];
	 $comm_val= 0;
	 $check_counter =0;
	 
	 /*

Risk Score code 
	 */
	
$now = new DateTime("$app_start_time");
$ref = new DateTime("$app_submission_time");
$diff = $ref->getTimestamp() - $now->getTimestamp();

if ($diff>30){
  
  $comm_val =$comm_val+0.70;
} else {
  $comm_val =$comm_val+1.0;
}
$check_counter = $check_counter+1;

if ($requested_amount>= 50000){
  $comm_val =$comm_val+0.80;
}
else {
  $comm_val =$comm_val+1.0;
}
$check_counter = $check_counter+1;

  $dupesql ="SELECT COUNT(*) as total FROM applicant_details WHERE ( applicant_name = '$full_name' AND unit_type != 'Multi-Family')";

  $duperaw = mysqli_query($conn,$dupesql);
  $data=mysqli_fetch_assoc($duperaw);

$appcount= $data['total'];
if ($appcount>1) {
  $comm_val =$comm_val+0.65; 
} else {
  $comm_val =$comm_val+1.0;
}
$check_counter = $check_counter+1;
$final_val = $comm_val/$check_counter;

$sql = "INSERT INTO applicant_details (app_start_time,app_submission_time,applicant_name,app_email,app_onphone,app_ssn,app_mailing,landlord_name,landlord_address,renter,unit_type,requested_amount,AI_prediction) VALUES ('$app_start_time','$app_submission_time','$full_name','$email','$mobile_no','$ssn','$app_address','$landlord_name','$landlord_address','$renter','$unit_type','$requested_amount','$final_val')";

	 if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
		header("Location: Registration_Form.html?message=New record created successfully!"); // redirect to another page
	 } else {
		 echo "Error: " . $sql . " " . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>	