<? include('includes/header.php'); 
if($session->userlevel >=8){
	if(isset($_POST['Submit1'])){
	$GroupName=$_POST['GroupName'];
	$project = "SELECT PROJECT_ID FROM Project WHERE ProjectName='" . mysql_real_escape_string($_POST['Project'])."'";
	$result2 = mysql_query($project) or die(mysql_error()); 
	$PROJECT_ID=mysql_fetch_row($result2);
	$query = "INSERT INTO Groups (GroupName, PROJECT_ID) values ('$GroupName', $PROJECT_ID[0])";
	$result = mysql_query($query) or die(mysql_error()); 
	echo "Group <strong>$GroupName</strong> added successfully.";
	}
?>

		<form action="creategroup.php" method="POST">
			Group Name: <input name="GroupName" type="text"/></br>

			<p> Which project is this group associated? </br> 
			</html>
			<?
			$query = "SELECT ProjectName FROM Project";
				$result = mysql_query($query) or die(mysql_error());
				
				echo '<td><select name="Project" id="project_id">';
				
				while ($row = mysql_fetch_array($result)){
				echo "<option>" . $row['ProjectName'] . "</option>";
				}
				echo '</select></td>';		
				?>
				<html>
				</p>
			
			</br><input type="submit" name = "Submit1" value="Create Group"/></br>
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