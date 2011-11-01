<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
	die('Error connecting to the database.');
}
$ProjectName=$_POST['ProjectName'];
$NumGroups=$_POST['NumGroups'];
$Grade=$_POST['Grade'];
$Who=$_POST['Who'];
$GradeSubmit=$_POST['GradeSubmit'];
$DueEnabled=$_POST['DueEnabled'];
$LateSub=$_POST['LateSub'];
$AvailDate=$_POST['AvailDate'];
$DueDate=$_POST['DueDate'];
$NumEval=$_POST['NumEval'];
$Multiple=$_POST['Multiple'];
$AvailTime=$_POST['AvailTime'];
$DueTime=$_POST['DueTime'];
echo "<pre>";
print_r($_POST);
echo "</pre>";

$query = "INSERT INTO Project(ProjectName, NumGroups, Who, GradeSubmit, Multiple, NumEval, AvailDate, DueDate, DueEnabled, Grade, LateSub, AvailTime, DueTime) values ('$ProjectName', $NumGroups, $Who, $GradeSubmit, $Multiple, $NumEval, '$AvailDate', '$DueDate', $DueEnabled, $Grade, $LateSub, '$AvailTime', '$DueTime')";
echo $query;
$result = mysql_query($query) or die(mysql_error()); 


echo "Project $ProjectName was successfully created."
?>
