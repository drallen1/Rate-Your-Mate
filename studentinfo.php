<?php include('includes/header.php');
if($session->logged_in==true)
{
?>
<html>
	<head>
	</head>
	<body>
		<h1>Student Information</h1>
	</body>
</html>
<?
//$query = "SELECT * FROM user WHERE STUDENT_ID=" . $session->STUDENT_ID;
if($session->GROUP_ID==NULL){
	echo"You are not in a Group, and therefore not in a project. Please speak to the instructor.";
	$groupName="NONE";
	$projectName="NONE";
	$fname=$session->fname;
	$lname=$session->lname;
	$studentID=$session->STUDENT_ID;
	
	echo "<table border=1px cellspacing=3px><tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Student ID</th>
	<th>Group Name</th>
	<th>Project Name</th>
	<tr>
	<td>$fname</td>
	<td>$lname</td>
	<td>$studentID</td>
	<td>$groupName</td>
	<td>$projectName</td>
	</tr>
	</table>";
}else
{

	$query = "SELECT GroupName, PROJECT_ID, CONTRACT_ID FROM Groups WHERE GROUP_ID=" . $session->GROUP_ID;
	$result = mysql_query($query) or die(mysql_error());
	while($data=mysql_fetch_array($result)){
		$projectID=$data['PROJECT_ID'];
		$contractID=$data['CONTRACT_ID'];
		$query2 = "SELECT ProjectName FROM Project WHERE PROJECT_ID=" . $projectID;
		$result2 = mysql_query($query2) or die(mysql_error());
		$data2=mysql_fetch_row($result2);
		$projectName = $data2[0];
		$groupName=$data['GroupName'];
	}
		$fname=$session->fname;
	$lname=$session->lname;
	$studentID=$session->STUDENT_ID;
	
	echo "<table border=1px cellspacing=3px><tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Student ID</th>
	<th>Group Name</th>
	<th>Project Name</th>
	<tr>
	<td>$fname</td>
	<td>$lname</td>
	<td>$studentID</td>
	<td>$groupName</td>
	<td>$projectName</td>
	</tr>
	</table>";
			echo "<h2>$groupName</h2><br><table border=1px cellspacing=3px>
		<th>First Name</th>
		<th>Last Name</th>";
	$query3="SELECT STUDENT_ID FROM users WHERE GROUP_ID=" .  $session->GROUP_ID;
	$result3 = mysql_query($query3) or die(mysql_error());
	while($data3=mysql_fetch_array($result3)){
		$studentID=$data3['STUDENT_ID'];
		$query4="SELECT fname,lname FROM users WHERE STUDENT_ID=" . $studentID;
		$result4 = mysql_query($query4) or die(mysql_error());
		$data4=mysql_fetch_array($result4);
		$sfname=$data4['fname'];
		$slname=$data4['lname'];
		echo "<tr>
		<td>$sfname</td>
		<td>$slname</td>
		</tr>";
	}
	echo "</table>";
	
	echo"<fieldset><legend>Contract Information</legend>";
	$query5="SELECT * FROM Contract WHERE CONTRACT_ID=" . $contractID;
	$result5= mysql_query($query5) or die(mysql_error());
	while($data5=mysql_fetch_array($result5)){
		$goals=$data5['Goals'];
		if($data5['Type']==0 || $data5['Type'] == NULL)
		{
			$type="Instructor";
		}else{
			$type="Student";
		}
		if($data5['Finalized']==0 || $data5['Finalized'] == NULL)
		{
			$finalized="No";
		}else{
			$finalized="Yes";
		}
	}
	echo"<h2>Goals</h2>";
	echo "<p>$goals</p>";
	$query6="SELECT * FROM Behavior WHERE CONTRACT_ID=" . $contractID;
	$result6= mysql_query($query6) or die(mysql_error());
	$numrows = mysql_num_rows($result6);
	while($data6=mysql_fetch_array($result6)){
		$behaviorName[]=$data6['BehaviorName'];
	}
	echo "<h2>Behaviors</h3><br>";
	for($i = 0; $i < $numrows; $i++){
		echo $behaviorName[$i] . "<br><br>";
	}
	echo "<strong>Submission Type: " . $type . "</strong><br>";
	echo "<strong>Finalized: " . $finalized . "</strong><br>";
	echo"</fieldset>";
}
	

?>
<? }else{
echo "You do not have access to this page.";
}