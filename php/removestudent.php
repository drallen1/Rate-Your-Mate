<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
  die('Error connecting to the database.');
}
foreach($_POST['students_to_delete'] as $student_id )
{
  $query = "DELETE FROM Students WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
  $result = mysql_query($query) or die(mysql_error());
  echo "Student: " . $student_id . " deleted successfully.";
}
?>
