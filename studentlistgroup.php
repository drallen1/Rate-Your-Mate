<?php
include('includes/header.php');
if(isset($_POST['Submit1'])){
foreach($_POST['students_to_add'] as $student_id)
	{
	  $query = "SELECT fname,lname FROM users WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
	  $result = mysql_query($query) or die(mysql_error());
	  $data = mysql_fetch_row($result);
	  $query2 = "SELECT GROUP_ID FROM Groups WHERE GroupName='" . mysql_real_escape_string($_POST['GroupName']) . "'";
	  $result2 = mysql_query($query2) or die(mysql_error());
	  $data2 = mysql_fetch_row($result2);
	  $query = "UPDATE users SET GROUP_ID =" . $data2[0] . " WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
	  $result = mysql_query($query) or die(mysql_error());
	 popup("Student " .$data[0] . ", " . $data[1] . " added to " . $_POST['GroupName']. " successfully");
	 $query="UPDATE users SET Progress=3 WHERE STUDENT_ID=" . $session->STUDENT_ID;
	 $result=mysql_query($query) or die(mysql_error());
	}
}
//$query = "SELECT s.*, g.* FROM Students s, Groups g WHERE (s.group_id=g.group_id OR s.group_id=NULL) ORDER BY s.group_id";
$query="SELECT s.*, g.* FROM users s LEFT JOIN Groups g ON s.group_id=g.group_id ORDER BY s.group_id";

echo '<FORM METHOD="POST" ACTION="studentlistgroup.php">';
$result = mysql_query($query) or die(mysql_error());
echo "<table border=1px cellspacing=3px>
<th>Select</th>
<th>Student ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Group</th>";

while($row=mysql_fetch_array($result)){
echo <<<HTML
<tr>
<td><input type="checkbox" name="students_to_add[]" value="{$row['STUDENT_ID']}" />
<td>{$row['STUDENT_ID']}</td>
<td>{$row['fname']}</td>
<td>{$row['lname']} </td>
<td>
HTML;
if($row['GroupName'] == NULL)
{
  echo '<p style = "color:red">No Group</p>';
}else{
 echo $row['GroupName'] . " </td>";
}
echo "</tr>";
}
echo '</table>';


//$query = "SELECT GroupName FROM Groups"
$result = mysql_query($query) or die(mysql_error());

while($row=mysql_fetch_array($result)){
//$row['GROUP_ID'] $row['GroupName']
}
$query = "SELECT * FROM Groups";
$result = mysql_query($query) or die(mysql_error());
echo '<select name="GroupName">';

while ($row = mysql_fetch_array($result)){
echo "<option>" . $row{'GroupName'} . "</option>";
}
echo '</select>';
echo <<<HTML
<INPUT TYPE="submit" name="Submit1" VALUE="Add Selected Students">
</FORM>
HTML;
include('includes/footer.php');
?>

