<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
	die('Error connecting to the database.');
}
$GroupName=$_POST['GroupName'];

$query = "INSERT INTO Group (GroupName) values ('$GroupName')";
$result = mysql_query($query) or die(mysql_error()); 
echo "Group <strong>$GroupName</strong> added successfully."
?>

