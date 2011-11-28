<?php include("includes/header.php");?>
  <pre><?php if ($session->userlevel >= 8){
  $query="SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID";
  $btwo = mysql_query($query) or die(mysql_error());
  $numB = mysql_num_rows($btwo);
  $query2="INSERT INTO Eval (STUDENT_ID, Grader_ID, GROUP_ID, Grade) VALUES (" . $_POST['graded'] . ", " . $session->STUDENT_ID . ", " . $session->GROUP_ID . ", '10')";
  mysql_query($query2) or die(mysql_error());
  
  $evalid = mysql_insert_id();
  for($i=0;$i<$numB;$i++){ 
    $rtwo = mysql_fetch_array($btwo);
    $query3="INSERT INTO EvalComment (CONTRACT_ID, BEHAVIOR_ID, Comment, EVAL_ID) VALUES (" . $rtwo[CONTRACT_ID] . ", " . $rtwo[BEHAVIOR_ID] . ", \"" . $_POST[$rtwo[BEHAVIOR_ID]] . "\", " . $evalid . ")";
    mysql_query($query3) or die(mysql_error());
  };
}; ?></pre>

