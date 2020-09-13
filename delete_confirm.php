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
    //Set the character code to UTF-8
    mb_internal_encoding('UTF-8');
    $id = $_SESSION["id"];  //Get the primary key of deleted data
	//Connect to the database
    $database='student_bbs';  // Set the database name
    $con=mysqli_connect('localhost','student','student999') or die('Connection failed');
    mysqli_select_db($con,$database) or die($database . 'cannot connect');
    mysqli_query($con,'SET NAMES UTF8MB4') or die('Failed to set character code');
    //Get the data to delete
    $sql = "SELECT * FROM discussion WHERE (id='$id')";
    $query = mysqli_query($con,$sql) or die('fail 1');
    $data = mysqli_fetch_array($query);
    //Confirmation of password for deletion
    $passwd = htmlspecialchars($_POST["passwd"],ENT_QUOTES,"UTF-8");
    if($data["passwd"] != $passwd) { 
        exit('The editing password is different. Click the back button on your browser to return to the previous screen and enter the password correctly.');
    }
    //Disconnect database
    mysqli_close($con);
?>
<p>Deletion confirmation screen</p>
<form method = "POST" action = "delete_submit.php">
<table border="1">
    <tr>
        <td>Name</td>
        <td><?php echo $data["name"]; ?></td>
        </tr>
        <tr>
            <td>Message</td>
            <td><?php echo nl2br($data["message"]); ?></td>
        </tr>
    	<tr>
            <td colspan="2">
            <input type="submit" value="Delete">
            </td>
        </tr>
    </table>
</form>    
</body>
</html>
