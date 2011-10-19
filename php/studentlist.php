<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
	die('Error connecting to the database.');
}
$STUDENT_ID=$_POST['STUDENT_ID'];
$FName=$_POST['FName'];
$LName=$_POST['LName'];

$query = "INSERT INTO Students(STUDENT_ID,FName,LName) values ('$STUDENT_ID','$FName','$LName')";
$result = mysql_query($query) or die(mysql_error()); 
echo "Student <strong>$LName, $FName</strong> added successfully."
?>

