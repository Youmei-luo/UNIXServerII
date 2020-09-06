<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Electronic conference system</title> 
</head>
<body>
    <h1>Electronic conference system</h1>
    Click the thread number you want to join<br>
    <hr>
    <h2>Thread list</h2>
<?php
    mb_internal_encoding('UTF-8');
	//Connect to database
    $database='student_bbs';  // Setting the database name
    $con=mysqli_connect('localhost','student','student999') or die('Connection failed');
    mysqli_select_db($con,$database) or die($database . 'cannot connect');
    mysqli_query($con,'SET NAMES UTF8MB4') or die('Failed to set character code');
    //Get title
    if(isset($_GET["title"])) $title = htmlspecialchars($_GET["title"]);
    //Get data
    $query = mysqli_query($con,'SELECT * FROM agenda ORDER BY thread') or die('Search failed');
    $flg = 0;
    while($data = mysqli_fetch_array($query)){
        //If data of thread title exist,  insert into agenda table
    	if(!empty($title) and $data["title"] == $title) {
        	echo '<br>Thread no ' . $data["thread"] . ' is same name. <br>You cannot create a thread with the same name';
            $flg = 1;
        }
    }
    if($flg == 0 and !empty($title))
        $query = mysqli_query($con,"INSERT INTO agenda(title,created) VALUES ('$title',NOW())") or die('Failed to create thread');
    //Display data
    $query = mysqli_query($con,'SELECT * FROM agenda ORDER BY thread DESC') or die('Search failed');
    while ($data = mysqli_fetch_array($query)){
        echo "<hr><a href=\"title_bbs.php?thread=" . $data["thread"] . "\"> ";
        echo $data["thread"] . ":" . $data["title"] . "</a>";
        echo "(" . date("Y/m/d H:i", strtotime($data["created"])) . "create)";
    }
    //Disconnect the database
    mysqli_close($con);
?>
<hr>
    <h2>Create thread</h2>
    Please enter a title for the new thread<br>
<form method = "GET" action = "bbs_top.php">
	<input type="text" name="title" size="50">
    <br>
    <input type="submit" value="Create thread">   
</form>    
</body>
</html>
