<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
      die('Error connecting to the database.');
}
$query = "SELECT * FROM Students";
echo '<FORM METHOD="POST" ACTION="addstudent.php">';
$result = mysql_query($query) or die(mysql_error());
echo "<table border=1px cellspacing=3px>
<th>Select</th>
<th>Student ID</th>
<th>First Name</th>
<th>Last Name</th>";
while($row=mysql_fetch_array($result)){
echo <<<HTML
<tr>
<td><input type="checkbox" name="students_to_add[]" value="{$row['STUDENT_ID']}" />
<!--
<select name="select1" size="1" >
<option>Group 1</option>
<option>Group 2</option>
<option>Group 3</option>
</select>-->
<td>{$row['STUDENT_ID']}</td>
<td>{$row['FName']}</td>
<td>{$row['LName']} </td>
</tr>
HTML;
}
echo "</table>";
$query = "SELECT * FROM Groups";
echo "<table border=1px cellspacing=3px>
<th>GROUP_ID</th>
<th>Group Name</th>";
$result = mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_array($result)){
echo <<<HTML
<tr>
<td>{$row['GROUP_ID']}</td>
<td>{$row['GroupName']}</td>
</tr>
HTML;
}
echo "</table>";
echo <<<HTML
<INPUT TYPE="submit" VALUE="Add Selected Students">
</FORM>
HTML;
?>

