<? include('includes/header.php');
if($session->logged_in){
			echo "<pre>";
			print_r($session->userinfo);
			echo "</pre>";
 ?>	
	<form id="contract_creation" name="contract creation" action="php/contractcreation.php" method="POST">
		<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
			<tr>
				<td colspan="3" bgcolor="#413839"><strong>Contract Creation</strong></td>
			</tr>
			<tr>
			<td valign="top" halign="left"><strong>Project I.D.</strong></td>
			<td valign="top" width="2%">:</td>
	
			<?php
				$query = "SELECT ProjectName FROM Project";
				$result = mysql_query($query) or die(mysql_error());
				
				echo '<td><select name="Project" id="project_id">';
				
				while ($row = mysql_fetch_array($result)){
				echo "<option>" . $row['ProjectName'] . "</option>";
				}
				echo '</select></td>';					
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
					<input type="submit" name="Submit2" value="Accept" />
					
					<input type="submit" name="Submit3" value="Cancel" />
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
?>



