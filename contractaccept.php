<?php include('includes/header.php');
if($session->logged_in==true)
{
?>
<html>
	<head>
	</head>
	<body>
		<h1>Contract Accept/Edit</h1>
	</body>
</html>
<?
//$query = "SELECT * FROM user WHERE STUDENT_ID=" . $session->STUDENT_ID;
if($session->GROUP_ID==NULL){
	echo"You are not in a Group, and therefore not in a project. Please speak to the instructor.";
	$groupName="NONE";
	$projectName="NONE";
	$fname=$session->fname;
	$lname=$session->lname;
	$studentID=$session->STUDENT_ID;
	
	echo "<table border=1px cellspacing=3px><tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Student ID</th>
	<th>Group Name</th>
	<th>Project Name</th>
	<tr>
	<td>$fname</td>
	<td>$lname</td>
	<td>$studentID</td>
	<td>$groupName</td>
	<td>$projectName</td>
	</tr>
	</table>";
}else
{
  $GROUP_ID=$session->GROUP_ID;
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
	echo"
        <h2>Current Contracts</h2><br>
        <table border=1px,cellspacing=3px>
        <th>Select</th>
        <th>Edit</th>
        <th>Goals</th>
        <th>Comments</th>
        <th>Behaviors</th>
        <th>Last Edited By</th>
        <th>Edited?</th>
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
            echo"<tr><td><input type=\"radio\" name=\"contracts\" value=$contract_id></input></td>";
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
			
          }
          echo"</tr>";
        }
		echo"</table>";/*
	echo"<fieldset><legend>Contract Information</legend>";
	$query5="SELECT * FROM Contract WHERE CONTRACT_ID=" . $contractID;
	$result5= mysql_query($query5) or die(mysql_error());
	while($data5=mysql_fetch_array($result5)){
		$goals=$data5['Goals'];
		if($data5['Type']==0 || $data5['Type'] == NULL)
		{
			$type="Instructor";
		}else{
			$type="Student";
		}
		if($data5['Finalized']==0 || $data5['Finalized'] == NULL)
		{
			$finalized="No";
		}else{
			$finalized="Yes";
		}
		$comments=$data5['Comments'];
	}
	echo"<h2>Goals</h2>";
	echo "<p>$goals</p>";
	$query6="SELECT * FROM Behavior WHERE CONTRACT_ID=" . $contractID;
	$result6= mysql_query($query6) or die(mysql_error());
	$numrows = mysql_num_rows($result6);
	while($data6=mysql_fetch_array($result6)){
		$behaviorName[]=$data6['BehaviorName'];
	}
	echo "<h2>Behaviors</h3><br>";
	for($i = 0; $i < $numrows; $i++){
		echo "Behavior " . ($i + 1) . ": " . $behaviorName[$i] . "<br><br>";
	}
	echo "<strong>Submission Type: " . $type . "</strong><br>";
	echo "<strong>Finalized: " . $finalized . "</strong><br>";
	echo "<h2>Comments:</h2>
	<p>" . $comments . "</p>";
	echo"</fieldset>";
        */
}
	

?>
<? }else{
echo "You do not have access to this page.";
}
include('includes/footer.php');
