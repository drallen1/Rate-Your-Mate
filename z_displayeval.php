<?php
include('include/session.php');


// junk code zbt inserted
$session->GROUP_ID = 12;	
$session->STUDENT_ID = '000256615';

$grader_id=$_GET['graderid'];
$student_id=$_GET['studentid'];

$query="
	SELECT EVAL_ID 
	FROM Eval 
	WHERE GRADER_ID=". $grader_id . " 
		AND STUDENT_ID=" . $student_id;
//echo $query;

$result=mysql_query($query) or die(mysql_error());
$data=mysql_fetch_array($result);

$eval_id=$data['EVAL_ID'];

$query="SELECT BEHAVIOR_ID,Comment comment FROM EvalComment WHERE EVAL_ID=". $eval_id;
$result=mysql_query($query) or die(mysql_error());

//$data2=mysql_fetch_assoc($result);
//echo json_encode( $data2 );

//FOR MULTIPLE VALUES
$data3 = array();
while($data2=mysql_fetch_assoc($result)){ 
	$data3[] = array('id' => $data2['BEHAVIOR_ID'], 'comment' => $data2['comment']);
}
echo json_encode( $data3 );
//*/

