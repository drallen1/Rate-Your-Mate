<? include('includes/header.php'); 
if($session->userlevel >=8){
	if(isset($_POST['Submit1'])){
	$GroupName=$_POST['GroupName']; 
	$query = "INSERT INTO Groups (GroupName) values ('$GroupName')";
	$result = mysql_query($query) or die(mysql_error()); 
	popup("Group $GroupName added successfully.");
	$query="UPDATE users SET Progress=2 WHERE STUDENT_ID=" . $session->STUDENT_ID;
	$result=mysql_query($query) or die(mysql_error());
	}
?>

		<form action="creategroup.php" method="POST">
			Group Name: <input name="GroupName" type="text"/><br>
			
			<br><input type="submit" name = "Submit1" value="Create Group"/><br>
		</form>
<?
}else
{
echo "You do not have access to this page.";
}
include('includes/footer.php');
?>