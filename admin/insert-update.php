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

if(empty($_POST['id'])){
    
$query = "INSERT INTO applicant_details (applicant_name,app_email,app_onphone,app_ssn,app_mailing,landlord_name,landlord_address,renter,unit_type,requested_amount)
VALUES ('$applicant_name','$app_email','$app_onphone','$app_ssn','$app_mailing','$landlord_name','$landlord_address','$renter','$unit_type','$requested_amount')";
}else{
/*$query = "UPDATE applicant_details set id='" . $_POST['id'] . "', name='" . $_POST['name'] . "', age='" . $_POST['age'] . "', email='" . $_POST['email'] . "' WHERE id='" . $_POST['id'] . "'";  */

$query = "UPDATE applicant_details set id='" . $_POST['id'] . "', applicant_name='" . $_POST['applicant_name'] . "', app_email='" . $_POST['app_email'] . "', app_onphone='" . $_POST['app_onphone'] . "', app_ssn='" . $_POST['app_ssn'] . "', app_mailing='" . $_POST['app_mailing'] . "', landlord_name='" . $_POST['landlord_name'] . "', landlord_address='" . $_POST['landlord_address'] . "', renter='" . $_POST['renter'] . "', unit_type='" . $_POST['unit_type'] . "', requested_amount='" . $_POST['requested_amount'] . "' WHERE id='" . $_POST['id'] . "'";


}
$res = mysqli_query($dbCon, $query);
if($res) {
echo json_encode($res);
} else {
echo "Error: " . $sql . "" . mysqli_error($dbCon);
}
}
?>