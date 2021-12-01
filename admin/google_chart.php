
<?php
// Database credentials
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'ml_fraud_detection';

// Create connection and select db
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Get data from database
$result = $db->query("SELECT applicant_name,requested_amount FROM applicant_details");
?>

<html>
<head>
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

</head>

<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>

</body>

</html>