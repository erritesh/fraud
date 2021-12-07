<?php

use function PHPSTORM_META\type;

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
.modal-content{
    width: 145%;
}
.table{
    width: 150%;
}
/*
Progress bar css code
*/
.progress {
  border-radius: 10px;
  background-color: #f1f1f1;
  margin-bottom: 1rem;
  height: 1rem;
}

.progress-bar {
  border-radius: 10px;
}
/*
Progress bar css code
*/
#myProgress {
  width: 100%;
  background-color: grey;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: green;
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



<?php
$db = mysqli_connect("localhost","root","","ml_fraud_detection");
if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}
$id = [];
$start_time1 = [];
$end_time1 = [];
$applicant_name = [];
$unit_type = [];
$requested_amount = [];
$comm_val= 0;
$check_counter =0;


$records = mysqli_query($db,"select * from applicant_details");
while($data = mysqli_fetch_array($records))
{
  $id [] = $data['id'];
  $start_time  = $data['app_start_time'];
  $end_time = $data['app_submission_time'];
  $applicant_name = $data['applicant_name'];
  $unit_type = $data ['unit_type'];
  $requested_amount =$data ['requested_amount'];



$now = new DateTime("$start_time");
$ref = new DateTime("$end_time");
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

  //$dupesql = "SELECT applicant_name FROM applicant_details GROUP BY applicant_name HAVING COUNT(*) > 1";
  $dupesql ="SELECT COUNT(*) as total FROM applicant_details WHERE ( applicant_name = '$applicant_name' AND unit_type != 'Multi-Family')";

  $duperaw = mysqli_query($db,$dupesql);
  $data=mysqli_fetch_assoc($duperaw);

$appcount= $data['total'];
if ($appcount>1) {
  
  $comm_val =$comm_val+0.65;
  

} else {
  $comm_val =$comm_val+1.0;
}
$check_counter = $check_counter+1;

$final_val = $comm_val/$check_counter;
}
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
                    <progress min="0" max="100" value="63"> </progress>
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
                    <progress min="0" max="100" value="63" > </progress>
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
                    <progress min="0" max="100" value="63"> </progress>
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
                    <progress min="0" max="100" value="63"> </progress>
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

<script>
  $(document).ready(function () {
  const show_percent = true;
  var progressBars = $(".progress-bar");
  for (i = 0; i < progressBars.length; i++) {
    var progress = $(progressBars[i]).attr("aria-valuenow");
    $(progressBars[i]).width(progress + "%");
    if (show_percent) {
      $(progressBars[i]).text(progress + "%");
    }
    if (progress >= 1) {
      //more than 1 and above
      $(progressBars[i]).addClass("bg-success");
    } 
    else if (progress >= 0.250 && progress < 0.750) {
      $(progressBars[i]).addClass("bg-warning"); //From 0.250 to 0.750
    } 
     else {
      //.75 and above
      $(progressBars[i]).addClass("bg-danger");
    }
  }
});


</script>

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
<td><?php echo $array[14];?>


<!--2`
<div class="progress">
  <div class="progress-bar" style="width:100%" aria-valuenow=<?php echo $array[14]; ?> max="1.0" min=0.0 ></div>
</div>

<progress value=<?php echo $array[14]; ?> max="1.0" min=0.0> </progress>  -->

<div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow= <?php echo $array[14]; ?> aria-valuemin="0" aria-valuemax="1.000"></div>
      </div>




  
<!--
<div id="myProgress">
  <div id="myBar" >
    <script>
      move(<?php echo $array[14]; ?>);
    </script>
  </div>
</div>
-->

</td>
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
<script>
$(document).ready(function () {
  const show_percent = true;
  var progressBars = $(".progress-bar");
  for (i = 0; i < progressBars.length; i++) {
    var progress = $(progressBars[i]).attr("aria-valuenow");
    $(progressBars[i]).width(progress + "%");
    if (show_percent) {
      $(progressBars[i]).text(progress + "%");
    }
    if (progress >= "90") {
      //90 and above
      $(progressBars[i]).addClass("bg-success");
    } else if (progress >= "30" && progress < "45") {
      $(progressBars[i]).addClass("bg-warning"); //From 30 to 44
    } else if (progress >= "45" && progress < "90") {
      $(progressBars[i]).addClass("bg-info"); //From 45 to 89
    } else {
      //29 and under
      $(progressBars[i]).addClass("bg-danger");
    }
  }
});

</script>

