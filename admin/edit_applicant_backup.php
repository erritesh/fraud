<?php
include('includes/header.php');
include('includes/topbar.php');
//include('includes/sidebar.php');
?>

<?php

$db = mysqli_connect("localhost","root","","ml_fraud_detection");
if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from applicant_details where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{   $applicant_name = $_POST['applicant_name'];
    $app_email = $_POST['app_email'];
    $app_onphone = $_POST['app_onphone'];
    $app_ssn = $_POST['app_ssn'];
    $app_mailing = $_POST['app_mailing'];
    $landlord_name = $_POST['landlord_name'];
    $landlord_address = $_POST['landlord_address'];
    $renter = $_POST['renter'];
    $unit_type = $_POST['unit_type'];
    $requested_amount = $_POST['requested_amount'];
    //$classification = $_POST['classification'];

$edit = mysqli_query($db,"UPDATE applicant_details SET applicant_name ='$applicant_name', app_email='$app_email', app_onphone='$app_onphone',app_ssn='$app_ssn', app_mailing ='$app_mailing', landlord_name='$landlord_name',landlord_address='$landlord_address',renter='$renter', unit_type='$unit_type', requested_amount='$requested_amount' WHERE id='$id'");


    if($edit)
    {
        mysqli_close($db); // Close connection
        header("location: applicant_list.php"); // redirects to all records page
        
        exit;
    }
    
    else
    {
        echo mysqli_error($db);
    }    	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Applicant Data</title>
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

<form method="POST">
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
      <td><input type="hidden" name="id" class="txtField" value="<?php echo $data['id']; ?>">
        <input type="text" name="id" class="form-control" disabled value="<?php echo $data['id']; ?>"Required>
    </td>
</tr>

<tr>
<td><label>Applicant Name</label></td>
<td>
<input type="text" name="applicant_name" class="form-control" value="<?php echo $data['applicant_name'] ?>" Required>
</td>
</tr>
<tr>
<td><label>Email ID</label></td>
<td>
<input type="text" name="app_email" class="form-control" value="<?php echo $data['app_email'] ?>" Required>
</td>
</tr>
<td> <label>Phone No</label></td>
<td> <input type="text" name="app_onphone" class="form-control" value="<?php echo $data['app_onphone']; ?>"> </td>
</tr>
<tr>
<td> <label>Applicant SSN</label></td>
<td><input type="text" name="app_ssn" class="form-control" value="<?php echo $data['app_ssn']; ?>"> </td>
</tr>

<td> <label>Applicant Mailing Address</label></td>
<td><input type="text" name="app_mailing" class="form-control" value="<?php echo $data['app_mailing']; ?>"> </td>
</tr>

<tr>
<td> <label>Landlord Name</label></td>
<td><input type="text" name="landlord_name" class="form-control" value="<?php echo $data['landlord_name']; ?>"> </td>
</tr>
<tr> 
<td> <label>Landlord Address</label></td>
<td><input type="text" name="landlord_address" class="form-control" value="<?php echo $data['landlord_address']; ?>"> </td>
</tr>
<tr> 
<td> <label>Renter</label></td>
<td><input type="text" name="renter" class="form-control" value="<?php echo $data['renter']; ?>"> </td>
</tr>

<tr> 
<td> <label>Unit Type</label></td>
<td><input type="text" name="unit_type" class="form-control" value="<?php echo $data['unit_type']; ?>"> </td>
</tr>
<tr> 
<td> <label>Requested Amount</label></td>
<td><input type="text" name="requested_amount" class="form-control" value="<?php echo $data['requested_amount']; ?>"> </td>
</tr>
<tr>

<tr> 
<td> <label>Classification</label></td>
<td><input type="text" name="classification" class="form-control" value="<?php echo $data['classification']; ?>"> </td>
</tr>
<tr>

<tr>
<td colspan="2">
<button type="submit" name="update" class="btn btn-secondary btn-lg btn-block">Update</button>

</td>
</tr>  
</tbody>
<table>
</form>
<?php
include('includes/footer.php');
?>