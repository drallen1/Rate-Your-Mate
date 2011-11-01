<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
  die('Error connecting to the database.');
}
foreach($_POST['students_to_add'] as $student_id)
{
  $query = "SELECT FName,LName FROM Students WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
  $result = mysql_query($query) or die(mysql_error());
  $data = mysql_fetch_row($result);
  $query2 = "SELECT GROUP_ID FROM Groups WHERE GroupName='" . mysql_real_escape_string($_POST['GroupName']) . "'";
  $result2 = mysql_query($query2) or die(mysql_error());
  $data2 = mysql_fetch_row($result2);
  $query = "UPDATE Students SET GROUP_ID =" . $data2[0] . " WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
  $result = mysql_query($query) or die(mysql_error());
  echo "Student <strong>" .$data[0] . ", " . $data[1] . "</strong> added to " . $_POST['GroupName']. " successfully. <br>";
}
?>
