<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
	die('Error connecting to the database.');
}
$query = "SELECT * FROM Students";
$result = mysql_query($query) or die(mysql_error());
echo "<table>
<tr>
<th>Students</th>
</tr>";
while($row=mysql_fetch_array($result)){

echo "
<tr>
<td>" . $row['FName'] . "</td>
<td>" . $row['LName'] . " </td>
</tr>
";
} 
echo ""
?>

