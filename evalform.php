<?php include("includes/header.php");
  if ($session->userlevel >= 8){
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
      echo "Your comments for " . $rfour[lname] . ", " . $rfour[fname] . " have been submitted.";
    };?>
    <!DOCTYPE html>
      <html lang="en">
        <body>
		      <?php
            $link = mysql_connect("localhost","drallen1","unicode") or die(mysql_error);
            mysql_select_db("drallen1");

            $qfour = mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $session->GROUP_ID);
            $numD = mysql_num_rows($qfour);

            $qtwo = mysql_query("SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID");
            $numB = mysql_num_rows($qtwo);
		?>
		<form action="evalform.php" method="POST">
			
			<!--Student ID: <input name="STUDENT_ID" type="text" value="<!?php echo $Session[STUDENT_ID];?>" readonly="readonly"/> </br-->
      Student: <select name="graded">
        <option selected="selected">Please Select a Student to Grade</option>
        <?php for($i=0;$i<$numD;$i++){
          $rfour = mysql_fetch_array($qfour);?>
          <option value="<?php echo $rfour[STUDENT_ID]?>"><?php echo $rfour[fname] . " " . $rfour[lname]?></option>
          <?php };?>
      </select></br></br>
      <!--Grader: <input name="GRADER_ID" type="text" value="<?php echo $row[GRADER_ID];?>" readonly="readonly"/> </br-->
      <!--/br-->
      <?php for($i=0;$i<$numB;$i++){ 
        $rtwo = mysql_fetch_array($qtwo);
        echo "Behavior: <input name=\"BEHAVIOR_ID\" type=\"text\" value=\"" . $rtwo[BehaviorName] . "\" readonly=\"readonly\"/> </br>";
        /* . $rthree[Comment] . */
        echo "Comments: <textarea name=\"" . $rtwo['BEHAVIOR_ID'] . "\" rows=\"5\" cols=\"50\"></textarea> </br>"; ?>

      <?php };?>
      </br>
      <input type="submit" value="Send!" name="Submit"/>
		</form>
		<?php
			mysql_close($link);
		?>
<ul>
</body>

</html>

<? include("includes/footer.php"); 
}else{
echo "You don't have access to this.";
};?>
