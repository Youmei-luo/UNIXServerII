<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Password registration</title> 
</head>
<body>
<?php
$user=$_POST['user'];
$passwd=$_POST['passwd'];
    
if(empty($user)){
    echo 'Username not entered';
    exit;
}
if(empty($passwd)){
    echo 'Password not entered';
    exit;
}

//Check if the user name is already registered
if(($fp=fopen("../passwd/passwd.csv","r")) !== false)
{
    while(($data=fgetcsv($fp,1000,",")) !== false)
    {
        if($data[0]==$user)
        {
            echo 'The user name ' . $user . ' is already registerd <br>';
            fclose($fp);
            exit;
        }
    }
    fclose($fp);
}
    
//Register user name and password in file
$fp=fopen("../passwd/passwd.csv","a"); //Open file for append
$data=array($_POST['user'],$_POST['passwd']);
fputcsv($fp,$data); // Output .csv file
fclose($fp);
print('User name(' . $user . ')and password(' . $passwd . ')are registerd<br>');
?>   
</body>
</html>
