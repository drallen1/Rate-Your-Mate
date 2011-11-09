<?php include('includes/header.php');
if(isset($_POST['Submit1'])){
	foreach($_POST['projects_to_delete'] as $project_id)
	{
	  $query = "SELECT ProjectName FROM Project WHERE PROJECT_ID=" . mysql_real_escape_string($project_id);
	  $result = mysql_query($query) or die(mysql_error());
	  $data = mysql_fetch_row($result);
	  echo "Project <strong>" .$data[0] . "</strong> deleted successfully. <br>";
	  $query = "DELETE FROM Project WHERE PROJECT_ID=" . mysql_real_escape_string($project_id);
	  $result = mysql_query($query) or die(mysql_error());
	}
}
$query = "SELECT * FROM Project";
$result = mysql_query($query) or die(mysql_error());
echo '<FORM METHOD="POST" ACTION="project.php">';
echo "
<h1>Projects</h1><br>
<table border=1px cellspacing=3px>
<th>Select</th>
<th>Project Name</th>
<th>Number of Groups</th>
<th>Contract Creation</th>
<th>Who Evaluates</th>
<th>Num Evals</th>
<th>Available Date</th>
<th>Available Time</th>
<th>Enabled</th>
<th>Due Date</th>
<th>Due Time</th>
<th>Due Enabled</th>
<th>Grade</th>
<th>Late Submissions</th>
<th>Multiple Evals</th>";
while($data=mysql_fetch_array($result)){
	$projectID=$data['PROJECT_ID'];
	$pName = $data['ProjectName'];
	$numGroups = $data['NumGroups'];

	if ($data['Who']==0)
	{
	$contract = "Instructor";
	}else{
	$contract = "Student";
	}
	if ($data['GradeSubmit']==0)
	{
	$gradeSubmit = "Instructor";
	}elseif($data['GradeSubmit']==1){
	$gradeSubmit = "Student";
	}elseif($data['GradeSubmit']==2){
	$gradeSubmit = "Both";
	}else{
	$gradeSubmit = "None";
	}
	

	$numEval=$data['NumEval'];
	$availDate=$data['AvailDate'];
	$availTime=$data['AvailTime'];

	if($data['AvailEnabled'] == 0 || $data['AvailEnabled'] == NULL)
	{
	$availEnabled="No";
	}else{
	$availEnabled="Yes";
	}
	$dueDate=$data['DueDate'];
	$dueTime=$data['DueTime'];

	if($data['DueEnabled' == 0] || $data['DueEnabled'] == NULL)
	{
	$dueEnabled="No";
	}else{
	$dueEnabled="Yes";
	}

	$grade=$data['Grade'];

	if($data['LateSub'] == 0 || $data['LateSub'] == NULL)
	{
	$lateSub="No";
	}else{
	$lateSub="Yes";
	}
	if($data['Multiple'] == 0 || $data['Multiple'] == NULL)
	{
	$multiple="No";
	}else{
	$multiple="Yes";
	}
	echo "<tr>
	<td><input type=\"checkbox\" name=\"projects_to_delete[]\" value=\"$projectID\" />
	<td>$pName</td>
	<td>$numGroups</td>
	<td>$contract</td>
	<td>$gradeSubmit</td>
	<td>$numEval</td>
	<td>$availDate</td>
	<td>$availTime</td>
	<td>$availEnabled</td>
	<td>$dueDate</td>
	<td>$dueTime</td>
	<td>$dueEnabled</td>
	<td>$grade</td>
	<td>$lateSub</td>
	<td>$multiple</td>
	</tr>";

}
echo '</table>
<INPUT TYPE="submit" name="Submit1" VALUE="Delete Selected Projects">
</form>';
?>