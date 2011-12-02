<?php
include('includes/header.php');
$student_id=$_GET['studentid'];
if($session->userlevel>=8) //if they are an instructor
{
 if(isset($_POST['Submit'])){
      $query="SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID";
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
      popup("Your comments for " . $rfour[lname] . ", " . $rfour[fname] . " have been submitted.");
    };?>
    <!DOCTYPE html>
      <html lang="en">
        <body>
		      <?php
            $link = mysql_connect("localhost","drallen1","unicode") or die(mysql_error);
            mysql_select_db("drallen1");
            
            $qsix = mysql_query("SELECT * FROM users u WHERE u.GROUP_ID=" . $session->GROUP_ID . " AND NOT EXISTS(SELECT * FROM Eval e WHERE u.STUDENT_ID=e.STUDENT_ID) AND u.STUDENT_ID!=" . $session->STUDENT_ID);
            $numE = mysql_num_rows($qsix);
            /***************************************************
            //WHEN numE == 0 GO TO PIE CHART
            ***************************************************/
            $qtwo = mysql_query("SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID");
            $numB = mysql_num_rows($qtwo);
            
            if($numE>1)
              $page="evalform.php";
            else
              $page="evalprocess.php";
		      
		      echo "<form action=$page method=\"POST\">";?>
			
            Student: <select name="graded">
              <option selected="selected">Please Select a Student to Grade</option>
              <?php for($i=0;$i<$numE;$i++){
                $rsix = mysql_fetch_array($qsix);?>
                <option value="<?php echo $rsix[STUDENT_ID]?>"><?php echo $rsix[fname] . " " . $rsix[lname]?></option>
              <?php };?>
            </select></br></br>
      
            <?php for($i=0;$i<$numB;$i++){ 
              $rtwo = mysql_fetch_array($qtwo);
              echo "Behavior: <input name=\"BEHAVIOR_ID\" type=\"text\" value=\"" . $rtwo[BehaviorName] . "\" readonly=\"readonly\"/> </br>";
              echo "Comments: <textarea name=\"" . $rtwo['BEHAVIOR_ID'] . "\" rows=\"5\" cols=\"50\"></textarea> </br>"; ?>
            <?php };?>
            </br>
            <input type="submit" value="Send!" name="Submit"/>
          </form>
		      <?php
            mysql_close($link);
		      ?>
        </body>

   </html>

    <? include("includes/footer.php"); 
  }else{
  echo "You don't have access to this.";
};?>
  