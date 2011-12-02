<?php
include('includes/header.php');
$contract_id=$_GET['contractid'];
if(isset($_POST['Submit'])){
$goals=$_POST['goals'];
$comments=$_POST['comments'];
$behaviors=$_POST['behaviorname'];
$behaviorid=$_POST['behaviorid'];
$num = $_POST['num'];
	$query = "UPDATE Contract SET Goals = \"$goals\", Comments = \"$comments\" ,last_edited_by = $session->STUDENT_ID,edit=\"1\" WHERE CONTRACT_ID=" . $contract_id ;
	$result=mysql_query($query) or die(mysql_error());
	for($x=0;$x<$num;$x++){
		$query = "UPDATE Behavior SET BehaviorName=\"" . $behaviors[$x] . "\" WHERE BEHAVIOR_ID=" . $behaviorid[$x] ;
		$result= mysql_query($query) or die(mysql_error());
	}
	popup('Contract edited sucessfully.');
}
$query="SELECT * FROM Contract WHERE CONTRACT_ID=" . $contract_id;
$result = mysql_query($query) or die(mysql_error());
echo"<form action=\"contractedit.php?contractid=".$contract_id."\" method=\"POST\">";
while($contract=mysql_fetch_array($result)){
	$goals = $contract['Goals'];
	$contract_id=$contract['CONTRACT_ID'];
	$comments=$contract['Comments'];
	$last_edited_by=$contract['last_edited_by'];
	$edit=$contract['edit'];
	echo"Goals: <textarea type=\"text\" name = \"goals\" id=\"goals\">$goals</textarea><br>";
	echo"Comments: <textarea type=\"text\" name = \"comments\" id=\"comments\">$comments</textarea><br>";
	$query2="SELECT * FROM Behavior WHERE CONTRACT_ID=" . $contract_id;
	$result2=mysql_query($query2) or die(mysql_error());
	while($behaviors=mysql_fetch_array($result2)){
		$num++;
		$behaviorname=$behaviors['BehaviorName'];
		$behavior_id=$behaviors['BEHAVIOR_ID'];
		echo"Behavior$num<input type=\"text\" name = \"behaviorname[]\" value=\"$behaviorname\"></input><br>";
		echo"<input type=\"hidden\" name=\"num\"value=\"$num\"/>";
		echo"<input type=\"hidden\" name=\"behaviorid[]\" value=\"$behavior_id\"/>";
    }
	$num=0;

}
echo "<input type=\"Submit\" name=\"Submit\" value=\"Save Changes\">";
echo "</form>";
?>