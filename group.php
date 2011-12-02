<?php include('includes/header.php');
if(isset($_POST['Submit1'])){
	foreach($_POST['groups_to_delete'] as $group_id)
	{
	  $query = "SELECT GroupName FROM Groups WHERE GROUP_ID=" . mysql_real_escape_string($group_id);
	  $result = mysql_query($query) or die(mysql_error());
	  $data = mysql_fetch_row($result);
	  popup("Group " .$data[0] . " deleted successfully.");
	  $query = "DELETE FROM Groups WHERE GROUP_ID=" . mysql_real_escape_string($group_id);
	  $result = mysql_query($query) or die(mysql_error());
	}
}
$query = "SELECT * FROM Groups";
$result = mysql_query($query) or die(mysql_error());
echo '<FORM METHOD="POST" ACTION="group.php">';
echo "
<h1>Groups</h1><br>
<table border=1px cellspacing=3px>
<th>Select</th>
<th>Group Name</th>";
while($data=mysql_fetch_array($result)){
$groupName = $data['GroupName'];
$groupID=$data['GROUP_ID'];
	echo "<tr> 
	<td><input type=\"checkbox\" name=\"groups_to_delete[]\" value=\"$groupID\" />
	<td>$groupName</td>
	</tr>";

}
echo '</table>
<INPUT TYPE="submit" name="Submit1" VALUE="Delete Selected Groups">
</form>';
include('includes/footer.php');
?>