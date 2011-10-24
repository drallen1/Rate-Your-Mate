<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
      die('Error connecting to the database.');
}
$query = "SELECT * FROM Students";
$result = mysql_query($query) or die(mysql_error());
echo "<table border=1px cellspacing=3px>
<th>Add to Group</th>
<th>Student ID</th>
<th>First Name</th>
<th>Last Name</th>";
while($row=mysql_fetch_array($result)){
echo <<<HTML
<tr>
<td><input type="checkbox" name="name" value="{$row['STUDENT_ID']} " />
<td>{$row['STUDENT_ID']}</td>
<td>{$row['FName']}</td>
<td>{$row['LName']} </td>
</tr>
HTML;
} 
echo "</table>"
?>

