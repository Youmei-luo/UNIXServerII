<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Electronic conference system</title> 
</head>
<body>
<h1>Electronic conference system</h1>
    <a href="bbs_top.php">Return to thread selection screen</a>
<?php
    session_start();
    $thread = $_GET["thread"];
    $_SESSION["thread"]=$thread;
    //If the number contains anything other than a number, end the process
    if(preg_match("/[^0-9]/",$thread)){
        echo 'Non-numeric value is entered<br>';
        echo '<a href="bbs_top.php">Click here to return to the top screen</a><br>';
    }
    mb_internal_encoding('UTF-8');
    //Connect to database
    $database='student_bbs';  // Setting the database name
    $con=mysqli_connect('localhost','student','student999') or die('Connection failed');
    mysqli_select_db($con,$database) or die($database . ' cannot connect');
    mysqli_query($con,'SET NAMES UTF8MB4') or die('Failed to set character code');
    //Get data
    $query = mysqli_query($con, "SELECT * FROM discussion WHERE thread='$thread'") or die('Search failed');
    // List acquired data
    while($data=mysqli_fetch_array($query)) {
        echo "<hr>{$data["id"]} : ";
        echo $data["name"];
        echo "(" . date("y/m/d H:i", strtotime($data["modified"])) . ")";
        //Display only the first 50 characters
        if(mb_strlen($data["message"]) >= 50 ){
            echo "<p>" . nl2br(mb_substr($data["message"],0,50)) . '<font color="blue"> ・・・ Click [Details] to continue</font>' . "</p>";
        }else{
            echo "<p>" . nl2br(mb_substr($data["message"],0,50)) . "</p>";
        }
    //Link to edit/delete/detail display screen
    echo "<a href=\"update.php?id=" . $data["id"] . "\">edit</a> ";
    echo "<a href=\"delete.php?id=" . $data["id"] . "\">delete</a> ";
    echo "<a href=\"detail.php?id=" . $data["id"] . "\">detail</a> ";
}
//Disconnect the database 
mysqli_close($con);
?>
<!-- Data entry form -->
<hr>
    <b>Enter a new message here</b><br>
    <form method="POST" action="confirm.php">
        <table border="1">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" size="30"></td>
            </tr>
            <tr>
                <td>Message</td>
                <td>
                    <textarea rows="8" cols="50" name="message"></textarea>
                </td>
            </tr>
            <tr>
                <td>Editing password</td>
                <td><input type="text" name="passwd" size="4"></td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" value="Confirm">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
