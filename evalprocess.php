<?php include("includes/header.php");?>
  <pre><?php if ($session->userlevel >= 8){

    echo 'POST:';
    print_r($_POST);
  $link = mysql_connect("localhost","drallen1","unicode") or die(mysql_error);
  mysql_select_db("drallen1");
  //echo $session->$STUDENT_ID;
  //echo $_POST[graded];
  $btwo = mysql_query("SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID");
  $numB = mysql_num_rows($btwo);
  $query = mysql_query("INSERT INTO Eval (EVAL_ID, STUDENT_ID, Grader_ID, GROUP_ID, Grade) VALUES (NULL, " . $_POST[graded] . ", " . $session->STUDENT_ID . ", " . $session->GROUP_ID . ", '10')");
  $evalid = mysql_insert_id();
  for($i=0;$i<$numB;$i++){ 
    $rtwo = mysql_fetch_array($btwo);
    $qtwo = mysql_query("INSERT INTO EvalComment (COMMENT_ID, CONTRACT_ID, BEHAVIOR_ID, Comment, EVAL_ID) VALUES (NULL, $rtwo[CONTRACT_ID], $rtwo[BEHAVIOR_ID], $_POST[$rtwo[BEHAVIOR_ID]], $evalid)");
  };
  //$result = mysql_fetch_array($query);
  
  //$query = mysql_query("")
  //if($_POST[graded] == )
  

  mysql_close($link);
  //}else{
    //echo "You don't have access to this.";
}; ?></pre>

