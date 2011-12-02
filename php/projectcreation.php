<?php
$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
	die('Error connecting to the database.');
}
$ProjectName=$_POST['ProjectName'];
$Counter=$_POST['NumEval'];
echo "<pre>";
print_r($_POST);
echo "</pre>";

for($i=0;$i<$Counter;$i++)
{
$AvailDate = $_POST['AvailDate' . $i];
$AvailTime = $_POST['AvailTime' . $i];
$DueDate = $_POST['DueDate' . $i];
$DueTime = $_POST['DueTime' . $i];
$PROJECT_ID = $_POST['PROJECT_ID'];
$EvalNum = ($i + 1);
$query="INSERT INTO EvalDate (AvailDate,AvailTime,DueDate,DueTime,PROJECT_ID,EvalNum) VALUES ('$AvailDate','$AvailTime','$DueDate','$DueTime',$PROJECT_ID,$EvalNum)";
echo $query;
$result=mysql_query($query) or die (mysql_error());
	//$AvailDate' . $i . '=$_POST[AvailDate$i];
	//$AvailTime' . $i . '=$_POST['AvailTime' . $i . ''];
	//$DueDate' . $i . '=$_POST['DueDate' . $i . ''];
	//$DueDate' . $i . '=$_POST['DueDate' . $i . ''];
}

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>
