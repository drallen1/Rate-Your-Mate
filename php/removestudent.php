<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
	die('Error connecting to the database.');
}
$query = "SELECT STUDENT_ID From Students";
$result = mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_array($result)){
  $checkname=$row['STUDENT_ID'];
  foreach($_POST[$checkname] as $student_id =>val )
  {
  if($val == 'YES'
    {
      echo $_POST['STUDENT_ID'];
      $query = "DELETE FROM Students WHERE STUDENT_ID" . mysql_real_escape_string($STUDENT_ID);
    }
  echo $query;
  $result = mysql_query($query) or die(mysql_error());
  //echo $POST['STUDENT_ID'];
}
}
?>

