<?php
//Get year month date
if (isset($_GET['ymd']))
{
    //Get date of diary
    $ymd=basename($_GET['ymd']);
    $y=intval(substr($ymd,0,4));
    $m=intval(substr($ymd,4,2));
    $d=intval(substr($ymd,6,2));
    $disp_ymd="{$y}/{$m}/{$d}'s event";
    //Get event data
    $file_name="mydata/{$ymd}.txt";
    if ( file_exists($file_name))
    {
        $diary=file_get_contents($file_name);
    } else
    {
        $diary='';
    }
} else 
{
    //If the registration screen is accessed without going through the calendar, move to the calendar
    header('Location: mycalendar.php');
}
//Register the event
if(isset($_POST['action']) and $_POST['action'] == 'Sign up')
{
    $diary=htmlspecialchars($_POST['diary'], ENT_QUOTES, 'UTF-8');
    //Check if the event was entered
    if(!empty($diary))
    {
        //Register the event with the input contents
        file_put_contents($file_name, $diary);
    } else
    {
        //Delete file if nothing happens
        if(file_exists($file_name))
        {
            unlink($file_name);
        }
    }
    //If event is registered, move to calendar
    header('Location: mycalendar.php');
} 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Simple diary/book</title> 
</head>
<body>
<h1>Diary/Schedule registration</h1>
<form method="POST" action="">
    <table>
        <tr>
            <td><?php print($disp_ymd); ?></td>
        </tr>
        <tr>
            <td>
                <textarea rows ="10" cols="60" name="diary"><?php print($diary); ?></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="action" value="Sign up">
                <input type="button" name="back" onClick="history.back()" value="Back">
            </td>
        </tr>    
    </table>
</form>
</body>
</html>
