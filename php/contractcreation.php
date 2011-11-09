<?php
	$host="turing.plymouth.edu"; // Host name
	$username="drallen1"; // Mysql username
	$password="unicode"; // Mysql password
	$db_name="drallen1"; // Database name
	$tbl_name="Contract"; // Table name
	// Connect to server and select database.
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
	
	// get data that sent from form
	$group_id=$_POST['GROUP_ID'];
	$project_id=$_POST['Project'];
	$group_goals=$_POST['group_goals'];
	$behavior1=$_POST['behavior1'];
	$behavior2=$_POST['behavior2'];
	$behavior3=$_POST['behavior3'];
	$behavior4=$_POST['behavior4'];
	$behavior5=$_POST['behavior5'];
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	
	$additional_comments=$_POST['additional_comments'];
	$sql="INSERT INTO Contract(GROUP_ID, CONTRACT_ID,Goals, Comments, PROJECT_ID)VALUES('$group_id','$project_id', '$group_goals', '$additional_comments','$project_id')";
	$sql2="INSERT INTO Behavior(BehaviorName)VALUES ('$behavior1'),('$behavior2'),('$behavior3'),('$behavior4'),('$behavior5')";
	echo $sql;
	echo $sql2;
	$result=mysql_query($sql)or die(mysql_error());
	$result2=mysql_query($sql2)or die(mysql_error());

?>