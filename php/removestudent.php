<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
  die('Error connecting to the database.');
}
foreach($_POST['students_to_delete'] as $student_id)
{
  $query = "SELECT FName,LName FROM Students WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
  $result = mysql_query($query) or die(mysql_error());
  $data = mysql_fetch_row($result);
  echo "Student <strong>" .$data[0] . ", " . $data[1] . "</strong> deleted successfully. <br>";
  $query = "DELETE FROM Students WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
  $result = mysql_query($query) or die(mysql_error());
}
?>
