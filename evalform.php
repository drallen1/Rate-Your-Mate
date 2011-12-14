<?php include("includes/header.php");
  if ($session->userlevel > 8 || $session->userlevel < 8){
    //$qsix = mysql_query("SELECT * FROM users u WHERE u.GROUP_ID=" . $session->GROUP_ID . " AND NOT EXISTS(SELECT * FROM Eval e WHERE u.STUDENT_ID=e.STUDENT_ID)"/* AND EXISTS(SELECT * FROM Eval e WHERE e.GRADER_ID=" . $session->STUDENT_ID . ") */ . " AND u.STUDENT_ID!=" . $session->STUDENT_ID);
    //$numE = mysql_num_rows($qsix); AND e.GRADER_ID!=" . $session->STUDENT_ID . " AND e.PROJECT_ID!=" . $projID[PROJECT_ID] . "
    $qtwo = mysql_query("SELECT b.BEHAVIOR_ID FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID");

    $numF = mysql_num_rows($qtwo);
    
    //retrieve the project ID associated with this group
    $pq = mysql_query("SELECT PROJECT_ID FROM Groups WHERE GROUP_ID=" . $session->GROUP_ID);
    $projID = mysql_fetch_array($pq);
    
    //gets the user list for the dropdown menu
    $ssix = "SELECT * FROM users u WHERE u.GROUP_ID=" . $session->GROUP_ID . " AND NOT EXISTS(SELECT * FROM Eval e WHERE u.STUDENT_ID=e.STUDENT_ID AND e.GROUP_ID=" . $session->GROUP_ID . ") AND u.STUDENT_ID!=" . $session->STUDENT_ID ."";
    $qsix = mysql_query($ssix);
    $numE = mysql_num_rows($qsix);
    /***************************************************
    //WHEN numE == 0 GO TO sliders
    ***************************************************/
    if($numE==0){
      printf ("<script>location.href=\"linkedsliders.php\"</script>");
    }
    
    $check = 1;

    //if(numE>=1){
      //if($_POST[graded]==NULL){
      //echo checkmate;
      //};
      for($i=0;$i<$numF && isset($_POST['Submit']);$i++){
        $r2 = mysql_fetch_array($qtwo);
        //echo "works";
        if($_POST[$r2[BEHAVIOR_ID]] == ""){
          $check = 0;
          echo "" . $_POST[$r2[BEHAVIOR_ID]] . " TESTING " . $r2[BEHAVIOR_ID] . " " . $check . " ";
        };
      };
      if(isset($_POST['Submit']) && $_POST[graded]!=1 && $check!=0){
        $query="SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID";
        $btwo = mysql_query($query) or die(mysql_error());
        $numB = mysql_num_rows($btwo);
        $query2="INSERT INTO Eval (STUDENT_ID, Grader_ID, GROUP_ID, Project_ID) VALUES (" . $_POST[graded] . ", " . $session->STUDENT_ID . ", " . $session->GROUP_ID . ", " . $projID[PROJECT_ID] . ")";
        mysql_query($query2) or die(mysql_error());
        
        //Inserts the comments into the database
        $evalid = mysql_insert_id();
        for($i=0;$i<$numB;$i++){ 
          $r2 = mysql_fetch_array($btwo);
          $query3="INSERT INTO EvalComment (CONTRACT_ID, BEHAVIOR_ID, Comment, EVAL_ID) VALUES (" . $r2[CONTRACT_ID] . ", " . $r2[BEHAVIOR_ID] . ", \"" . $_POST[$r2[BEHAVIOR_ID]] . "\", " . $evalid . ")";
          mysql_query($query3) or die(mysql_error());
        };
        
        //selects the user whos evaluation was just completed
        $qfour = mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $session->GROUP_ID . " AND STUDENT_ID=" . $_POST[graded]);
        $rfour = mysql_fetch_array($qfour);
        popup("Your comments for " . $rfour[lname] . ", " . $rfour[fname] . " have been submitted.");
      }
      echo "<!DOCTYPE html>
        <html lang=\"en\">
          <body>";
              
              //gets the user list for the dropdown menu
              $qsix = mysql_query($ssix);
              $numE = mysql_num_rows($qsix);
              
              //gets the number of comment fields for the evaluator to fill out
              $qtwo = mysql_query("SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID");
              $numB = mysql_num_rows($qtwo);
              
              
              $query="SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID";
              $btwo = mysql_query($query) or die(mysql_error());
              $numB = mysql_num_rows($btwo);
              
              /***************************************************
              //WHEN numE == 0 GO TO sliders
              ***************************************************/
              if($numE>=1)
                $page="evalform.php";
              else
                $page="linkedsliders.php";
                
		        /*if field isn't full when submit button is pressed say why*/
		        echo "<form action=$page method=\"POST\">";
              if($_POST[graded]==1){echo "<font size=\"2\"color=\"red\">***Please Select a student to Evaluate***</font></br>";};
              
              /***********************************************************
               *Create a dropdown box witha dynamic list, listing students to be evaluated
              ************************************************************/?>
              </br><font size="6">Peer Evaluation</font></br></br>
              Student: <select name="graded">
                <option selected="selected" value="1">Please Select a Student to Grade</option>
                <?php for($i=0;$i<$numE;$i++){
                  $rsix = mysql_fetch_array($qsix);?>
                  <option value="<?php echo $rsix[STUDENT_ID]?>"><?php echo $rsix[fname] . " " . $rsix[lname]?></option>
                <?php };?>
              </select></br></br>
              
              <?/*********************************************************
                  Makes a dynamic field for the evaluator to comment on the evaluatee
                *********************************************************/
                
                for($i=0;$i<$numB;$i++){ 
                  $rtwo = mysql_fetch_array($qtwo);
                  if($check != 1){
                    echo "</br><font size=\"2\"color=\"red\">***Please fill out the entire evaluation***</font>";
                    echo /*$_POST[$rtwo[BEHAVIOR_ID]] . */"</br>";
                    echo "Behavior: <input name=\"BEHAVIOR_ID\" type=\"text\" value=\"" . $rtwo[BehaviorName] . "\" readonly=\"readonly\"/> </br>";?>
                    Comments: <textarea name="<?php echo $rtwo['BEHAVIOR_ID'];?>" rows="5" cols="50"><?php echo $_POST[$rtwo[BEHAVIOR_ID]];?></textarea> </br><?php
                    //echo "Comments: <textarea name=\"" . $rtwo['BEHAVIOR_ID'] . "\" rows=\"5\" cols=\"50\">" . <?php $_POST[$rtwo[Behavior_ID]] . "</textarea> </br>";<?php>
                  }else{
                    echo "</br>Behavior: <input name=\"BEHAVIOR_ID\" type=\"text\" value=\"" . $rtwo[BehaviorName] . "\" readonly=\"readonly\"/> </br>";
                    echo "Comments: <textarea name=\"" . $rtwo['BEHAVIOR_ID'] . "\" rows=\"5\" cols=\"50\"></textarea> </br>"; 
                  };
              };?>
              </br>
              <input type="submit" value="Send!" name="Submit"/>
            </form>
          </body>

        </html>

      <?
    include("includes/footer.php"); 
  }else{
  echo "You don't have access to this.";
};?>
