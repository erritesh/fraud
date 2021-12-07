<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Applicant List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Applicant List</li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->






<?php
$conn = new mysqli("localhost", "root", "", "ml_fraud_detection");
 
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
}
 
$sql = "SELECT id,app_start_time,app_submission_time,applicant_name,app_email,app_onphone,app_ssn,app_mailing,landlord_name,landlord_address,renter,unit_type,requested_amount FROM applicant_details";

$result = $conn->query($sql);
$arr_users = [];
if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datatable</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
          
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
</head>
<body>
    <br>

      <legend>Applicant Information</legend>
    <table id="userTable">
        <thead>
            <th>Applicant ID</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>SSN</th>
            <th>App Mailing Address</th> 
            <th>Landlord Name </th> 
            <th>Landlord Addess </th>
            <th>Renter</th>
            <th>Unit Type </th>
            <th> Requested Amount </th>
            <th>Edit</th> 
        </thead>
        <tbody>
            <?php if(!empty($arr_users)) { ?>
                <?php foreach($arr_users as $user) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['app_start_time']; ?></td>
                        <td><?php echo $user['app_submission_time']; ?></td>
                        <td><?php echo $user['applicant_name']; ?></td>
                        <td><?php echo $user['app_email']; ?></td>
                        <td><?php echo $user['app_onphone']; ?></td>
                        <td><?php echo $user['app_ssn']; ?></td>
                        <td><?php echo $user['app_mailing']; ?></td>
                        <td><?php echo $user['landlord_name']; ?></td>
                        <td><?php echo $user['landlord_address']; ?></td>
                        <td><?php echo $user['renter']; ?></td>
                        <td><?php echo $user['unit_type']; ?></td>
                        <td><?php echo $user['requested_amount']; ?></td>
                        <td><a href="edit_applicent_data.php?id=<?php echo $user['id']; ?>">Analyze</a></td>
                        
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#userTable').DataTable();
       
    });
    $('#userTable').DataTable( {
    responsive: true
} );

    </script>
</body>
</html>
<?php
include('includes/footer.php');
?>