<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Password registration</title> 
</head>
<body>
<?php
$auth=false;
$fp=fopen("../passwd/passwd.csv","r");
if(isset($_SERVER['PHP_AUTH_USER']))
{
    while($data=fgetcsv($fp,1000,","))
    {
        if($_SERVER['PHP_AUTH_USER']==$data[0] &&
          $_SERVER['PHP_AUTH_PW'] == $data[1])
        {
            $auth=true;
            break;
        }
    }
    fclose($fp);
}

if (!$auth)
{
    header('WWW-Authenticate: Basic realm = "Your Lecture"');
    header('HTTP:/1.0 401 Unauthorized');
    echo 'You must be logged in to view this page';
} else
{
    echo 'Welcome！' . $data[0] . '.';
}
?>   
</body>
</html>
