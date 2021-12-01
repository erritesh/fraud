<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<?php
$conn = new mysqli("localhost","root","","ml_fraud_detection");
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}
$id = $_GET['id']; // get id through query string

if(count($_POST)>0) {
    mysqli_query($conn,"UPDATE applicant_details set applicant_name='" . $_POST['applicant_name'] . "', app_email='" . $_POST['app_email'] . "',app_onphone='" . $_POST['app_onphone'] . "', app_ssn='" . $_POST['app_ssn'] . "', landlord_name='" . $_POST['landlord_name'] . "', landlord_address='" . $_POST['landlord_address'] . "', renter='" . $_POST['renter'] . "', unit_type='" . $_POST['unit_type'] . "', requested_amount='" . $_POST['requested_amount'] . "' WHERE id='" . $_POST['id'] . "'");

    $message = "Record Modified Successfully";
    }
    $result = mysqli_query($conn,"SELECT * FROM applicant_details WHERE id='" . $_GET['app_id'] . "'");
    $row= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

  <style type="text/css">
.table {
    margin: 0 auto;
    width: 70%;
}
</style>

</head>
<body>

<div class="container mt-5">
<div align="right" style="padding-bottom:5px;"><a href="applicant_list.php" class="link"> Applicant List</a></div>
<form name="frmUser" method="post" action="#">
<table class="table table-striped table-hover">
<thead>
      <tr>
        <th>Fields</th>
        <th>Data</th>
      </tr>
    </thead>

    <tbody>
      <tr>
      <td><label>Applicant ID</label></td>
      <td><input type="hidden" name="app_id" class="txtField" value="<?php echo $row['app_id']; ?>">
<input type="text" name="app_id" class="form-control" disabled value="<?php echo $row['app_id']; ?>"></td>
      </tr>
<tr>
<td><label>Full Name</label></td>
<td><input type="text" name="applicant_name" class="form-control" value="<?php echo $row['applicant_name']; ?>"></td>
</tr>
<tr>
<td><label>Email ID</label></td>
<td><input type="text" name="app_email" class="form-control" value="<?php echo $row['app_email']; ?>"> </td>
</tr>
<tr>
<td> <label>Phone No</label></td>
<td> <input type="text" name="app_onphone" class="form-control" value="<?php echo $row['app_onphone']; ?>"> </td>
</tr>
<tr>
<td> <label>Applicant SSN</label></td>
<td><input type="text" name="app_ssn" class="form-control" value="<?php echo $row['app_ssn']; ?>"> </td>
</tr>
<tr>
<td> <label>Landlord Name</label></td>
<td><input type="text" name="landlord_name" class="form-control" value="<?php echo $row['landlord_name']; ?>"> </td>
</tr>
<tr> 
<td> <label>Landlord Address</label></td>
<td><input type="text" name="landlord_address" class="form-control" value="<?php echo $row['landlord_address']; ?>"> </td>
</tr>
<tr> 
<td> <label>Renter</label></td>
<td><input type="text" name="renter" class="form-control" value="<?php echo $row['renter']; ?>"> </td>
</tr>

<tr> 
<td> <label>Unit Type</label></td>
<td><input type="text" name="unit_type" class="form-control" value="<?php echo $row['unit_type']; ?>"> </td>
</tr>
<tr> 
<td> <label>Requested Amount</label></td>
<td><input type="text" name="requested_amount" class="form-control" value="<?php echo $row['requested_amount']; ?>"> </td>
</tr>

<tr>
    <td>
<label for="Classification">Classification</label> </td>
<td>
<select name="classification">
  <option value="volvo">volvo </option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
  
  <?php
$i=0;
while($DB_ROW = mysqli_fetch_array($result)) {
?>
<option>
<?php echo $DB_ROW["city_name"]; ?></option>
<?php
$i++;
}
?>



</select> 
</td>


</tr>


<tr>
<td colspan="2">
<button type="submit" name="submit" class="btn btn-secondary btn-lg btn-block">Update</button>
<!--
<input type="submit" name="submit" value="Update" class="buttom">
-->
</td>
</tr>

</tbody>
    

</table>
</form>
</div>

<?php
include('includes/footer.php');
?>