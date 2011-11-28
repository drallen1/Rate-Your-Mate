<?php include("includes/header.php");
  if ($session->userlevel >= 8){?>
  <!DOCTYPE html>
    <html lang="en">
  <body>
		<?php
			$link = mysql_connect("localhost","drallen1","unicode") or die(mysql_error);
			mysql_select_db("drallen1");
			
			$qfour = mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $session->GROUP_ID);
      $numD = mysql_num_rows($qfour);
      
      
			$query = "SELECT * FROM Eval WHERE GROUP_ID=" . $session->GROUP_ID;
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			
			$qtwo = mysql_query("SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID");
			$numB = mysql_num_rows($qtwo);
			
			//$qthree = mysql_query("SELECT * FROM EvalComment WHERE EVAL_ID=" . $row[EVAL_ID]);
			//$numC = mysql_num_rows($qthree);
		?>
		<form action="evalprocess.php" method="POST">
			
			<!--Student ID: <input name="STUDENT_ID" type="text" value="<!?php echo $Session[STUDENT_ID];?>" readonly="readonly"/> </br-->
      Student: <select name="graded">
        <option selected="selected">Please Select a Student to Grade</option>
        <?php for($i=0;$i<$numD;$i++){
          $rfour = mysql_fetch_array($qfour);?>
          <option><?php echo $rfour[fname] . " " . $rfour[lname]?></option>
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
      <input type="submit" value="Send!"/>
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
