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
    //Get the primary key of change data
    if (!isset($_GET["id"])){
        exit;
    }else{
        $id = $_GET["id"];
        $_SESSION["id"] = $id;
    }
    // Connect to database
    $database='student_bbs';  // Setting the database name
    $con=mysqli_connect('localhost','student','student999') or die('Connection failed');
    mysqli_select_db($con,$database) or die($database . 'cannot connect');
    mysqli_query($con,'SET NAMES UTF8MB4') or die('Failed to set character code');
    //Get the data to change
    $sql = "SELECT * FROM discussion WHERE id='$id'";
    $query = mysqli_query($con,$sql) or die('fail');
    $data = mysqli_fetch_array($query);
    //Disconnect database
    mysqli_close($con);
?>
    <p>Delete screen</p>
    <form method="POST" action="delete_confirm.php">
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
            <td>Edit / delete password</td>
            <td><input type="text" name="passwd" size="4"></td>
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
