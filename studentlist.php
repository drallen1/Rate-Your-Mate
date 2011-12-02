<?php
include('includes/header.php');
if(isset($_POST['Submit1'])){
	foreach($_POST['students_to_delete'] as $student_id)
	{
	  $query = "SELECT fname,lname FROM users WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
	  $result = mysql_query($query) or die(mysql_error());
	  $data = mysql_fetch_row($result);
	  popup("Student " .$data[0] . ", " . $data[1] . " deleted successfully.");
	  $query = "DELETE FROM users WHERE STUDENT_ID=" . mysql_real_escape_string($student_id);
	  $result = mysql_query($query) or die(mysql_error());
	}
}
$query = "SELECT * FROM users";
echo '<FORM METHOD="POST" ACTION="studentlist.php">';
$result = mysql_query($query) or die(mysql_error());
echo "<table border=1px cellspacing=3px>
<th>Select</th>
<th>Student ID</th>
<th>First Name</th>
<th>Last Name</th>";
while($row=mysql_fetch_array($result)){
echo <<<HTML
<tr>
<td><input type="checkbox" name="students_to_delete[]" value="{$row['STUDENT_ID']}" />
<!--
<select name="select1" size="1" >
<option>Group 1</option>
<option>Group 2</option>
<option>Group 3</option>
</select>-->
<td>{$row['STUDENT_ID']}</td>
<td>{$row['fname']}</td>
<td>{$row['lname']} </td>
</tr>
HTML;
}
echo "</table>";
echo <<<HTML
<INPUT TYPE="submit" name="Submit1" VALUE="Delete Selected Students">
</FORM>
HTML;
include('includes/footer.php');
?>

