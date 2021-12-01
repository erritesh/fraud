<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard 2</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
.bg-info {
background-color: #ff9333 !important;
}
progress {
  border: none;
  width: 100%;
  height: 10px;
  background:  #75716f;
}

progress {
  color: #f9f6f4;
}

progress::-webkit-progress-value {
  background: #f9f6f4;
}

progress::-moz-progress-bar {
  background:  #f9f6f4;
}
.modal-content{
    width: 145%;
}
.table{
    width: 150%;
}

</style>

</head>
<body>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Home</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!--

<script type="text/javascript">
  $('body').on('click', '.edit', function () {
var id = $(this).data('id');
// ajax
$.ajax({
type:"POST",
url: "edit.php",
data: { id: id },
dataType: 'json',
success: function(res){
$('#id').val(res.id);
$('#app_start_time').val(res.app_start_time);
$('#app_submission_time').val(res.app_submission_time);
$('#applicant_name').val(res.applicant_name);
$('#unit_type').val(res.unit_type);
$('#requested_amount').val(res.requested_amount);

var startdate = res.app_start_time.split("-");
var starttime = res.app_start_time.split(":");
var start_sec = starttime[2];

var enddate = res.app_submission_time.split("-");
var endtime = res.app_submission_time.split(":");
var end_sec = endtime[2];

var sec_diff = endtime[2] - starttime[2];

var risk_score;
// Rule 1
if (sec_diff>30){
risk_score= .70;
alert (risk_score);
}
else {
  alert ("less then 30 sec");
  risk_score = .20;
  alert (risk_score);

} 
// Rule 2
if (applicant_name > 1 && unit_type!="Multi-Family"){
risk_score = .65;
} else {
  risk_score = .20;
}
// Rule 3
if (requested_amount >= 50000){
risk_score = .80;
} else {
  risk_score = .20;
}

alert(res.requested_amount);



// Date Time Format : 2021-11-24 18:08:49
// YYYY-MM-DD H:M:S
}
});
});

</script>
-->
<!-- Start code -->
<?php
$db = mysqli_connect("localhost","root","","ml_fraud_detection");
if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}
$id = [];
$start_time = [];
$end_time = [];
$applicant_name = [];
$unit_type = [];
$requested_amount = [];


$records = mysqli_query($db,"select * from applicant_details");
while($data = mysqli_fetch_array($records))
{
  $id [] = $data['id'];
  $start_time [] = $data['app_start_time'];
  $end_time[] = $data['app_submission_time'];
  $applicant_name = $data['applicant_name'];
  $unit_type = $data ['unit_type'];
  $requested_amount =$data ['requested_amount'];
}
// for loop need to use

print ($id[0]);

mysqli_close($db); 

?>


<!-- End Code  -->



<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

        <!-- ./col -->
        <div class="col-lg-3 col-2">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <div>
                    <progress min="0" max="100" value="63" />
                </div>
                <p>Safe</p>
              </div>
              <div class="icon">
              <i class="far fa-bookmark"></i>  
            </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-2">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>
                <div>
                    <progress min="0" max="100" value="63" />
                </div>

                <p>Elevated Risk</p>
              </div>
              <div class="icon">
                 <i class="far fa-bell"></i>
            </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-2">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>
                <div>
                    <progress min="0" max="100" value="63" />
                </div>
                <p>Medium Risk</p>
              </div>
              <div class="icon">
              <i class="fas fa-biohazard"></i>              
            </div>
            </div>
          </div>
          <div class="col-lg-3 col-2">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <div>
                    <progress min="0" max="100" value="63" />
                </div>
                <p>High Risk</p>
              </div>
              <div class="icon">
              <i class="fas fa-exclamation-triangle"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
 
</section>

<div class="container mt-2">
<div class="row">
<div class="col-md-8 mt-1 mb-1"><button type="button" id="addNewUser" class="btn btn-success">Add New Applicant</button></div>

<div class="col-md-8">
<table class="table">
<thead>
<tr>
<th scope="col">ID</th>
<th scope="col">Applicant Name</th>
<th scope="col">SSN</th>
<th scope="col">Classification</th>
<th scope="col">Risk Score</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
<?php
include 'db.php';
$query="select * from applicant_details limit 150"; 
$result=mysqli_query($dbCon,$query);
?>
<?php if ($result->num_rows > 0): 
  ?>
<?php while($array=mysqli_fetch_row($result)): ?>
<tr>
<th scope="row"><?php echo $array[0];?></th>
<td><?php echo $array[3];?></td>
<td><?php echo $array[6];?></td>
<td><?php echo $array[13];?></td>
<td><?php echo $array[14];?></td>

<td> 
<a href="javascript:void(0)" class="btn btn-primary edit" data-id="<?php echo $array[0];?>">Edit</a>
<a href="javascript:void(0)" class="btn btn-danger" data-id="<?php echo $array[0];?>">Delete</a>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
<td colspan="3" rowspan="1" headers="">No Data Found</td>
</tr>
<?php endif; ?>
<?php mysqli_free_result($result); ?>
</tbody>
</table>
</div>
</div>        
</div>
<!-- boostrap model -->
<div class="modal fade" id="user-model" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="userModel"></h4>
</div>

<div class="modal-body">
<form action="javascript:void(0)" id="userInserUpdateForm" name="userInserUpdateForm" class="form-horizontal" method="POST">
<input type="hidden" name="id" id="id">

<div class="form-group">
<label for="name" class="col-sm-2 control-label">Start Time</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="app_start_time" name="app_start_time" value="" disabled>
</div>
</div>
 
<div class="form-group">
<label for="name" class="col-sm-2 control-label">End Time</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="app_submission_time" name="app_submission_time" value="" disabled>
</div>
</div>

<div class="form-group">
<label for="name" class="col-sm-2 control-label">Full Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="applicant_name" name="applicant_name" placeholder="Enter Name" value="" maxlength="50" required="">
</div>
</div> 

<div class="form-group">
<label for="name" class="col-sm-2 control-label">Email</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="app_email" name="app_email" placeholder="Enter Email" value="" maxlength="50" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Phone</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="app_onphone" name="app_onphone" placeholder="Enter Phone" value="" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">SSN</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="app_ssn" name="app_ssn" placeholder="Enter SSN" value="" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Address</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="app_mailing" name="app_mailing" placeholder="Enter Applicant Address" value="" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-6 control-label">Landlord Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="landlord_name" name="landlord_name" placeholder="Enter Landlord Name" value="" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-6 control-label">Landlord Address </label>
<div class="col-sm-12">
<input type="text" class="form-control" id="landlord_address" name="landlord_address" placeholder="Enter Landlord Address" value="" required="">
</div>
</div>
 
<div class="form-group">
<label class="col-sm-2 control-label">Renter </label>
<div class="col-sm-12">
<input type="text" class="form-control" id="renter" name="renter" placeholder="Enter Renter" value="" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Unit Type</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="unit_type" name="unit_type" placeholder="Enter Unit Type" value="" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-6 control-label">Requested Amount</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="requested_amount" name="requested_amount" placeholder="Enter Requested Amount" value="" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Classification</label>
<div class="col-sm-12">

<input type="text" class="form-control" id="classification" name="classification" placeholder="Enter Classification" value="" required="">

</div>
</div>

<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary" id="btn-save" name= "Submit" value="addNewUser">Save changes
</button>
</div>

</form>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
<!-- end bootstrap model -->

<script type="text/javascript">
$(document).ready(function($){
$('#addNewUser').click(function () {
$('#userInserUpdateForm').trigger("reset");
$('#userModel').html("Add New User");
$('#user-model').modal('show');
});
$('body').on('click', '.edit', function () {
var id = $(this).data('id');
alert(id);
// ajax
$.ajax({
type:"POST",
url: "edit.php",
data: { id: id },
dataType: 'json',
success: function(res){
$('#userModel').html("Edit User");
$('#user-model').modal('show');
$('#id').val(res.id);
$('#app_start_time').val(res.app_start_time);
$('#app_submission_time').val(res.app_submission_time);
$('#applicant_name').val(res.applicant_name);
$('#app_email').val(res.app_email);
$('#app_onphone').val(res.app_onphone);
$('#app_ssn').val(res.app_ssn);
$('#app_mailing').val(res.app_mailing);
$('#landlord_name').val(res.landlord_name);
$('#landlord_address').val(res.landlord_address);
$('#renter').val(res.renter);
$('#unit_type').val(res.unit_type);
$('#requested_amount').val(res.requested_amount);
$('#classification').val(res.classification);
}
});
});
$('body').on('click', '.delete', function () {
if (confirm("Delete Record?") == true) {
var id = $(this).data('id');
// ajax
$.ajax({
type:"POST",
url: "delete.php",
data: { id: id },
dataType: 'json',
success: function(res){
$('#').html(res.name);
$('#').html(res.email);
$('#').html(res.address);
window.location.reload();
}
});
}
});
$('#userInserUpdateForm').submit(function() {
// ajax
$.ajax({
type:"POST",
url: "insert-update.php",
data: $(this).serialize(), // get all form field value in 
dataType: 'json',
success: function(res){
window.location.reload();
}
});
});
});
</script>

<?php
include('includes/footer.php');
?>
</body>
</html>