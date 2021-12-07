<?php
 
    $hName='localhost'; // host name
    $uName='root';   // database user name
    $password='';   // database password
    $dbName = "ml_fraud_detection"; // database name
   //$dbName = "demo";
    $dbCon = mysqli_connect($hName,$uName,$password,"$dbName");
      if(!$dbCon){
          die('Could not Connect MySql Server:' .mysqli_error($dbCon));
      }
?>