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
    die("Connection failed: " . mysqli_connect_error($db));
}
?>
<?php
$id = $_GET['id']; // get id through query string

$qry = mysqli_query($db,"select * from applicant_details where id='$id'"); // select query
$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{   
    
   
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
    $classification = $_POST['classification'];

    $edit = mysqli_query($db,"UPDATE applicant_details SET applicant_name ='$applicant_name', app_email='$app_email', app_onphone='$app_onphone',app_ssn='$app_ssn', app_mailing ='$app_mailing', landlord_name='$landlord_name',landlord_address='$landlord_address',renter='$renter', unit_type='$unit_type', requested_amount='$requested_amount', classification='$classification' WHERE id='$id'");
    
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
<!-- HTML code starts -->
<div class="container">
            <form class="form-horizontal" role="form"  method="POST">

            <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Applicant ID</label>
                    <div class="col-sm-9">
                        <input type="text" name="id" placeholder="Applicant ID" class="form-control"  value="<?php echo $data['id']; ?>"  autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_time" class="col-sm-3 control-label">Start Time</label>
                    <div class="col-sm-9">
                        <input type="text" name="start_time" class="form-control" autofocus value="<?php echo $data['app_start_time']; ?>" disabled Required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="end_time" class="col-sm-3 control-label">End Time</label>
                    <div class="col-sm-9">
                        <input type="text" name="app_submission_time" class="form-control" autofocus value="<?php echo $data['app_submission_time'] ?>" disabled Required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Applicant Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="applicant_name" placeholder="Applicant Name" class="form-control" autofocus value="<?php echo $data['applicant_name'] ?>" Required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email ID</label>
                    <div class="col-sm-9">
                        <input type="email" name="app_email" placeholder="Email ID" class="form-control" autofocus value="<?php echo $data['app_email'] ?>" Required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone_no" class="col-sm-3 control-label">Phone Number </label>
                    <div class="col-sm-9">
                        <input type="phoneNumber" name="app_onphone" placeholder="Phone Number" class="form-control" value="<?php echo $data['app_onphone']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="SSN" class="col-sm-3 control-label">Applicant SSN</label>
                    <div class="col-sm-9">
                        <input type="text" name="app_ssn" placeholder="Applicant SSN" class="form-control" value="<?php echo $data['app_ssn']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Mailing Address" class="col-sm-3 control-label">Applicant Mailing Address </label>
                    <div class="col-sm-9">
                        <input type="text" name="app_mailing" placeholder="Applicant Mailing Address" class="form-control" value="<?php echo $data['app_mailing']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Landlord Name" class="col-sm-3 control-label">Landlord Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="landlord_name" class="form-control"placeholder="Landlord Name" value="<?php echo $data['landlord_name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Landlord Addr" class="col-sm-3 control-label">Landlord Address </label>
                    <div class="col-sm-9">
                        <input type="text" name="landlord_address" placeholder="Enter Landlord Address" class="form-control" value="<?php echo $data['landlord_address']; ?>">
                    </div>
                </div>
                <div class="form-group">
                        <label for="Renter" class="col-sm-3 control-label">Renter </label>
                    <div class="col-sm-9">
                        <input type="number" name="renter" placeholder="Please Renter Count" class="form-control" value="<?php echo $data['renter']; ?>">
                    </div>
                </div>
                 <div class="form-group">
                        <label for="Unit Type" class="col-sm-3 control-label">Unit Type </label>
                    <div class="col-sm-9">
                        <input type="text" name="unit_type" placeholder="Please Enter Unit Types" class="form-control" value="<?php echo $data['unit_type']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Requested Amount</label>
                    <div class="col-sm-9">
                    <input type="number" name="requested_amount" placeholder="Please enter Requested Amount" class="form-control" value="<?php echo $data['requested_amount']; ?>">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-3 control-label">Classification</label>
                    <div class="col-sm-9">
                        <input type="text" name="classification" placeholder="Please enter classification" class="form-control" value="<?php echo $data['classification']; ?>">
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