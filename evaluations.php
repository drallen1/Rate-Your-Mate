<?php
include('includes/header.php');
if($session->userlevel>=8) //if they are an instructor
{
$query = "SELECT * FROM Groups";
$result = mysql_query($query) or die(mysql_error());
echo '<h1>Evaluator Report:</h1><br><form action="evaluations.php" method="post">Select a group: <select name="GroupName">';
while ($row = mysql_fetch_array($result)){
	echo "<option value=\"" . $row['GROUP_ID'] . "\">" . $row{'GroupName'} . "</option>";
}
echo '</select><input type="Submit" name="Select" value="Select"/></form>';

if(isset($_POST['Select'])){
	$GROUP_ID=$_POST['GroupName'];
	$query="SELECT * FROM users WHERE GROUP_ID=" . $GROUP_ID;
	$result=mysql_query($query) or die(mysql_error());
	//stuff to do when they select a group
	echo '<table border=1px cellspacing=3px>
	<th>Student ID</th>
	<th>Last Name</th>
	<th>First Name</th>';
	while($data=mysql_fetch_array($result)){
		$lname=$data['lname'];
		$fname=$data['fname'];
		$student_id=$data['STUDENT_ID'];
		echo "<tr><td><a href=\"instructoreval?studentid=" . $student_id . "\">$student_id</a></td><td>$lname</td><td>$fname</td></tr>";
		
	}
	echo "</table>";
}

$query = "SELECT * FROM Groups";
$result = mysql_query($query) or die(mysql_error());
echo '<h1>Evaluatee Report:</h1><br><form action="evaluations.php" method="post">Select a group: <select name="GroupName">';
while ($row = mysql_fetch_array($result)){
	echo "<option value=\"" . $row['GROUP_ID'] . "\">" . $row{'GroupName'} . "</option>";
}
echo '</select><input type="Submit" name="Select2" value="Select"/></form>';



if(isset($_POST['Select2'])){
	$GROUP_ID=$_POST['GroupName'];
	//$query="SELECT users.*,EvalComment.STUDENT_ID FROM users LEFT JOIN EvalComment ON WHERE GROUP_ID=" . $GROUP_ID . " JOIN ;
	$query="SELECT * FROM users u WHERE u.GROUP_ID=" . $GROUP_ID. " AND EXISTS(SELECT * FROM Eval e WHERE u.STUDENT_ID=e.STUDENT_ID)";
	//$qsix = mysql_query($sql = "SELECT * FROM users u WHERE u.GROUP_ID=" . $group_id . " AND EXISTS(SELECT * FROM Eval e WHERE u.STUDENT_ID=e.STUDENT_ID) AND u.STUDENT_ID != " . $student_id);
	$result=mysql_query($query) or die(mysql_error());
	//stuff to do when they select a group
	echo '<table border=1px cellspacing=3px>
	<th>Student ID</th>
	<th>Last Name</th>
	<th>First Name</th>';
	while($data=mysql_fetch_array($result)){
		$lname=$data['lname'];
		$fname=$data['fname'];
		$student_id=$data['STUDENT_ID'];
		echo "<tr><td><a href=\"evaluateeeval?studentid=" . $student_id . "\">$student_id</a></td><td>$lname</td><td>$fname</td></tr>";
		
	}
	echo "</table>";
}
}else{
echo "You do not have access to this page.";
}
include('includes/footer.php');
?>