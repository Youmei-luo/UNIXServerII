<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Simple diary book</title> 
</head>
<body>
<h1>Simple diary book</h1>
    <h2>Select date</h2>
<?php
//Get current year and month
$thisYear=date('Y');
$thisMonth=date('m');

if (isset($_POST['year']))
{
    //Get selected year and month
    $year=intval($_POST['year']);
    $month=intval($_POST['month']);
} else 
{
    //Get current year and month
    $year=$thisYear;
    $month=$thisMonth;
}
 //Display year/month selection menu
$me=$_SERVER['SCRIPT_NAME'];
print("<form method=\"POST\" action=\"$me\">");
//Year selection menu
print('<select name="year">');
for ($i=$thisYear-10; $i<=$thisYear+3; $i++)
{
    print('<option');
    if ($i == $year)
    {
        print(' selected');
    }
    print(">$i</option>");
}
print('</select> Year ');
//Month selection menue
print('<select name="month">');
for($i=1; $i<=12; $i++)
{
    print('<option');
    if ($i == $month)
    {
        print(' selected');
    }
    print(">$i</option>");
}
print('</select> Month ');
print('<input type="submit" value="Display calendar" name="submit1">');
print('</form>');
?>
<!-- Display calendar -->
<table border="1">
<tr>
    <th>Sun.</th>
    <th>Mon.</th>
    <th>Tue.</th>
    <th>Wed.</th>
    <th>Thu.</th>
    <th>Fri.</th>
    <th>Sat.</th>
</tr>
<tr>
<?php
//Move to 1th day of the week
$first=date('w',mktime(0,0,0,$month,1,$year));
for ($i=1; $i<=$first; $i++)
{
    print('<td> </td>');
}
    
$day=1;
while(checkdate($month,$day,$year))
{
    //Display date
    //print("<td> $day </td>");
    $link = 'mydiary.php?ymd=%04d%02d%02d';
    print("<td><a href=\"" . sprintf($link,$year,$month,$day) . "\">{$day}</a></td>");
    //When it's Saturday
    if(date('w',mktime(0,0,0,$month,$day,$year)) ==6)
    {
        //End the week
        print('</tr>');
        //If it has next week, add a row
        if(checkdate($month,$day+1,$year))
        {
            print('<tr>');
        }
    }
    //Proceed a day
    $day++;
}
//Move to last Saturday
$last=date('w',mktime(0,0,0,$month+1,0,$year));
for($i=1;$i<7-$last; $i++)
{
    print('<td> </td>');
}   
?>
</tr>
</table>    
</body>
</html>
