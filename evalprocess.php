<?php include("includes/header.php");?>
  <pre>
  <?php echo "U did it";
    if(isset($_POST['Submit'])){
      echo "</br>" . $_POST['slider_values'] . "</br>";
      
      print_r (explode(",", $_POST['slider_values']));
      
      $exp = explode(",", $_POST['slider_values']);
      $result = (count($exp))-1;
      $output = array_slice($exp, 0, $result);
      
      for($i=0;$i<$result;$i++){
        $output[$i] = trim($output[$i]);
        $output[$i] = intval($output[$i]);
        $output[$i] = $output[$i]+1;
      };
      echo "</br>";
      
      print_r ($output);
      /*$query="SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID";
      $btwo = mysql_query($query) or die(mysql_error());
      $numB = mysql_num_rows($btwo);
      $query2="INSERT INTO Eval (STUDENT_ID, Grader_ID, GROUP_ID, Grade) VALUES (" . $_POST[graded] . ", " . $session->STUDENT_ID . ", " . $session->GROUP_ID . ", '10')";
      mysql_query($query2) or die(mysql_error());
        
      $evalid = mysql_insert_id();
      for($i=0;$i<$numB;$i++){ 
        $r2 = mysql_fetch_array($btwo);
        $query3="INSERT INTO EvalComment (CONTRACT_ID, BEHAVIOR_ID, Comment, EVAL_ID) VALUES (" . $r2[CONTRACT_ID] . ", " . $r2[BEHAVIOR_ID] . ", \"" . $_POST[$r2[BEHAVIOR_ID]] . "\", " . $evalid . ")";
        mysql_query($query3) or die(mysql_error());
      };
      $qfour = mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $session->GROUP_ID . " AND STUDENT_ID=" . $_POST[graded]);
      $rfour = mysql_fetch_array($qfour);
      popup("Your comments for " . $rfour[lname] . ", " . $rfour[fname] . " have been submitted.");*/
    };
  ?></pre>

