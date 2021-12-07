<?php
if(count($_POST)>0)
{    
include 'db.php';

    $applicant_name = $_POST['applicant_name'];
    $app_email = $_POST['app_email'];
    $app_onphone = $_POST['app_onphone'];
    $app_ssn = $_POST['app_ssn'];
    $app_mailing = $_POST['app_mailing'];
    $landlord_name = $_POST['landlord_name'];
    $landlord_address = $_POST['landlord_address'];
    $renter = $_POST['renter'];
    $unit_type = $_POST['unit_type'];
    $requested_amount = $_POST['requested_amount'];

    $comm_val= 0;
	$check_counter =0;
 
    if ($requested_amount>= 50000){
        $comm_val =$comm_val+0.80;
      }
      else {
        $comm_val =$comm_val+1.0;
      }
      $check_counter = $check_counter+1;
      
      $dupesql ="SELECT COUNT(*) as total FROM applicant_details WHERE ( applicant_name = '$applicant_name' AND unit_type != 'Multi-Family')";

      $duperaw = mysqli_query($dbCon,$dupesql);
      $data=mysqli_fetch_assoc($duperaw);
    
    $appcount= $data['total'];
    if ($appcount>1) {
      $comm_val =$comm_val+0.65; 
    } else {
      $comm_val =$comm_val+1.0;
    }
    $check_counter = $check_counter+1;
    $final_val = $comm_val/$check_counter;


if(empty($_POST['id'])){
    $app_start_time = $_POST['app_start_time'];
    $app_submission_time = date("Y-m-d H:i:s");
    
$query = "INSERT INTO applicant_details (app_start_time,app_submission_time,applicant_name,app_email,app_onphone,app_ssn,app_mailing,landlord_name,landlord_address,renter,unit_type,requested_amount)
VALUES ('$app_start_time','$app_submission_time','$applicant_name','$app_email','$app_onphone','$app_ssn','$app_mailing','$landlord_name','$landlord_address','$renter','$unit_type','$requested_amount')";
}else{
/*$query = "UPDATE applicant_details set id='" . $_POST['id'] . "', name='" . $_POST['name'] . "', age='" . $_POST['age'] . "', email='" . $_POST['email'] . "' WHERE id='" . $_POST['id'] . "'";  */



  //, AI_prediction='" . $_POST['final_val'] . "'


$query = "UPDATE applicant_details set applicant_name='" . $_POST['applicant_name'] . "', app_email='" . $_POST['app_email'] . "', app_onphone='" . $_POST['app_onphone'] . "', app_ssn='" . $_POST['app_ssn'] . "', app_mailing='" . $_POST['app_mailing'] . "', landlord_name='" . $_POST['landlord_name'] . "', landlord_address='" . $_POST['landlord_address'] . "', renter='" . $_POST['renter'] . "', unit_type='" . $_POST['unit_type'] . "', requested_amount='" . $_POST['requested_amount'] . "', AI_prediction='" . $final_val . "' WHERE id='" . $_POST['id'] . "'";


}
$res = mysqli_query($dbCon, $query);
if($res) {
echo json_encode($res);
} else {
echo "Error: " . $sql . "" . mysqli_error($dbCon);
}
}
?>