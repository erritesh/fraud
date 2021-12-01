<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Data</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<style>
.modal-content{
    width: 145%;
}
.table{
    width: 150%;
}
</style>

<body>
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
<?php if ($result->num_rows > 0): ?>
<?php while($array=mysqli_fetch_row($result)): ?>
<tr>
<th scope="row"><?php echo $array[0];?></th>
<td><?php echo $array[3];?></td>
<td><?php echo $array[6];?></td>
<td><?php echo $array[13];?></td>
<td><?php echo $array[4];?></td>

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
<label class="col-sm-2 control-label">Landlord Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="landlord_name" name="landlord_name" placeholder="Enter Landlord Name" value="" required="">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Landlord Address </label>
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
<label class="col-sm-2 control-label">Requested Amount</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="requested_amount" name="requested_amount" placeholder="Enter Requested Amount" value="" required="">
</div>
</div>

<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary" id="btn-save" value="addNewUser">Save changes
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
</body>
</html>