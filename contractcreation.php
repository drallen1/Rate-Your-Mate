<? include('includes/header.php');
if($session->logged_in){
	if(isset($_POST['Submit'])){
		$host="turing.plymouth.edu"; // Host name
		$username="drallen1"; // Mysql username
		$password="unicode"; // Mysql password
		$db_name="drallen1"; // Database name
		$tbl_name="Contract"; // Table name
		// Connect to server and select database.
		mysql_connect("$host", "$username", "$password")or die("cannot connect");
		mysql_select_db("$db_name")or die("cannot select DB");
		
		// get data that sent from form
		$group_id=$session->GROUP_ID;
		$user_id=$session->STUDENT_ID;
		$project_id=$_POST['Project'];
		$group_goals=$_POST['group_goals'];
		$behavior1=$_POST['behavior1'];
		$behavior2=$_POST['behavior2'];
		$behavior3=$_POST['behavior3'];
		$behavior4=$_POST['behavior4'];
		$behavior5=$_POST['behavior5'];
		
		$additional_comments=$_POST['Additional_Comments'];
		$sql="INSERT INTO Contract(edit,last_edited_by,GROUP_ID,Goals, Comments)VALUES('0','$user_id','$group_id','$group_goals', '$additional_comments')";
		echo $sql . "<br>";
		echo $sql2 . "<br>";
		$result=mysql_query($sql)or die(mysql_error());
		$contractID=mysql_insert_id();
		$sql2="INSERT INTO Behavior(BehaviorName, CONTRACT_ID)VALUES ('$behavior1',$contractID),('$behavior2',$contractID),('$behavior3',$contractID),('$behavior4',$contractID),('$behavior5',$contractID)";
		$result2=mysql_query($sql2)or die(mysql_error());
		$sql3="UPDATE Groups set CONTRACT_ID=" . $contractID . " WHERE GROUP_ID=" . $group_id;
		$result3=mysql_query($sql3)or die(mysql_error());
	}

?>
	<form id="contract_creation" name="contract creation" action="contractcreation.php" method="POST">
		<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
			<tr>
				<td colspan="3" bgcolor="#413839"><strong>Contract Creation</strong></td>
			</tr>
			<tr>
			<!--
			<td valign="top" halign="left"><strong>Project I.D.</strong></td>
			<td valign="top" width="2%">:</td>
			-->
			<?php
			/*
				$query = "SELECT ProjectName FROM Project";
				$result = mysql_query($query) or die(mysql_error());
				
				echo '<td><select name="Project" id="project_id">';
				
				while ($row = mysql_fetch_array($result)){
				echo "<option>" . $row['ProjectName'] . "</option>";
				}
				echo '</select></td>';	
			*/				
			?>
			</tr>
			<tr>
				<td valign="top" halign="left"><strong>Group Goals</strong></td>
				<td valign="top" width="2%">:</td>
				<td width="84%"><textarea name="group_goals" type="text" id="group_goals" rows="3" cols="50"></textarea></td>
			</tr>
			<tr>
				<td colspan="3" valign="top" halign="left" bgcolor="#747170"><strong>Behaviors Required</strong></td>
			</tr>
			<tr>
				<td valign="top" halign="left"><strong>Behavior</strong></td>
				<td valign="top" width="2%">:</td>
				<td><input size="32" id="behavior1" type="text" name="behavior1"></td>		
			</tr>
			<tr>
				<td valign="top" halign="left"><strong>Behavior</strong></td>
				<td valign="top" width="2%">:</td>
				<td><input size="32" id="behavior2" type="text" name="behavior2"></td>		
			</tr>
			<tr>
				<td valign="top" halign="left"><strong>Behavior</strong></td>
				<td valign="top" width="2%">:</td>
				<td><input size="32" id="behavior3" type="text" name="behavior3"></td>			
			</tr>			
			<tr>
				<td valign="top" halign="left"><strong>Behavior</strong></td>
				<td valign="top" width="2%">:</td>
				<td><input size="32" id="behavior4" type="text" name="behavior4"></td>		
			</tr>			
			<tr>
				<td valign="top" halign="left"><strong>Behavior</strong></td>
				<td valign="top" width="2%">:</td>
				<td><input size="32" id="behavior5" type="text" name="behavior5"></td>		
			</tr>	
			<tr>
				<td colspan="3" valign="top" halign="left" bgcolor="#747170"><strong>Additional Comments</strong></td>
			</tr>			
			<tr>
				<td colspan="3" valign="top" halign="left"><textarea name="Additional Comments" type="text" rows="5" id="additional_comments" cols="67"></textarea></td>		
			</tr>						
			<tr>
			</html>
			<?

			echo'<input type="hidden" name ="GROUP_ID" value="' . "7" . '">';
			?>
			<html>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="Submit" value="Submit" /> 
				</td>
			</tr>	
		</table>
	</form>	
	</body>
</html>

<?
}else
{
echo "You do not have access to this page.";
}
include('includes/footer.php');
?>



