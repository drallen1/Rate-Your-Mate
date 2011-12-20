<?php include('includes/header.php');
if($session->logged_in==true)
{
if(isset($_POST['Finalize'])){
$contract_id=$_POST['contracts'];
$student_id=$session->STUDENT_ID;
$query="UPDATE Contract SET Finalized=1 WHERE CONTRACT_ID=" . $contract_id;
$result = mysql_query($query) or die(mysql_error());
$query="UPDATE Groups SET Contract_ID=" . $contract_id . " WHERE GROUP_ID=" . $_POST['group_id'];
$result = mysql_query($query) or die(mysql_error());
popup("You have successfully finalized a contract. Finalized contracts will be in green text.");
}
if(isset($_POST['Select'])){
$GROUP_ID=$_POST['GroupName'];
echo $group_id;
//$query = "SELECT * FROM user WHERE STUDENT_ID=" . $session->STUDENT_ID;
  $query2="SELECT CONTRACT_ID FROM Contract WHERE GROUP_ID=" . $GROUP_ID;
  //not selecting multiple entries from the Contract table, even though there are multiple entries
  //with the group ID (of 10 in this case)
  //There is also a mysql error with the behaviors of contract 50, but there wasn't any with
  //contract 48, it prints all of the behavior names and then it prints an error
  $result2=mysql_query($query2) or die(mysql_error());
  $num=mysql_num_rows($result2);
  for($x=0;$x<=$num;$x++){
	$contract_ids[]=mysql_fetch_array($result2,MYSQL_NUM);
  }
 echo"
 <h2>Group Members</h2><br>
 <table border=1px cellspacing=3px>
  <th>First Name</th>
  <th>Last Name</th>";
  $query3="SELECT STUDENT_ID FROM users WHERE GROUP_ID=" . $GROUP_ID;
	$result3 = mysql_query($query3) or die(mysql_error());
	while($data3=mysql_fetch_array($result3)){
		$studentID=$data3['STUDENT_ID'];
		$query4="SELECT fname,lname FROM users WHERE STUDENT_ID=" . $studentID;
		$result4 = mysql_query($query4) or die(mysql_error());
		$data4=mysql_fetch_array($result4);
		$sfname=$data4['fname'];
		$slname=$data4['lname'];
		echo "<tr>
		<td>$sfname</td>
		<td>$slname</td>
		</tr>";
	}
	echo "</table>";
	echo"<form method=\"post\" action=\"contractacceptinstructor.php\">
        <h2>Current Contracts</h2><br>
        <table border=1px,cellspacing=3px>
        <th>Select</th>
        <th>Edit</th>
        <th>Goals</th>
        <th>Comments</th>
        <th>Behaviors</th>
        <th>Last Edited By</th>
        <th>Edited?</th>
		<th>Finalized</th>
        ";
        for($i=0;$i<$num;$i++)
        {
          $query4="SELECT * FROM Contract WHERE CONTRACT_ID=" . $contract_ids[$i][0];
          $result4=mysql_query($query4) or die(mysql_error());
          while($contract=mysql_fetch_array($result4)){
            $goals = $contract['Goals'];
            $contract_id=$contract['CONTRACT_ID'];
            $comments=$contract['Comments'];
            $last_edited_by=$contract['last_edited_by'];
            $edit=$contract['edit'];
			$finalized=$contract['Finalized'];
			
			$query="SELECT * FROM Accept WHERE STUDENT_ID=" . $session->STUDENT_ID . " AND CONTRACT_ID=" . $contract_ids[$i][0] . " LIMIT 1";
			$result=mysql_query($query) or die(mysql_error());
			$data=mysql_fetch_row($result);
			if($data[3] == 1){
			echo "<tr id=\"accepted\">";
			}else
			{
			echo "<tr>";
			}
            echo"<td><input type=\"radio\" name=\"contracts\" value=$contract_id></input></td>";
            echo"<td><a href=\"contractedit?contractid=" . $contract_id . "\">Edit</a></td>";
            echo"<td>$goals</td><td>$comments</td><td>";
			
			$query6="SELECT * FROM Behavior WHERE CONTRACT_ID=" . $contract_id;
            $result6=mysql_query($query6) or die(mysql_error());
			
            while($behaviors=mysql_fetch_array($result6))
            {
              $behaviorname=$behaviors['BehaviorName'];
              $behavior_id=$behaviors['BEHAVIOR_ID'];
              echo"$behaviorname, ";
            }
			
            $query7="SELECT fname,lname FROM users WHERE STUDENT_ID=" . $last_edited_by;
            $result7=mysql_query($query7) or die(mysql_error());
            $name=mysql_fetch_row($result7);
            echo"</td><td>$name[1], $name[0]</td>";
			
            if($edit==0){
            echo"<td>No</td>";
            }elseif($edit==1){
            echo"<td>Yes</td>";
            }else{
            echo"<td>NULL</td>";
            }
			
			
			if($finalized == 1){
				echo"<td>Finalized</td>";//this is where if it is accepted or not is saved
			}else
			{
				echo"<td>NO</td>";//this is where if it is accepted or not is saved
			}
			
			
          }
          echo"</tr>";
        }
		echo"<input type=\"hidden\" value=\"".$GROUP_ID."\" name=\"group_id\" />";
		echo"</table><input type=\"Submit\" value=\"Finalize Contract\" name=\"Finalize\" /></form>";
}
$query = "SELECT * FROM Groups";
$result = mysql_query($query) or die(mysql_error());
echo '<h1>Contract Finalization:</h1><br><form action="contractacceptinstructor.php" method="post">Select a group: <select name="GroupName">';
while ($row = mysql_fetch_array($result)){
	echo "<option value=\"" . $row['GROUP_ID'] . "\">" . $row{'GroupName'} . "</option>";
}
echo '</select><input type="Submit" name="Select" value="Select"/></form>';
}else{
echo "You do not have access to this page.";
}
include('includes/footer.php');
