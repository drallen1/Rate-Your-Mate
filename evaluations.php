<?php
include('includes/header.php');
if($session->userlevel>=8) //if they are an instructor
{
$query = "SELECT * FROM Groups";
$result = mysql_query($query) or die(mysql_error());
echo '<form action="evaluations.php" method="post">Select a group: <select name="GroupName">';
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
		echo "<tr><td>$student_id</td><td>$lname</td><td>$fname</td></tr>";
		
	}
	echo "</table>";
}
}else{
echo "You do not have access to this page.";
}
include('includes/footer.php');
?>