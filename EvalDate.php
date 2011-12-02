<? include('includes/header.php'); 
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
$PROJECT_ID=mysql_insert_id();

popup("Project $ProjectName was successfully created.");


if($session->userlevel >=8){

?>


<form action="php/projectcreation.php" method="post">

<?php for($i=0;$i<$NumEval;$i++){
$x=$i+1;

echo <<<HTML
<script>
$(function()
	{
	$( "#datepicker$i" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( "#datepicker2$i" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$('#timepicker$i').timepicker({timeFormat: 'hh:mm:ss' });
	$('#timepicker2$i').timepicker({timeFormat: 'hh:mm:ss' });
	}
);
</script>
HTML;

echo'<div class="demo"><fieldset><legend> Evaluation ' . $x . '</legend>';
echo'<p>Date Open: <input id="datepicker' . $i . '" type="text" name="AvailDate' . $i . '"></p>';
echo'<p>Time Open: <input id="timepicker' . $i . '" type="text" name="AvailTime' . $i . '"></p></br>';
echo'<p>Date Closed: <input id="datepicker2' . $i . '" type="text" name="DueDate' . $i . '"></p>';
echo'<p>Time Closed: <input id="timepicker2' . $i . '" type="text" name="DueTime' . $i . '"></p>';
echo'</fieldset>';
}
echo'</div><input type="hidden" value="' . $i . '"name="NumEval" />';
echo'</div><input type="hidden" value="' . $PROJECT_ID . '"name="PROJECT_ID" />';
?>
<input type="submit" />
</form>


<?
}else
{
echo "You do not have access to this page.";
}
include('includes/footer.php');
?>