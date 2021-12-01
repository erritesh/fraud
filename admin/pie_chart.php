<?php

$conn = new mysqli("localhost", "root", "", "ml_fraud_detection");
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}
 
$sql = "SELECT applicant_name,classification  FROM applicant_details";
$result = $conn->query($sql);
$arr_users = [];
if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}
     
     $dataPoints = array( 
         array("label"=>"<?php echo $user['app_id']; ?>", "y"=>64.02),
         array("label"=>"Firefox", "y"=>12.55),
         array("label"=>"IE", "y"=>8.47),
         array("label"=>"Safari", "y"=>6.08),
         array("label"=>"Edge", "y"=>4.29),
         array("label"=>"Others", "y"=>4.59)
     )
      
     ?>
     <!DOCTYPE HTML>
     <html>
     <head>
     <script>
     window.onload = function() {
      
      
     var chart = new CanvasJS.Chart("chartContainer", {
         animationEnabled: true,
         title: {
             text: "Usage Share of Desktop Browsers"
         },
         subtitles: [{
             text: "November 2017"
         }],
         data: [{
             type: "pie",
             yValueFormatString: "#,##0.00\"%\"",
             indexLabel: "{label} ({y})",
             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
         }]
     });
     chart.render();
      
     }
     </script>
     </head>
     <body>
     <div id="chartContainer" style="height: 370px; width: 100%;"></div>
     <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
     </body>
     </html>                              