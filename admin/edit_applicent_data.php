<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!------ Include the above in your HEAD tag ---------->
</head>

<body>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Applicant List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Applicant List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
    $classification = $_POST['classification'];

$edit = mysqli_query($db,"update applicant_details set applicant_name ='$applicant_name', app_email='$app_email', app_onphone='$app_onphone',app_ssn='$app_ssn', app_mailing ='$app_mailing', landlord_name='$landlord_name',landlord_address='$landlord_address',renter='$renter', unit_type='$unit_type', requested_amount='$requested_amount', classification='$classification' where app_id='$app_id'");
if($edit)
{
    mysqli_close($db); // Close connection
    header("location: applicant_list.php"); // redirects to all records page 
    exit;
}
else
{
    echo mysqli_error();
}    	
}
?>
<!-- HTML code starts -->
<div class="container">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Applicant Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" placeholder="Applicant Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email ID</label>
                    <div class="col-sm-9">
                        <input type="email" id="lastName" placeholder="Email ID" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone_no" class="col-sm-3 control-label">Phone Number </label>
                    <div class="col-sm-9">
                        <input type="phoneNumber" id="email" placeholder="Phone Number" class="form-control" name= "email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ssn" class="col-sm-3 control-label">Applicant SSN</label>
                    <div class="col-sm-9">
                        <input type="text" id="ssn" placeholder="Applicant SSN" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mailing_address" class="col-sm-3 control-label">Applicant Mailing Address </label>
                    <div class="col-sm-9">
                        <input type="text" id="password" placeholder="Applicant Mailing Address" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="landlord_name" class="col-sm-3 control-label">Landlord Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="landlord_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="landlord_addr" class="col-sm-3 control-label">Landlord Address </label>
                    <div class="col-sm-9">
                        <input type="text" id="phoneNumber" placeholder="Phone number" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                        <label for="Height" class="col-sm-3 control-label">Renter </label>
                    <div class="col-sm-9">
                        <input type="number" id="height" placeholder="Please enter Renter" class="form-control">
                    </div>
                </div>
                 <div class="form-group">
                        <label for="weight" class="col-sm-3 control-label">Unit Type </label>
                    <div class="col-sm-9">
                        <input type="number" id="weight" placeholder="Please enter unit types" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label control-label">Requested Amount</label>
                    <div class="col-sm-9">
                        <input type="number" id="weight" placeholder="Please enter Requested Amount" class="form-control">
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label control-label">Classification</label>
                    <div class="col-sm-9">
                        <input type="text" id="weight" placeholder="Please enter classification" class="form-control">
                    </div>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <div class="col-sm-9">
                    <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
                
            </form> <!-- /form -->
        </div> <!-- ./container -->

<!-- HTML Code ends -->

<br>
<br>

<?php
include('includes/footer.php');
?>
</body>

</html>