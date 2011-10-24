<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
	die('Error connecting to the database.');
}
$query = "SELECT STUDENT_ID From Students";
$STUDENT_ID=$_POST['STUDENT_ID'];
$result = mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_array($result)){
//echo $row['STUDENT_ID'];
if($_POST['STUDENT_ID']=='YES')
{
  echo $_POST['STUDENT_ID'];
  $query = "DELETE FROM Students WHERE STUDENT_ID = $STUDENT_ID";
}
$result = mysql_query($query) or die(mysql_error());
//echo $POST['STUDENT_ID'];
}
?>

