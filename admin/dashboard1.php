<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
.table {
    margin: 0 auto;
    width: 100%;
}

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

</style>

</head>
<body>

<!-- Main content -->
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

<div class="row">
<div class="col-lg-3 col-6">
</div>
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  AI Chart
                </h3>
                
              </div><!-- /.card-header -->
              
                    <?php
$conn = new mysqli("localhost", "root", "", "ml_fraud_detection");
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}
 
$sql = "SELECT id,applicant_name,classification,AI_prediction  FROM applicant_details";

$result = $conn->query($sql);
$arr_users = [];
if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}
?>


<div class="container">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Application ID</th>
        <th>Applicent Name</th>
        <th>Analyst Remark</th>
        <th>Fraud Score</th>
      </tr>
    </thead>

    <tbody>
            <?php if(!empty($arr_users)) { ?>
                <?php foreach($arr_users as $user) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['applicant_name']; ?></td>
                        <td><?php echo $user['classification']; ?></td>
                        <td><?php echo $user['AI_prediction']; ?></td>   
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
</table>
                </div>
                </div>
                </div>
              </div><!-- /.card-body -->
            </div></section>
            <!-- /.card -->
<div class="row">
<div class="col-lg-3 col-6">
</div>
            <section class="col-lg-7 connectedSortable">

                <!-- card -->
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Applicant Vs Landlord
                </h3>
                
                </div>
                <div>
                <section>
                <div>




 
<?php
$conn = new mysqli("localhost", "root", "", "ml_fraud_detection");
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}
 
$sql = "SELECT app_start_time ,app_submission_time,applicant_name ,app_mailing,landlord_name FROM applicant_details";

$result = $conn->query($sql);
$arr_users = [];
if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<div class="container">
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Start Time</th>
        <th>Submission Time</th>
        <th>Applicant Name</th>
        <th>Applicant Address</th>
        <th>Landlord Name</th>

      </tr>
    </thead>
    <tbody>
            <?php if(!empty($arr_users)) { ?>
                <?php foreach($arr_users as $user) { ?>
                    <tr>
                        <td><?php echo $user['app_start_time']; ?></td>
                        <td><?php echo $user['app_submission_time']; ?></td>
                        <td><?php echo $user['applicant_name']; ?></td>
                        <td><?php echo $user['app_mailing']; ?></td>  
                        <td><?php echo $user['landlord_name']; ?></td>   
 
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
</table>
</div>

<!--
Google chart 1  -->

<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'ml_fraud_detection';

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

$result = $db->query("SELECT applicant_name,requested_amount FROM applicant_details");
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Name', 'Requested Amount  '],
          <?php
        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "['".$row['applicant_name']."', ".$row['requested_amount']."],";
          }
      }
      ?>
          
          ]);

        var options = {
          title: 'Requested Amount Report'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>


<div id="piechart" style="width: 900px; height: 500px;"></div>


<?php
include('includes/footer.php');
?>
</body>
</html

