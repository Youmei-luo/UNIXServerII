<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Electronic conference system</title> 
</head>
<body>
<?php
    //Start session
    session_start();
    //Connect to the database
    $database='student_bbs';  // Set the database name
    $con=mysqli_connect('localhost','student','student999') or die('Connection failed');
    mysqli_select_db($con,$database) or die($database . 'cannot connect');
    mysqli_query($con,'SET NAMES UTF8MB4') or die('Failed to set character code');
    $id = $_SESSION["id"]; //Get the primary key of deleted data
    //Delete data
    $sql = "DELETE FROM discussion WHERE (id='$id')";
    $query = mysqli_query($con,$sql) or die('ID' . $id . 'Could not delete data');
    $message = 'Deleted data<br>';
    //Discard session data
    $_SESSION = array();
    session_destroy();
?>
<p>Deletion conplete screen</p>
<p><?php echo $message; ?></p>
<p><a href="bbs_top.php">To top page</a></p>
</body>
</html>
