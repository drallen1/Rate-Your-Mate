<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
      die('Error connecting to the database.');
}
//$query = "SELECT s.*, g.* FROM Students s, Groups g WHERE (s.group_id=g.group_id OR s.group_id=NULL) ORDER BY s.group_id";
$query="SELECT s.*, g.* FROM Students s LEFT JOIN Groups g ON s.group_id=g.group_id ORDER BY s.group_id";

echo '<FORM METHOD="POST" ACTION="addstudenttogroup".php">';
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
<td>{$row['FName']}</td>
<td>{$row['LName']} </td>
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
<INPUT TYPE="submit" VALUE="Add Selected Students">
</FORM>
HTML;

?>

